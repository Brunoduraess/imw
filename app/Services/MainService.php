<?php

namespace App\Services;

use App\Mail\ContactMail;
use App\Managers\FileManager;
use App\Models\Event;
use App\Models\Location;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MainService
{
    public function __construct(
        private FileManager $fileManager
    ) {}

    public function getHomeData(): array
    {
        return [
            'imagens' => [
                'home_1' => $this->fileManager->url('configuracoes/home_1.svg'),
                'home_1_mobile' => $this->fileManager->url('configuracoes/home_1_mobile.svg'),
                'home_2' => $this->fileManager->url('configuracoes/home_2.svg'),
                'home_2_mobile' => $this->fileManager->url('configuracoes/home_2_mobile.svg'),
                'home_3' => $this->fileManager->url('configuracoes/home_3.svg'),
                'home_3_mobile' => $this->fileManager->url('configuracoes/home_3_mobile.svg'),
            ],
        ];
    }

    public function getAboutData(): array
    {
        return ['imagemSobre' => $this->fileManager->url('admin/sobre.png')];
    }

    public function getProjectDetailData(string $type): array
    {
        if ($type === 'educacional') {
            return [
                'tipo' => $type,
                'nome' => 'Projeto Segunda Chance',
                'img' => 'educacional',
                'descricao' => 'O Projeto Segunda Chance foi criado com a finalidade de oferecer cursos acessíveis à comunidade residente nas proximidades da igreja, bem como aos membros. Esta iniciativa visa promover o desenvolvimento pessoal dos participantes, proporcionando-lhes oportunidades de aprendizado e crescimento. Acreditamos que, ao facilitar o acesso à educação e à capacitação, estamos contribuindo para a melhoria da qualidade de vida e o fortalecimento da comunidade como um todo. O projeto busca, portanto, ser um agente transformador, ajudando as pessoas a desenvolverem suas habilidades e potencialidades em um ambiente acolhedor e de apoio.',
            ];
        }

        return [
            'tipo' => $type,
            'nome' => 'GCEU',
            'img' => 'externo',
            'descricao' => 'O GCEU é muito mais do que um grupo, é uma família espiritual comprometida com o crescimento pessoal, a comunhão e a missão de compartilhar o amor de Cristo. Inspirados pela visão de construir relacionamentos sólidos e fortalecer a fé, os encontros do GCEU oferecem um espaço acolhedor onde cada pessoa é valorizada e encorajada a viver plenamente o propósito de Deus.
            Por meio de momentos de estudo da Palavra, oração, louvor e evangelização prática, o GCEU busca não apenas edificar seus participantes, mas também alcançar vidas e impactar a comunidade ao nosso redor. Juntos, cultivamos unidade, apoio mútuo e uma fé que transforma corações e gera frutos para o Reino.
            Venha fazer parte do GCEU e experimente um ambiente de crescimento espiritual, amizade verdadeira e compromisso com a missão de levar o Evangelho a todos os lugares!',
        ];
    }

    public function getEventsData(): array
    {
        $today = new DateTime;
        $dayOfWeek = (int) $today->format('w');
        $currentWeekStart = clone $today;
        $currentWeekEnd = clone $today;

        if ($dayOfWeek !== 0) {
            $currentWeekEnd->modify('+'.(7 - $dayOfWeek).' days');
        }

        $currentWeekEvents = Event::where('status', 'Ativo')
            ->whereBetween('data', [$currentWeekStart, $currentWeekEnd])
            ->get();

        $nextWeekStart = clone $currentWeekEnd;
        $nextWeekStart->modify('+1 day');
        $nextWeekEnd = clone $nextWeekStart;
        $nextWeekEnd->modify('+6 days');

        $nextWeekEvents = Event::where('status', 'Ativo')
            ->whereBetween('data', [$nextWeekStart, $nextWeekEnd])
            ->get();

        $nextMonth = clone $today;
        $nextMonth->modify('+1 month');

        $nextMonthEvents = Event::where('status', 'Ativo')
            ->whereMonth('data', $nextMonth->format('m'))
            ->get();

        $this->formatEvents($currentWeekEvents);
        $this->formatEvents($nextWeekEvents);
        $this->formatEvents($nextMonthEvents);

        return [
            'eventosSemanaAtual' => $currentWeekEvents,
            'eventosProximaSemana' => $nextWeekEvents,
            'eventosProximoMes' => $nextMonthEvents,
        ];
    }

    public function getEventDetailData(string $id): array
    {
        $event = Event::find($id);
        $location = Location::find($event->local_id);
        $this->formatEvent($event);

        return [
            'evento' => $event,
            'local' => $location,
        ];
    }

    public function getContactData(): array
    {
        return ['imagemContato' => $this->fileManager->url('admin/fale_conosco.svg')];
    }

    public function sendContact(array $data): void
    {
        $treatedPhone = Str::replace(['(', ')', '-', ' '], '', $data['telefone']);

        Mail::to('contato@imwve.com.br')
            ->bcc('brunoduraes03@gmail.com')
            ->send(new ContactMail(
                $data['nome'],
                $data['telefone'],
                $treatedPhone,
                $data['assunto'],
                $data['mensagem'],
            ));
    }

    private function formatEvents(Collection $events): void
    {
        foreach ($events as $event) {
            $this->formatEvent($event);
        }
    }

    private function formatEvent(Event $event): void
    {
        $date = new DateTime($event->data);
        $event->data = $date->format('d').' de '.$this->monthName((int) $date->format('m'));
        $event->horario = (new DateTime($event->horario))->format('H:i');
    }

    private function monthName(int $month): string
    {
        return [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro',
        ][$month];
    }
}
