<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        {
            $ingfo_sakkarepmu = "List Kategori";
            $kategori = Kategori::all();
            return view('panel.kategori.index', [
                'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
                'kategoris' => $kategori
            ]);
        }
    }

    public function create()
    {
        return view('panel.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kategori' => 'required|unique:kategori|max:20',
            'nama_kategori' => 'required|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        Kategori::create($request->all());
        return redirect()->route('panel.kategori.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $ingfo_sakkarepmu = 'liat barang';
        $kategori = Kategori::find($id);
        return view('satuan.show', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'kategoris' => $kategori
        ]);
    }

    public function edit($id)
    {
        $ingfo_sakkarepmu = 'Edit Kategori';
        $kategori = Kategori::find($id);
        return view('satuan.edit', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'kategoris' => $kategori
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_kategori' => 'required|max:20|unique:kategori,kode_kategori,' . $id,
            'nama_kategori' => 'required|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
        return redirect()->route('panel.kategori.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        Kategori::find($id)->delete();
        return redirect()->route('panel.kategori.index')->with('success', 'Category deleted successfully.');
    }
}
