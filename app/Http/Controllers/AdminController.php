<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function Laravel\Prompts\alert;

class AdminController extends Controller
{
    public function menu()
    {
        return view('admin/menu');
    }

    public function users()
    {
        $users = User::orderBy('nome', 'asc')->get();

        foreach ($users as $user) {
            $user->cpf = $this->formataCPF($user->cpf);
            $user->data_criacao = date('d/m/Y H:i', strtotime($user->criado_em));

            if ($user->ultimo_acesso) {
                $user->ultimo_acesso = date('d/m/Y H:i', timestamp: strtotime($user->ultimo_acesso));
            } else {
                $user->ultimo_acesso = '-';
            }
        }

        $userPerStatus = User::selectRaw('count(id) as total, status')
            ->groupBy('status')
            ->get();

        $userPerProfile = User::selectRaw('count(id) as total, acesso')
            ->groupBy('acesso')
            ->get();

        $lastAccess = User::where('ultimo_acesso', '!=', '')
            ->orderBy('ultimo_acesso', 'desc')
            ->limit(3)
            ->get();

        foreach ($lastAccess as $access) {
            $quebraNome = explode(' ', $access->nome);
            $access->nome = $quebraNome[0] . " " . end($quebraNome);
            $access->data_acesso = date('d/m/Y H:i', strtotime($access->ultimo_acesso));
        }

        return view('admin/users', ['users' => $users, 'userPerStatus' => $userPerStatus, 'userPerProfile' => $userPerProfile, 'lastAccess' => $lastAccess]);
    }

    private function formataCPF($cpf)
    {
        $cpfFormatado = preg_replace(
            '/(\d{3})(\d{3})(\d{3})(\d{2})/',
            '$1.$2.$3-$4',
            $cpf
        );
        return $cpfFormatado;
    }

    public function newUser()
    {
        return view('admin/newUser');
    }

    public function createUser(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required',
                'email' => 'required',
                'cpf' => 'required|min:14',
                'acesso' => 'required',
            ],
            [
                'nome.required' => 'O campo nome é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'cpf.required' => 'O campo CPF é obrigatório.',
                'cpf.min' => 'O CPF deve ter 11 números.',
                'acesso.required' => 'O campo nível de acesso é obrigatório.',
            ]
        );

        $nome = $request->input('nome');
        $email = $request->input('email');
        $cpf = str_replace(['.', '-'], '', $request->input('cpf'));
        $acesso = $request->input('acesso');
        $status = 'Ativo';
        $data = date('Y-m-d H:i:s');
        $senha = bcrypt('1234');

        $user = new User();
        $user->id = (string) Str::uuid();
        $user->nome = $nome;
        $user->email = $email;
        $user->cpf = $cpf;
        $user->acesso = $acesso;
        $user->status = $status;
        $user->criado_em = $data;
        $user->senha = $senha;
        $user->save();

        return redirect()->route('users');
    }

    public function editUser($id)
    {
        $user = User::find($id);

        return view('admin/editUser', ['user' => $user]);
    }

    public function saveUserEdit(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required',
                'email' => 'required',
                'cpf' => 'required|min:14',
                'acesso' => 'required',
            ],
            [
                'nome.required' => 'O campo nome é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'cpf.required' => 'O campo CPF é obrigatório.',
                'cpf.min' => 'O CPF deve ter 11 números.',
                'acesso.required' => 'O campo nível de acesso é obrigatório.',
            ]
        );

        User::where('id', '=', $request->input('id'))
            ->update([
                'nome' => $request->input('nome'),
                'email' => $request->input('email'),
                'cpf' => str_replace(['-', '.'], '', $request->input('cpf')),
                'acesso' => $request->input('acesso')
            ]);

        return redirect()->route('users');

    }

    public function disableUser($id)
    {
        $user = User::find($id);

        $user->status = "Inativo";
        $user->desativado_em = date('Y-m-d H:i:s');
        $user->desativado_por = session('user.nome');
        $user->save();

        return redirect()->route('users');
    }

    public function enableUser($id)
    {
        $user = User::find($id);

        $user->status = "Ativo";
        $user->desativado_em = null;
        $user->desativado_por = null;
        $user->save();

        return redirect()->route('users');
    }

    public function eventsAdmin()
    {
        $events = Event::with('user')->get();

        foreach ($events as $event) {
            $event->criado_por = $event->user->nome;

            $quebraNome = explode(' ', $event->criado_por);
            $event->criado_por = $quebraNome[0] . " " . end($quebraNome);
            $event->inscricao = isset($event->inscricao) ? 'R$' . number_format($event->inscricao, 2, ',', '.') : '-';
            $event->data = date('d/m/Y', strtotime($event->data));
            $event->horario = date('H:i', strtotime($event->horario));
            $event->data_criacao = date('d/m/Y', strtotime($event->criado_em));
        }

        $eventsPerStatus = Event::selectRaw('count(id) as total, status')
            ->groupBy('status')
            ->get();

        $eventsPerType = Event::selectRaw('count(id) as total, tipo')
            ->groupBy('tipo')
            ->orderBy('total', 'desc')
            ->get();

        $eventPerLocation = Event::selectRaw('locations.nome as nome, count(events.id) as total')
            ->join('locations', 'events.local_id', '=', 'locations.id')
            ->groupBy('locations.id', 'locations.nome')
            ->orderBy('locations.id')
            ->get();

        return view('admin.events', ['events' => $events, 'eventsPerStatus' => $eventsPerStatus, 'eventsPerType' => $eventsPerType, 'eventPerLocation' => $eventPerLocation]);

    }

    public function createEvent()
    {
        $locations = Location::orderBy('nome')->get();

        foreach ($locations as $location) {
            $location->id = (string) $location->id;
        }

        return view('admin.createEvent', ['locations' => $locations]);
    }

    public function createEventSubmit(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|min:10',
                'tipo' => 'required',
                'descricao' => 'required|min:20',
                'data' => 'required',
                'horario' => 'required',
                'local' => 'required',
                'imagem_agenda' => 'required',
                'imagem_detalhe' => 'required'
            ],
            [
                'nome.required' => 'É necessário informar o nome do evento. Ex: Culto de adoração',
                'nome.min' => 'O nome do evento deve possuir no mínimo 10 caracteres',
                'tipo.required' => 'É necessário informar o tipo de evento',
                'descricao.required' => 'É necessário informar uma descrição para o evento',
                'descricao.min' => 'A descrição deve possuir no mínimo 20 caracteres',
                'data.required' => 'É necessário informar a data do evento',
                // 'data.min' => 'Não é possível informar data inferiores a hoje',
                'horario.required' => 'É necessário informar o horário do evento',
                'local.required' => 'É necessário informar o local do evento',
                'imagem_agenda' => 'É necessário inserir a imagem que será exibida na agenda do site',
                'imagem_detalhe' => 'É necessário inserir a imagem que será inserida nos detalhes do evento'
            ]
        );

        $id = (string) Str::uuid();
        $nome = $request->input('nome');
        $tipo = $request->input('tipo');
        $descricao = $request->input('descricao');
        $data = $request->input('data');
        $horario = $request->input('horario');
        $local = $request->input('local');
        $inscricao = $request->input('valor');
        $inscricao = isset($inscricao) ? $this->formataValor($inscricao) : null;

        $imagem_agenda = Storage::disk('public')->put("uploads/events/$id/imagem_agenda", $request->file('imagem_agenda'));
        $imagem_detalhe = Storage::disk('public')->put("uploads/events/$id/imagem_detalhe", $request->file('imagem_detalhe'));

        $event = new Event();
        $event->id = $id;
        $event->nome = $nome;
        $event->descricao = $descricao;
        $event->tipo = $tipo;
        $event->data = $data;
        $event->horario = $horario;
        $event->local_id = $local;
        $event->inscricao = $inscricao;
        $event->imagem_agenda = $imagem_agenda;
        $event->imagem_detalhe = $imagem_detalhe;
        $event->criado_em = Carbon::now();
        $event->criado_por = session('user.id');
        $event->save();


        return redirect()->route('eventsAdmin');
    }

    private function formataValor($valor)
    {
        $valor = str_replace('.', '', $valor);
        $valorFormatado = str_replace(',', '.', $valor);

        return $valorFormatado;
    }

    public function editEvent($id)
    {
        $event = Event::find($id);

        $locations = Location::orderBy('nome')->get();

        foreach ($locations as $location) {
            $location->id = (string) $location->id;
        }

        return view('admin.editEvent', ['event' => $event, 'locations' => $locations]);
    }

    public function editEventSubmit(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|min:10',
                'tipo' => 'required',
                'descricao' => 'required|min:20',
                'data' => 'required',
                'horario' => 'required',
                'local' => 'required'
            ],
            [
                'nome.required' => 'É necessário informar o nome do evento. Ex: Culto de adoração',
                'nome.min' => 'O nome do evento deve possuir no mínimo 10 caracteres',
                'tipo.required' => 'É necessário informar o tipo de evento',
                'descricao.required' => 'É necessário informar uma descrição para o evento',
                'descricao.min' => 'A descrição deve possuir no mínimo 20 caracteres',
                'data.required' => 'É necessário informar a data do evento',
                'horario.required' => 'É necessário informar o horário do evento',
                'local.required' => 'É necessário informar o local do evento'
            ]
        );

        $id = $request->input('id');
        $nome = $request->input('nome');
        $tipo = $request->input('tipo');
        $descricao = $request->input('descricao');
        $data = $request->input('data');
        $horario = $request->input('horario');
        $local = $request->input('local');
        $inscricao = $request->input('valor');
        $inscricao = isset($inscricao) ? $this->formataValor($inscricao) : null;

        if ($request->file('imagem_agenda')) {
            $imagem_agenda = Storage::disk('public')->put("uploads/events/$id/imagem_agenda", $request->file('imagem_agenda'));
        } else {
            $imagem_agenda = null;
        }

        if ($request->file('imagem_detalhe')) {
            $imagem_detalhe = Storage::disk('public')->put("uploads/events/$id/imagem_detalhe", $request->file('imagem_detalhe'));
        } else {
            $imagem_detalhe = null;
        }

        Event::where('id', '=', $request->input('id'))
            ->update([
                'id' => $id,
                'nome' => $nome,
                'descricao' => $descricao,
                'tipo' => $tipo,
                'data' => $data,
                'horario' => $horario,
                'local_id' => $local,
                'inscricao' => $inscricao,
                'atualizado_em' => Carbon::now(),
                'atualizado_por' => session('user.id')
            ]);

        if ($imagem_agenda) {
            Event::where('id', '=', $request->input('id'))
                ->update([

                    'imagem_agenda' => $imagem_agenda,
                    'atualizado_em' => Carbon::now(),
                    'atualizado_por' => session('user.id')
                ]);
        }

        if ($imagem_detalhe) {
            Event::where('id', '=', $request->input('id'))
                ->update([
                    'imagem_detalhe' => $imagem_detalhe,
                    'atualizado_em' => Carbon::now(),
                    'atualizado_por' => session('user.id')
                ]);
        }


        return redirect()->route('eventsAdmin');
    }

    public function disableEvent($id)
    {
        Event::where('id', '=', $id)
            ->update([
                'status' => 'Inativo',
                'desativado_por' => session('user.id'),
                'desativado_em' => Carbon::now()
            ]);

        return redirect()->route('eventsAdmin');
    }

    public function enableEvent($id)
    {
        Event::where('id', '=', $id)
            ->update([
                'status' => 'Ativo',
                'desativado_por' => null,
                'desativado_em' => null
            ]);

        return redirect()->route('eventsAdmin');
    }


}
