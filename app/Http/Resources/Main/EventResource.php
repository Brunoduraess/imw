<?php

namespace App\Http\Resources\Main;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $date = new DateTime($this->data);

        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'data' => $date->format('d').' de '.$this->monthName((int) $date->format('m')),
            'horario' => (new DateTime($this->horario))->format('H:i'),
            'imagem_agenda' => $this->imagem_agenda,
            'imagem_detalhe' => $this->imagem_detalhe,
            'inscricao' => $this->inscricao,
        ];
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
