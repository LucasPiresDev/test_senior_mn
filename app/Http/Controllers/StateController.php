<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $columns = [
            ['title' => __('ID'), 'field' => 'id', 'data' => 'id'],
            ['title' => __('Name'), 'field' => 'name', 'data' => 'name'],
            ['title' => __('Código'), 'field' => 'code', 'data' => 'code'],
            ['title' => __('País'), 'field' => 'country', 'data' => 'country'],
            ['field' => 'created_at', 'data' => 'created_at', 'visible' => false],
        ];

        return view('states.index', compact('columns'));
    }

    public function create()
    {
        return view('states.create');
    }

    public function edit(State $state)
    {
        return view('states.edit', compact('state'));
    }
}
