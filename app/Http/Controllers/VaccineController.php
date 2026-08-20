<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    public function index()
    {
        $query = Vaccine::query();
        if (auth()->user()->wilker !== 'Kantor Induk') {
            $query->where('user_id', auth()->id());
        }
        $vaccines = $query->get();
        return view('vaccines.index', compact('vaccines'));
    }

    public function create()
    {
        return view('vaccines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
        ]);

        Vaccine::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('vaccines.index')->with('success', 'Jenis vaksin berhasil ditambahkan.');
    }

    public function edit(Vaccine $vaccine)
    {
        // Simple auth check
        if (auth()->user()->wilker !== 'Kantor Induk' && $vaccine->user_id !== auth()->id()) {
            abort(403);
        }
        return view('vaccines.edit', compact('vaccine'));
    }

    public function update(Request $request, Vaccine $vaccine)
    {
        if (auth()->user()->wilker !== 'Kantor Induk' && $vaccine->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
        ]);

        $vaccine->update($request->only(['name', 'stock']));

        return redirect()->route('vaccines.index')->with('success', 'Data vaksin berhasil diperbarui.');
    }

    public function destroy(Vaccine $vaccine)
    {
        if (auth()->user()->wilker !== 'Kantor Induk' && $vaccine->user_id !== auth()->id()) {
            abort(403);
        }
        
        $vaccine->delete();
        return redirect()->route('vaccines.index')->with('success', 'Data vaksin berhasil dihapus.');
    }
}
