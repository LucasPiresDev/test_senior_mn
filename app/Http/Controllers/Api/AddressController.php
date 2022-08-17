<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        return DataTables::eloquent(Address::query()->with('city'))->make(true);
    }

    public function store(AddressRequest $request)
    {
        $city = new Address($request->validated());

        if (!$city->save()) {
            return response(['message' => 'Erro ao tentar salvar endereço!'], 500);
        }

        return response()->noContent();
    }

    public function update(AddressRequest  $request, Address $address)
    {
        if (!$address->update($request->validated())) {
            return response(['message' => 'Erro ao tentar atualizar endereço!'], 500);
        }

        return response()->noContent();
    }

    public function destroy(Address $address)
    {
        if (!$address->delete()) {
            return response(['message' => 'Erro ao tentar excluir endereço!'], 500);
        }

        return response()->noContent();
    }
}
