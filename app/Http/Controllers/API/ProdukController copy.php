<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $produks = Produk::all();
        return response()->json(['data' => $produks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_produk' => 'required|unique:produk|max:20',
            'nama_produk' => 'required|max:100',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar_produk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Add logic to store the product

        return response()->json(['message' => 'Product created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json(['data' => $produk]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // Add validation rules for update here
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Add logic to update the product

        return response()->json(['message' => 'Product updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Add logic to delete the product

        return response()->json(['message' => 'Product deleted successfully']);
    }

    /**
     * Get data for DataTables.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
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
                    // Add your actions here if needed
                })
                ->toJson();
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
