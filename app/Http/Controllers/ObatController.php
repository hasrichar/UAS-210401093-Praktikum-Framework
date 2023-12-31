<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Obat;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('index', compact('obats'));
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $obats = Obat::where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        })

        ->orWhereHas('penyakit', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
        ->get();

        return view('index', compact('obats', 'search'));
    }
}
