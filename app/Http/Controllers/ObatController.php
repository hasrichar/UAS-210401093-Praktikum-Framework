<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Obat;
use App\Models\Penyakit;

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

    public function create()
    {
        // You may need to adjust this based on your actual relationships
        $penyakits = Penyakit::all();

        return view('obats.create', compact('penyakits'));
    }

    // Store a newly created obat in the database
    public function store(Request $request)
{
    // Validate and store the new obat
    $validatedData = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'penyakit_id' => 'required',
        'new_penyakit' => 'nullable|string', 
    ]);

    if ($validatedData['penyakit_id'] == '+Tambah Penyakit') {
        $newPenyakit = Penyakit::create([
            'name' => $validatedData['new_penyakit'],
        ]);

        $validatedData['penyakit_id'] = $newPenyakit->id;
    }

    Obat::create($validatedData);

    return redirect()->route('obats.index')->with('success', 'Obat added successfully!');
}

public function destroy(Obat $obat)
    {
        // Delete the obat
        $obat->delete();

        return redirect()->route('obats.index')->with('success', 'Obat deleted successfully!');
    }

    // Edit obat 
    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        $penyakits = Penyakit::all();

        return view('obats.edit', compact('obat', 'penyakits'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'penyakit_id' => 'required',
            'new_penyakit' => 'nullable|string',
        ]);

        if ($validatedData['penyakit_id'] == '+Tambah Penyakit') {
            $newPenyakit = Penyakit::create([
                'name' => $validatedData['new_penyakit'],
            ]);

            $validatedData['penyakit_id'] = $newPenyakit->id;
        }

        $obat = Obat::findOrFail($id);
        $obat->update($validatedData);

        return redirect()->route('obats.index')->with('success', 'Data updated successfully!');
    }
}
