@extends('layouts.app')

@section('content')
    <app-page-index
        :title="'Cidades'"
        :entity="'cities'"
        :url="'cities'"
        :columns="{{ json_encode($columns) }}"
    ></app-page-index>
@endsection
