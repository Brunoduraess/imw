<?php

namespace App\Services;

use App\Managers\FileManager;

class AdminService
{
    public function __construct(
        private FileManager $fileManager
    ) {}

    public function getMenuData(): array
    {
        return [
            'logoEventos' => $this->fileManager->url('admin/detalhe_evento.png'),
            'logoProjetos' => $this->fileManager->url('admin/detalhe_projeto_externo.png'),
            'logoUsuarios' => $this->fileManager->url('admin/midia.png'),
        ];
    }
}
