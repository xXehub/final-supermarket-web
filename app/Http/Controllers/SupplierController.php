<?php
// app/Http/Controllers/SupplierController.php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('panel.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_supplier' => 'required|unique:supplier|max:20',
            'nama_supplier' => 'required|max:100',
            'alamat' => 'required|max:255',
            'no_hp' => 'required|numeric',
            'deskripsi' => 'nullable',
        ]);

        Supplier::create($request->all());

        return redirect()->route('panel.supplier.index')
            ->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.show', compact('supplier'));
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

        return redirect()->route('panel.supplier.index')
            ->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('panel.supplier.index')
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
}
