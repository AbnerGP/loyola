<?php

namespace App\Http\Controllers;

use App\Objects\Select;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function new() {
        $levels = Select::create(Config('constants.levels'));
        return view('biblioteca.request', compact('levels'));
    }

    public function store() {
        request()->validate([
            'type' => 'required|integer',
            'level' => 'required|string',
            'name' => 'required|string',
            'last_name' => 'required|string',
            'mat_last_name' => 'required|string',

        ]);
    }
}
