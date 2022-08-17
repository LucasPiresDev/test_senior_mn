<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $totalUsers = User::all()->count();
        $totalStates = State::all()->count();
        $totalCities = City::all()->count();
        $totalAddresses = Address::all()->count();

        return view('home', compact('totalUsers', 'totalStates', 'totalCities', 'totalAddresses'));
    }
}
