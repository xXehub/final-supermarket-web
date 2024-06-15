<?php
// app/Http/Controllers/SupplierController.php

namespace App\Http\Controllers\API;

use App\Exports\SupplierExport;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $ingfo_sakkarepmu = "Data List Produk";
        $kategori = Kategori::all();
        $produk = Produk::first();
        $supplier = Supplier::first();

        return view('panel.supplier.index', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'kategoris' => $kategori,
            'supplier' => $supplier,
            'produk' => $produk // Pastikan produk dikirim ke view

        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ingfo_sakkarepmu = 'Tambah Data Supplier';
        $supplier = Supplier::all();

        return view('panel.supplier.create', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'suppliers' => $supplier,
            'produk' => null // Tidak ada produk yang dikirimkan pada create
        ]);
        // return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
   
    {
        // gawe message dan validasi
        {
            $messages = [
                // validator message mas
                'required' => 'Tidak boleh kosong',
                'no_hp.min:0' => 'Tidak boleh kurang dari 0',
            ];
            $validator = Validator::make($request->all(), [
                'kode_supplier' => 'required|unique:supplier|max:20',
                'nama_supplier' => 'required|max:100',
                'alamat' => 'required|max:255',
                'no_hp' => 'required|digits_between:1,20|min:0',
                'deskripsi' => 'nullable|string',
            ], $messages);

            // lanek validasine gagal 
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // eloquent instant method create
            Supplier::create($request->all());
            return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan.');      // return redirect()->route('panel.produk.produk.index')->with('success', 'Produk berhasil ditambahkan.');
        }
    } 
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('panel.supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_supplier' => 'required|max:20|unique:supplier,kode_supplier,' . $id,
            'nama_supplier' => 'required|max:100',
            'alamat' => 'required|max:255',
            'no_hp' => 'required|numeric',
            'deskripsi' => 'nullable',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier deleted successfully.');
    }

    // 
    /* gawe get data supplier */
    // 
    public function getData(Request $request)
    {
        $suppliers = Supplier::with('produk');
        if ($request->ajax()) {
            return datatables()->of($suppliers)
                ->addIndexColumn()
                ->addColumn('actions', function ($supplier) {
                    return view('panel.supplier.actions', compact('supplier'));
                })
                ->toJson();
        }

    }

    public function exportExcel()
    {
        return Excel::download(new SupplierExport, 'supplier.xlsx');
    }
}
