<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return DataTables::eloquent(User::query()->with('address'))->make(true);
    }

    public function store(UserRequest $request)
    {
        $password = Hash::make($request->password);
        $data = $request->validated();
        $data['password'] = $password;
        $user = new User($data);
        
        if (!$user->save()) {
            return response(['message' => 'Erro ao tentar salvar usuário!'], 500);
        }

        return response()->noContent();
    }

    public function update(UserRequest $request, User $user)
    {
        if (!$user->update($request->validated())) {
            return response(['message' => 'Erro ao tentar atualizar usuário!'], 500);
        }

        return response()->noContent();
    }

    public function destroy(User $user)
    {
        if (!$user->delete()) {
            return response(['message' => 'Erro ao tentar deletar usuário!'], 500);
        }

        return response()->noContent();
    }
}
