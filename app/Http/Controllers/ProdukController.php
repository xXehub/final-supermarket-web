<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


use DataTables;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // gawe list produk
        $ingfo_sakkarepmu = "Data List Produk";
        $kategori = Kategori::All();
        // confirmDelete();

        return view('panel.produk.index', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'kategoris' => $kategori
        ]);
        // return view('panel.produk.index', compact('ingfo_sakkarepmu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingfo_sakkarepmu = 'Tambah Produk';
        $kategori = Kategori::all();

        return view('panel.produk.create', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'kategoris' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // gawe message dan validasi
        {
            $messages = [
                'required' => 'Attribute harus diisi',
                'email' => 'Isi :attribute dengan format yang benar',
                'numeric' => 'Isi :attribute dengan angka'
            ];
            $validator = Validator::make($request->all(), [
                'kode_produk' => 'required',
                'nama_produk' => 'required',
                'harga' => 'required|numeric',
                'kategori_id' => 'required',
                'stock' => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $produk = new Produk();
            $produk->kode_produk = $request->kode_produk;
            $produk->nama_produk = $request->nama_produk;
            $produk->harga = $request->harga;
            $produk->kategori_id = $request->kategori_id;
            $produk->stock = $request->stock;
            $produk->save();

            return redirect()->route('produk.index')->with('simpan', 'Barang berhasil ditambahkan.');
            // return redirect()->route('panel.produk.produk.index')->with('success', 'Produk berhasil ditambahkan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingfo_sakkarepmu = 'Employee Detail';

        // ELOQUENT
        $produk = Produk::find($id);

        return view('produk.show', compact('ingfo_sakkarepmu', 'produk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::find($id);
        $kategoris = Kategori::all(); // retrieve all categories
        return view('panel.produk.edit', compact('produk', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { {
            $messages = [
                'required' => 'Attribute harus diisi',
            ];
            $validator = Validator::make($request->all(), [
                'kode_produk' => 'required|regex:/[A-Z]+/',
                'nama_produk' => 'required',
                'harga' => 'required|numeric',
                'kategori_id' => 'required',
                'stock' => 'required'
            ], $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $produk = Produk::find($id);
            $produk->kode_produk = $request->kode_produk;
            $produk->nama_produk = $request->nama_produk;
            $produk->harga = $request->harga;
            $produk->kategori_id = $request->kategori_id;
            $produk->stock = $request->stock;
            $produk->save();

            // sweet alert
            return redirect()->route('produk.index')->with('simpan', 'Barang berhasil dihapus.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { {
            // ELOQUENT
            $produk = Produk::find($id);
            // $encryptedFilename = $produk->encrypted_filename;
            $produk->delete();

            // Delete File
            // Storage::disk('public')->delete('files/' . $encryptedFilename);

            return redirect()->route('produk.index')->with('hapus', 'Barang berhasil dihapus.');
        }
    }

    // get data
    public function getData(Request $request)
    {
        $produks = Produk::with('kategori');
        if ($request->ajax()) {
            return datatables()->of($produks)
                ->addIndexColumn()
                ->addColumn('nama_kategori', function ($produk) {
                    return $produk->kategori->nama_kategori;
                })
                ->addColumn('kode_kategori', function ($produk) {
                    return $produk->kategori->kode_kategori;
                })
                ->addColumn('actions', function ($produk) {
                    return view('panel.produk.actions', compact('produk'));
                })
                ->toJson();
        }

    }

}