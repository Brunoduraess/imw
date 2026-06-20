<?php

namespace App\Http\Controllers;

use App\Services\AdminService;

class AdminController extends Controller
{
    public function __construct(
        private AdminService $adminService
    ) {}

    public function menu()
    {
        return view('admin/menu', $this->adminService->getMenuData());
    }
}
