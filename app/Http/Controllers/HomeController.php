<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('biblioteca.index');
    }

    public function admin()
    {
        return view('home.index');
    }

    public function wp_redirect()
    {
        return redirect()->route('site.index');
    }

    public function about()
    {
        return view('biblioteca.about');
    }

    public function levels()
    {
        return view('biblioteca.levels.index');
    }

    public function kinder()
    {
        return view('biblioteca.levels.kinder');
    }

    public function primaria()
    {
        return view('biblioteca.levels.primaria');
    }

    public function secundaria()
    {
        return view('biblioteca.levels.secundaria');
    }

    public function prepa()
    {
        return view('biblioteca.levels.prepa');
    }

    public function language()
    {
        return view('biblioteca.levels.language');
    }

    public function viajes()
    {
        return view('biblioteca.levels.viajes');
    }

    public function logros()
    {
        return view('biblioteca.logros');
    }

    public function instalaciones()
    {
        return view('biblioteca.instalaciones');
    }

    public function contact()
    {
        return view('biblioteca.contact');
    }
}
