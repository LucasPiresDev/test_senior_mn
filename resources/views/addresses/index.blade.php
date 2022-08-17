@extends('layouts.app')

@section('content')
    <app-page-index
        :title="'Endereços'"
        :entity="'addresses'"
        :url="'addresses'"
        :columns="{{ json_encode($columns) }}"
    ></app-page-index>
@endsection
