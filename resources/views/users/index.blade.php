@extends('layouts.app')

@section('content')
    <app-page-index
        :title="'Usuários'"
        :entity="'users'"
        :url="'users'"
        :columns="{{ json_encode($columns) }}"
    ></app-page-index>
@endsection
