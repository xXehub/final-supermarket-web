<?php

namespace App\Http\Controllers\API;

use App\Exports\KategoriExport;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class KategoriController extends Controller
{
    public function index()
    { {
            $ingfo_sakkarepmu = "List Kategori";
            $kategori = Kategori::first();
            $jumlahProdukKeranjang = Keranjang::where('user_id', auth()->id())->count();
            return view('panel.kategori.index', [
                'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
                'kategori' => $kategori,
                'jumlahProdukKeranjang' => $jumlahProdukKeranjang
            ]);
        }
    }

    public function create()
    {
        $ingfo_sakkarepmu = 'Tambah Kategori';
        $produk = Kategori::all();
        $kategoris = Kategori::all();
        return view('panel.kategori.create', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'produks' => $produk,
            'kategoris' => $kategoris,
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
        return redirect()->route('kategori.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $ingfo_sakkarepmu = 'liat barang';
        $kategori = Kategori::find($id);
        return view('panel.kategori.show', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'kategori' => $kategori
        ]);
    }

    public function edit($id)
    {
        $ingfo_sakkarepmu = 'Edit Kategori';
        $kategori = Kategori::find($id);
        return view('panel.kategori.edit', compact('ingfo_sakkarepmu', 'kategori'));
    }

    public function update(Request $request, $id)
    { {
            $messages = [
                'required' => 'Attribute harus diisi',
                'nama_kategori' => 'Tidak boleh dikosongkan',
                'deskripsi' => 'Tidak boleh dikosongkan'
            ];
            $validator = Validator::make($request->all(), [
                'kode_kategori' => 'required|regex:/[A-Z]+/',
                'nama_kategori' => 'required',
                'deskripsi' => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $kategori = Kategori::find($id);
            $kategori->kode_kategori = $request->kode_kategori;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->deskripsi = $request->deskripsi;
            $kategori->save();
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate.');
        }

    }

    public function destroy($id)
    {
        Kategori::find($id)->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }

    // gawe getData 
    public function getData(Request $request)
    {
        $kategoris = Kategori::with('produk');

        if ($request->ajax()) {
            return datatables()->of($kategoris)
                ->addIndexColumn()
                ->addColumn('kode_kategori', function ($kategori) {
                    return $kategori->kode_kategori;
                })
                ->addColumn('nama_kategori', function ($kategori) {
                    return $kategori->nama_kategori;
                })
                ->addColumn('actions', function ($kategori) {
                    return view('panel.kategori.actions', compact('kategori'));
                })
                ->toJson();
        }
    }
    public function exportExcel()
    {
        return Excel::download(new KategoriExport, 'kategori.xlsx');
    }


}
