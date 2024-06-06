<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    { {
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
        $ingfo_sakkarepmu = 'Tambah Kategori';
        $produk = Kategori::all();
        return view('panel.kategori.create', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'produks' => $produk,
            
        ]);
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
        return view('kategori.show', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'kategoris' => $kategori
        ]);
    }

    public function edit($id)
    {
        $ingfo_sakkarepmu = 'Edit Kategori';
        $kategori = Kategori::find($id);
        return view('kategori.edit', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request, $id)
    { {
            $messages = [
                'required' => 'Attribute harus diisi',
            ];
            $validator = Validator::make($request->all(), [
                'kode_kategori' => 'required|regex:/[A-Z]+/',
                'nama_kategori' => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $kategori = Kategori::find($id);
            $kategori->kode_kategori = $request->kode_kategori;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->save();
            return redirect()->route('panel.kategori.index')->with('success', 'Category updated successfully.');
        }

    }

    public function destroy($id)
    {
        Kategori::find($id)->delete();
        return redirect()->route('panel.kategori.index')->with('success', 'Category deleted successfully.');
    }
}
