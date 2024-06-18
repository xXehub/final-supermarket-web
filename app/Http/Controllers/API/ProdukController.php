<?php

namespace App\Http\Controllers\API;

use App\Exports\ProdukExport;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Supplier;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


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
        $ingfo_sakkarepmu = "Data List Produk";
        $kategori = Kategori::all();
        $produk = Produk::first();
        $suppliers = Supplier::all();
        $totalProduk = Produk::count();


        return view('panel.produk.index', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'kategoris' => $kategori,
            'suppliers' => $suppliers,
            'totalProduk' => $totalProduk,
            'produk' => $produk
        ]);
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
        $supplier = Supplier::all();


        return view('panel.produk.create', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'kategoris' => $kategori,
            'suppliers' => $supplier,
            'produk' => null // Tidak ada produk yang dikirimkan pada create
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
                'supplier_id.required' => 'Kategori wajib dipilih',
                'supplier_id.exists' => 'Kategori tidak valid',
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
                'supplier_id' => 'required|exists:supplier,id',
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
            $produk->supplier_id = $request->supplier_id;
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
        $ingfo_sakkarepmu = "Data List Produk";
        $kategori = Kategori::all();
        $produk = Produk::find($id);

        return view('panel.produk.show', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'kategoris' => $kategori,
            'produk' => $produk // Pastikan produk dikirim ke view
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $ingfo_sakkarepmu = 'Edit Data Kategori';
        $kategoris = Kategori::find($id);
        $produk = Produk::findOrFail($id);
        return view('panel.produk.edit', compact('ingfo_sakkarepmu', 'kategoris', 'produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode_produk' => 'required|regex:/[A-Z]+/',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategori,id',
            'stock' => 'required|integer',
            'gambar_produk' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan produk berdasarkan ID
        $produk = Produk::find($id);

        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan.');
        }

        // Update atribut produk
        $produk->kode_produk = $request->kode_produk;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->kategori_id = $request->kategori_id;
        $produk->stock = $request->stock;

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('gambar_produk')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar_produk && Storage::exists('public/produk/' . $produk->gambar_produk)) {
                Storage::delete('public/produk/' . $produk->gambar_produk);
            }

            // Simpan gambar baru
            $file = $request->file('gambar_produk');
            $gambar_produk = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/produk', $gambar_produk);
            $produk->gambar_produk = $gambar_produk;
        }

        // Simpan perubahan
        $produk->save();
        $produk = Produk::findOrFail($id);
        $produk->update($request->all());
        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diperbarui.');
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
        $produks = Produk::with('kategori', 'supplier');
        if ($request->ajax()) {
            return datatables()->of($produks)
                ->addIndexColumn()
                ->addColumn('nama_supplier', function ($produk) {
                    return $produk->supplier->nama_supplier;
                })
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

    public function exportExcel()
    {
        return Excel::download(new ProdukExport, 'produk.xlsx');
    }


    public function filterProduk(Request $request)
    {
        $kategoriIds = $request->input('kategori');
        $jumlahProdukKeranjang = Keranjang::where('user_id', auth()->id())->count();
        if ($kategoriIds) {
            $produks = Produk::whereIn('kategori_id', $kategoriIds)->paginate(5);
        } else {
            $produks = Produk::paginate(5);
        }
        
        $kategoris = Kategori::all();

        return view('supermarket.index', compact('produks', 'kategoris','jumlahProdukKeranjang'));
    }
}