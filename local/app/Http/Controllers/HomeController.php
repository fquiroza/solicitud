<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware;
use Redirect;

class HomeController extends Controller
{   

	public function __construct()
    {
        $this->middleware('user');
    }

    public function index()
    {
        return View('home');
    }

}
