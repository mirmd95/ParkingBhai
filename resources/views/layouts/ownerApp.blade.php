<?php 
 namespace App\Http\Controllers;
Use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use App\Application;
use App\Space_information;
use App\Calculated_cost;
use Auth;
use DB;

$a = Application::all()->where('owner_id',Auth::id())->where('status',0)->count();

?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    .container{
        margin-top: 20px;
    }
    .foods{
        text-align: center;
        margin-top: 10px;

    }
    h1{
        padding-top: 10px;
    }
    h2{
        color: #3D99A3;
        padding-bottom: 27px;
    }
    h5{
        padding-top: 8px;
        padding-bottom: 20px;
    }
    h6{
        text-align: right;
    }
  h4{
    padding-top: 10px;

  }
    img{
         border: 1px solid #ddd;
        border-radius: 4px;
    }
    .welcometext{
        text-align: center;
    }
    .card{
        margin-top: 10px;
        margin-bottom: 5px;
        border: 4px 4px 4px 4px;
    }
</style>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ 'ParkingBy' }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{__('Register')}} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        {{ __('Owner Registation') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('driver.reg.form') }}">
                                        {{ __('Driver Registation') }}
                                    </a>
                                </div>
                                </li>
                            @endif
                        @else
                            <a class="navbar-brand" href="{{ route('home') }}">
                                {{ 'Home' }}
                             </a>
                             <a class="navbar-brand" href="{{ route('owner_notifications') }}">
                                {{ 'Notification' }}<b style="color: red;"><?php if($a>0) echo '(',$a,')' ?></b>
                             </a>
                             <a class="navbar-brand" href="{{ route('active.park') }}">
                                {{ 'Active Park' }}
                             </a>
                             <a class="navbar-brand" href="{{ route('owner_record') }}">
                                {{ 'Record' }}
                             </a>
                             <a class="navbar-brand" href="{{ route('about') }}">
                                {{ 'Aboutus' }}
                             </a>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <main class="py-4">
        @if(session()->has('message'))
                <div class="alert">
                    <p style="text-align: center;">{{  session()->pull('message') }}</p>
                </div>
            @endif
        @yield('content')
    </main>
    @extends('layouts.footer')
</body>
</html>
