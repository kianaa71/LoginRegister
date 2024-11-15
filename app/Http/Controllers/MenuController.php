<?php

namespace App\Http\Controllers;

use App\Models\MenuModel;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = MenuModel::all();
        return view('dashboard', compact('menuItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
        ]);

        MenuModel::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Berhasil Menambahkan Menu Baru');
    }

    public function show()
    {
        
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
        ]);

        $menuItem = MenuModel::findOrFail($id);
        $menuItem->update($request->all());

        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        $menuItem = MenuModel::findOrFail($id);
        $menuItem->delete();

        return redirect()->route('dashboard');
    }
}
