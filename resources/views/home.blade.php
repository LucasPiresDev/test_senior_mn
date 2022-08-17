@extends('layouts.app')

@section('content')
    <app-dashboard
        :counts="{
            totalUsers: {{ $totalUsers }},
            totalStates: {{ $totalStates }},
            totalCities: {{ $totalCities }},
            totalAddresses: {{ $totalAddresses }},
        }"
        user-name="Lucas Pires"
        date="{{ \Carbon\Carbon::now()->isoFormat('dddd, DD [de] MMMM [de] YYYY') }}"
    ></app-dashboard>
@endsection
