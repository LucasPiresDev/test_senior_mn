<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $columns = [
            ['title' => 'ID', 'field' => 'id', 'data' => 'id'],
            ['title' => 'Rua', 'field' => 'street', 'data' => 'street'],
            ['title' => 'Número', 'field' => 'number', 'data' => 'number'],
            ['title' => 'Complemento', 'field' => 'complement', 'data' => 'complement'],
            ['title' => 'Cidade', 'field' => 'city.name', 'data' => 'city.name'],
        ];

        return view('addresses.index', compact('columns'));
    }

    public function create()
    {
        $cities = City::query()
            ->get()
            ->map(function($city) {
                return [
                    'label' => $city->name,
                    'value' => $city->id,
                ];
            });

        return view('addresses.create', compact('cities'));
    }

    public function edit(Address $address)
    {
        $cities = City::query()
            ->get()
            ->map(function($city) {
                return [
                    'label' => $city->name,
                    'value' => $city->id,
                ];
            });

        return view('addresses.edit', compact('cities', 'address'));
    }
}
