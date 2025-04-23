<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function about()
    {
        return view('about');
    }
    public function projects()
    {
        return view('projects');
    }

    public function project_detail($tipo)
    {
        if ($tipo == 'educacional') {
            $nome = 'Projeto Segunda Chance';
            $img = 'educacional';
            $descricao = 'O Projeto Segunda Chance foi criado com a finalidade de oferecer cursos acessíveis à comunidade residente nas proximidades da igreja, bem como aos membros. Esta iniciativa visa promover o desenvolvimento pessoal dos participantes, proporcionando-lhes oportunidades de aprendizado e crescimento. Acreditamos que, ao facilitar o acesso à educação e à capacitação, estamos contribuindo para a melhoria da qualidade de vida e o fortalecimento da comunidade como um todo. O projeto busca, portanto, ser um agente transformador, ajudando as pessoas a desenvolverem suas habilidades e potencialidades em um ambiente acolhedor e de apoio.';
        } else {
            $nome = 'GCEU';
            $img = 'externo';
            $descricao = 'O GCEU é muito mais do que um grupo, é uma família espiritual comprometida com o crescimento pessoal, a comunhão e a missão de compartilhar o amor de Cristo. Inspirados pela visão de construir relacionamentos sólidos e fortalecer a fé, os encontros do GCEU oferecem um espaço acolhedor onde cada pessoa é valorizada e encorajada a viver plenamente o propósito de Deus.
            Por meio de momentos de estudo da Palavra, oração, louvor e evangelização prática, o GCEU busca não apenas edificar seus participantes, mas também alcançar vidas e impactar a comunidade ao nosso redor. Juntos, cultivamos unidade, apoio mútuo e uma fé que transforma corações e gera frutos para o Reino.
            Venha fazer parte do GCEU e experimente um ambiente de crescimento espiritual, amizade verdadeira e compromisso com a missão de levar o Evangelho a todos os lugares!';
        }

        return view('project_detail', ['tipo' => $tipo, 'nome' => $nome, 'img' => $img, 'descricao' => $descricao]);
    }

    public function events()
    {
        return view('events');
    }

    public function event_detail()
    {
        return view('event_detail');
    }

    public function contact()
    {
        return view('contact');
    }

    public function menu()
    {
        return view('admin/menu');
    }

    public function users()
    {
        $users = User::orderBy('nome', 'asc')->get();

        foreach ($users as $user) {
            $user->cpf = $this->formataCPF($user->cpf);
        }

        return view('admin/users', ['users' => $users]);
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
        $data = Carbon::now()->format('Y-m-d H:i:s');
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

}
