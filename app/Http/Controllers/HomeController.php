<?php

namespace App\Http\Controllers;

use App;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth', ['only' => [
			'index',
		]]);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return Response
	 */
	public function index() {
		return welcome();
	}

	/**
	 * Show the website home page
	 *
	 * @return Response
	 */
	public function welcome() {
		$topics = App\Topic::news()->orderBy('updated_at', 'desc')->get();
		$authme = App\Authme::with('fe')->orderBy('lastlogin', 'desc')->get();
		// dd($authme);
		$users = $authme->
		return view('home', ['topics' => $topics, 'authme' => $authme]);
	}
}
