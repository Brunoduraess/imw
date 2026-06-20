<?php

namespace App\Http\Controllers;

use App\Managers\FileManager;

class AdminController extends Controller
{
    public function __construct(
        private FileManager $fileManager
    ) {}

    public function menu()
    {
        $logoEventos = $this->fileManager->url('admin/detalhe_evento.png');
        $logoProjetos = $this->fileManager->url('admin/detalhe_projeto_externo.png');
        $logoUsuarios = $this->fileManager->url('admin/midia.png');

        return view('admin/menu', compact('logoEventos', 'logoProjetos', 'logoUsuarios'));
    }
}
