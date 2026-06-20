<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    public function users()
    {
        return view('admin/users', $this->userService->getDashboardData());
    }

    public function newUser()
    {
        return view('admin/newUser');
    }

    public function createUser(StoreUserRequest $request)
    {
        $this->userService->create($request->validated());

        return redirect()->route('users');
    }

    public function editUser(string $id)
    {
        return view('admin/editUser', ['user' => $this->userService->find($id)]);
    }

    public function saveUserEdit(UpdateUserRequest $request)
    {
        $this->userService->update($request->validated());

        return redirect()->route('users');
    }

    public function disableUser(string $id)
    {
        $this->userService->disable($id, auth()->user()->nome);

        return redirect()->route('users');
    }

    public function enableUser(string $id)
    {
        $this->userService->enable($id);

        return redirect()->route('users');
    }
}
