@extends('layouts.app')

@section('content')
    <app-page-index
        :title="'Usuários'"
        :entity="'users'"
        :url="'users'"
        :columns="{{ json_encode($columns) }}"
        :indexstatusfilter="3"
    ></app-page-index>
@endsection
