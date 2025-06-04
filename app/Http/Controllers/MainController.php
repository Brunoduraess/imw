<?php

namespace App\Http\Controllers;

use App\Mail\contactMail;
use App\Models\Event;
use App\Models\Location;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

date_default_timezone_set('America/Bahia');

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

        $hoje = new DateTime();

        $diaSemana = (int) $hoje->format('w');

        $inicioSemanaAtual = clone $hoje;
        $fimSemanaAtual = clone $hoje;
        if ($diaSemana !== 0) {
            $diasParaDomingo = 7 - $diaSemana;
            $fimSemanaAtual->modify("+$diasParaDomingo days");
        }

        $eventosSemanaAtual = Event::where('status', '=', 'Ativo')->whereBetween('data', [$inicioSemanaAtual, $fimSemanaAtual])->get();

        foreach ($eventosSemanaAtual as $eventoSemanaAtual) {
            $data = new DateTime($eventoSemanaAtual->data);
            $mes = $data->format('m');
            $dia = $data->format('d');
            $eventoSemanaAtual->data = $dia . " de " . $this->getMes($mes);

            $horario = new DateTime($eventoSemanaAtual->horario);
            $eventoSemanaAtual->horario = $horario->format('H:i');
        }

        $inicioProximaSemana = clone $fimSemanaAtual;
        $inicioProximaSemana->modify('+1 day');

        $fimProximaSemana = clone $inicioProximaSemana;
        $fimProximaSemana->modify('+6 days');

        $eventosProximaSemana = Event::where('status', '=', 'Ativo')->whereBetween('data', [$inicioProximaSemana, $fimProximaSemana])->get();


        foreach ($eventosProximaSemana as $eventoProximaSemana) {
            $data = new DateTime($eventoProximaSemana->data);
            $mes = $data->format('m');
            $dia = $data->format('d');
            $eventoProximaSemana->data = $dia . " de " . $this->getMes($mes);

            $horario = new DateTime($eventoProximaSemana->horario);
            $eventoProximaSemana->horario = $horario->format('H:i');
        }

        $mesAtual = clone $hoje;
        $proximoMes = clone $hoje;

        $proximoMes->modify('+1 month');

        $mesAtual->format('m');
        $proximoMes->format('m');

        $eventosProximoMes = Event::where('status', '=', 'Ativo')->whereMonth('data', $proximoMes)->get();


        foreach ($eventosProximoMes as $eventoProximoMes) {
            $data = new DateTime($eventoProximoMes->data);
            $mes = $data->format('m');
            $dia = $data->format('d');
            $eventoProximoMes->data = $dia . " de " . $this->getMes($mes);

            $horario = new DateTime($eventoProximoMes->horario);
            $eventoProximoMes->horario = $horario->format('H:i');
        }

        return view('events', ['eventosSemanaAtual' => $eventosSemanaAtual, 'eventosProximaSemana' => $eventosProximaSemana, 'eventosProximoMes' => $eventosProximoMes]);
    }

    private function getMes($numeroMes): string
    {
        switch ($numeroMes) {
            case 1:
                $mesDescrito = 'Janeiro';
                break;
            case 2:
                $mesDescrito = 'Fevereiro';
                break;
            case 3:
                $mesDescrito = 'Março';
                break;
            case 4:
                $mesDescrito = 'Abril';
                break;
            case 5:
                $mesDescrito = 'Maio';
                break;
            case 6:
                $mesDescrito = 'Junho';
                break;
            case 7:
                $mesDescrito = 'Julho';
                break;
            case 8:
                $mesDescrito = 'Agosto';
                break;
            case 9:
                $mesDescrito = 'Setembro';
                break;
            case 10:
                $mesDescrito = 'Outubro';
                break;
            case 11:
                $mesDescrito = 'Novembro';
                break;
            case 12:
                $mesDescrito = 'Dezembro';
                break;
        }

        return $mesDescrito;
    }

    public function event_detail($id)
    {
        $evento = Event::find($id);

        $local = Location::find($evento->local_id);

        $data = new DateTime($evento->data);
        $mes = $data->format('m');
        $dia = $data->format('d');
        $evento->data = $dia . " de " . $this->getMes($mes);

        $horario = new DateTime($evento->horario);
        $evento->horario = $horario->format('H:i');


        return view('event_detail', ['evento' => $evento, 'local' => $local]);
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|string|max:100',
                'telefone' => 'required|string|max:15',
                'email' => 'required|email|max:100',
                'assunto' => 'required|string',
                'mensagem' => 'required|string',
            ],
            [
                'nome.required' => 'O campo nome é obrigatório.',
                'telefone.required' => 'O campo telefone é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'assunto.required' => 'O campo assunto é obrigatório.',
                'mensagem.required' => 'O campo mensagem é obrigatório.',
            ]
        );

        $nome = $request->input('nome');
        $telefone = $request->input('telefone');
        $telefoneTratado = Str::replace(['(', ')', '-', ' '], '', $telefone);
        $assunto = $request->input('assunto');
        $mensagem = $request->input('mensagem');
        $email = 'contato@imwve.com.br';

        Mail::to($email)->bcc('brunoduraes03@gmail.com')->send(new contactMail($nome, $telefone, $telefoneTratado, $assunto, $mensagem));

        return redirect()->route('confirm');
    }

    public function confirm()
    {
        return view('confirm');
    }

}
