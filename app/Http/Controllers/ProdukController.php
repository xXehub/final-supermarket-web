<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

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
        // confirmDelete();

        return view('panel.produk.index', compact('ingfo_sakkarepmu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingfo_sakkarepmu = 'Create Employee';

        // ELOQUENT
        $kategori = Kategori::all();
        return view('panel.produk.create', compact('ingfo_sakkarepmu', 'kategori'));
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

            Alert::success('Added Successfully', 'Employee Data Added Successfully.');
            return redirect()->route('panel.produk.produk.index')->with('success', 'Produk berhasil ditambahkan.');
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
        $ingfo_sakkarepmu = 'Edit Produk';
        $produk = Produk::find($id);
        $kategori = Kategori::all();
        return view('panel.produk.produk.edit', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'produk' => $produk,
            'kategoris' => $kategori
        ]);
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
            return redirect()->route('panel.produk.produk.index');
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

            // Delete Employee
            $produk->delete();

            // Delete File
            // Storage::disk('public')->delete('files/' . $encryptedFilename);

            Alert::success('Deleted Successfully', 'Employee Data Deleted Successfully.');

            return redirect()->route('employees.index');
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
                    return view('panel.produk.actions', compact('produk'))->render();
                })
                ->toJson();
        }
    }

}