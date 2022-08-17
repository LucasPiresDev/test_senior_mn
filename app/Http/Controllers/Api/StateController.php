<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StateRequest;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
{
    public function index(Request $request)
    {
        return DataTables::eloquent(State::query())->make(true);
    }

    public function show(State $state)
    {
        return response($state);
    }

    public function store(StateRequest $request)
    {
        $state = new State($request->validated());

        if (!$state->save()) {
            return response(['message' => 'Erro ao tentar salvar estado!'], 500);
        }

        return response()->noContent();
    }

    public function update(StateRequest $request, State $state)
    {
        if (!$state->update($request->validated())) {
            return response(['message' => 'Erro ao tentar atualizar estado!'], 500);
        }
        
        return response()->noContent();
    }
    
    public function destroy(State $state)
    {
        if (!$state->delete()) {
            return response(['message' => 'Erro ao tentar excluir estado!'], 500);
        }

        return response()->noContent();
    }
    
}
