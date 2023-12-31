<?php

namespace App\Http\Controllers;
use App\Models\Obat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('home', ['obats' => $obats]);
    }
}