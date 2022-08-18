<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $columns = [
            ['title' => 'ID', 'field' => 'id', 'data' => 'id'],
            ['title' => 'Nome', 'field' => 'name', 'data' => 'name'],
            ['title' => 'Email', 'field' => 'email', 'data' => 'email'],
            ['field' => 'active', 'data' => 'active', 'visible' => false],
        ];

        return view('users.index', compact('columns'));
    }

    public function create()
    {
        $addresses = Address::query()
            ->get()
            ->map(function ($address) {
                return [
                    'label' => $address->street,
                    'value' => $address->id,
                ];
            });
        
        return view('users.create', compact('addresses'));
    }

    public function edit(User $user)
    {
        $addresses = Address::query()
            ->get()
            ->map(function ($address) {
                return [
                    'label' => $address->street,
                    'value' => $address->id,
                ];
            });
        
        return view('users.edit', compact('addresses', 'user'));
    }
}
