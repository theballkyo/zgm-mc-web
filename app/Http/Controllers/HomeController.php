<?php

namespace App\Http\Controllers;

use App\Minecraft\MinecraftServerStatus;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'index'
        ]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {

        return view('home');
    }

    /**
     * Show the website home page
     *
     * @return Response
     */
    public function welcome()
    {

        return view('home');
    }
}
