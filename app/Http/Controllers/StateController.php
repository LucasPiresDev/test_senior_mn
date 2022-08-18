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
            ['field' => 'active', 'data' => 'active', 'visible' => false],
            ['field' => 'code', 'data' => 'code', 'visible' => false],
            ['field' => 'country', 'data' => 'country', 'visible' => false],
        ];

        $states = State::query();
        $codes = $states
            ->get()
            ->map(function ($state) {
                return [
                    'value' => $state->code,
                    'label' => $state->code,
                ];
            });

        $countries = $states
            ->select('country')
            ->groupBy('country')
            ->get()
            ->map(function ($state) {
            return [
                'value' => $state->country,
                'label' => $state->country,
            ];
        });

        return view('states.index', compact('columns', 'codes', 'countries'));
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
