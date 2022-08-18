<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $columns = [
            ['title' => 'ID', 'field' => 'id', 'data' => 'id'],
            ['title' => 'Nome', 'field' => 'name', 'data' => 'name'],
            ['title' => 'Estado', 'field' => 'state.code', 'data' => 'state.code'],
            ['field' => 'active', 'data' => 'active', 'visible' => false],
            ['field' => 'state.code', 'data' => 'state_id', 'visible' => false],
        ];

        $states = State::query()
            ->get()
            ->map(function ($state) {
                return [
                    'value' => $state->id,
                    'label' => $state->code,
                ];
            });

        return view('cities.index', compact('columns', 'states'));
    }

    public function create()
    {
        $states = State::query()
            ->get()
            ->map(function ($state) {
                return [
                    'value' => $state->id,
                    'label' => $state->name,
                ];
            });

        return view('cities.create', compact('states'));
    }

    public function edit(City $city)
    {
        $states = State::query()
            ->get()
            ->map(function ($state) {
                return [
                    'value' => $state->id,
                    'label' => $state->name,
                ];
            });

        return view('cities.edit', compact('states', 'city'));
    }
}
