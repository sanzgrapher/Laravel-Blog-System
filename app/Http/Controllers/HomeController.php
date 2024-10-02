<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // get the login user and the articles of the user
        $user_id = Auth::user()->id;


        $articles = Article::where('user_id', $user_id)->paginate(12);

        // get total posted article by user and total comments on all the articles
        $total_articles = Article::where('user_id', $user_id)->count();




        return view('home', ['articles' => $articles, 'total_articles' => $total_articles]);
    }
}
