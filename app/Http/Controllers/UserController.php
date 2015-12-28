<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
    }

    /**
     *
     * Show edit profile user
     *
     * @return Responseg
     */
    public function getEdit(Request $request)
    {
        
    }

    /**
     *
     * Edit profile user
     *
     * @return Response
     */
    public function postEdit(Request $request)
    {

    }

}
