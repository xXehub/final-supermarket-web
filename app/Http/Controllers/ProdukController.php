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
                // validator message mas
                'kode_produk.required' => 'Kode produk wajib diisi',
                'kode_produk.unique' => 'Kode produk sudah ada',
                'kode_produk.max' => 'Kode produk maksimal 20 karakter',
                'nama_produk.required' => 'Nama produk wajib diisi',
                'nama_produk.max' => 'Nama produk maksimal 100 karakter',
                'kategori_id.required' => 'Kategori wajib dipilih',
                'kategori_id.exists' => 'Kategori tidak valid',
                'harga.required' => 'Harga wajib diisi',
                'harga.integer' => 'Harga harus berupa angka',
                'harga.min' => 'Harga minimal 0',
                'stock.required' => 'Stok wajib diisi',
                'stock.integer' => 'Stok harus berupa angka',
                'stock.min' => 'Stok minimal 0',
                'deskripsi.string' => 'Deskripsi harus berupa teks',
                'gambar_produk.required' => 'Gambar produk wajib diunggah',
                'gambar_produk.image' => 'Gambar produk harus berupa gambar',
                'gambar_produk.mimes' => 'Gambar produk harus berupa file dengan format jpeg, png, atau jpg',
                'gambar_produk.max' => 'Gambar produk maksimal 2MB',
            ];
            $validator = Validator::make($request->all(), [
                'kode_produk' => 'required|unique:produk|max:20',
                'nama_produk' => 'required|max:100',
                'kategori_id' => 'required|exists:kategori,id',
                'harga' => 'required|integer|min:0',
                'stock' => 'required|integer|min:0',
                'deskripsi' => 'nullable|string',
                'gambar_produk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ], $messages);

            // lanek validasine gagal 
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // gawe upload gambar produk
            $gambar_produk = null;
            if ($request->hasFile('gambar_produk')) {
                $file = $request->file('gambar_produk');
                $gambar_produk = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/produk', $gambar_produk);
            }
            $produk = new Produk();
            $produk->kode_produk = $request->kode_produk;
            $produk->nama_produk = $request->nama_produk;
            $produk->kategori_id = $request->kategori_id;
            $produk->harga = $request->harga;
            $produk->stock = $request->stock;
            $produk->deskripsi = $request->deskripsi;
            $produk->gambar_produk = $gambar_produk;
            $produk->save();

            return redirect()->route('produk.index')->with('success', 'Barang berhasil ditambahkan.');
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
        $ingfo_sakkarepmu = 'Detail Produk';

        // ELOQUENT
        $produk = Produk::find($id);

        return view('panel.produk.show', compact('ingfo_sakkarepmu', 'produk'));
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