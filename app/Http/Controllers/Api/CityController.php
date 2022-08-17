<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        return DataTables::eloquent(City::query()->with('state'))->make(true);
    }

    public function store(CityRequest $request)
    {
        $city = new City($request->validated());

        if (!$city->save()) {
            return response(['message' => 'Erro ao tentar salvar cidade!'], 500);
        }

        return response()->noContent();
    }

    public function update(CityRequest  $request, City $city)
    {
        if (!$city->update($request->validated())) {
            return response(['message' => 'Erro ao tentar atualizar cidade!'], 500);
        }

        return response()->noContent();
    }

    public function destroy(City $city)
    {
        if (!$city->delete()) {
            return response(['message' => 'Erro ao tentar excluir cidade!'], 500);
        }

        return response()->noContent();
    }
}
