<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'index',
            'show',
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
     * Show all topic in category
     *
     * @param  Request  $request
     * @param  Int      @id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $topics = App\Topic::where('category_id', $id)->orderBy('updated_at', 'desc')->get();
        $category = App\Category::all();

        return view('topic.index', ['topics' => $topics, 'category' => $category]);

    }

    /**
     * Show create category page
     *
     * @return Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store the new category
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:32|min:3',
            'description' => 'max:128|min:3',
        ], [
            'title.*' => 'หัวข้อต้องมีความยาว 3-32 ตัวอักษร',
            'description.*' => 'คำบรรยายต้องมีความยาว 3-128 ตัวอักษร',
        ]);

        $category = new App\Category;

        $category->title = $request->title;
        $category->description = $request->description;
        $category->status = 1;

        $category->save();

        return redirect()->action('CategoryController@create');
    }
}
