<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Whishlist;

class WhishlistController extends Controller
{
    public function index()
    {
        $whishlists = Whishlist::all();
        return view('whishlist.index', compact('whishlists'));
    }

    public function create()
    {
        return view('whishlist.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'produk_id' => 'required',
        ]);

        Whishlist::create($request->all());
        return redirect()->route('whishlist.index')->with('success', 'Whishlist berhasil ditambahkan.');
    }

    public function show($id)
    {
        $whishlist = Whishlist::findOrFail($id);
        return view('whishlist.show', compact('whishlist'));
    }

    public function edit($id)
    {
        $whishlist = Whishlist::findOrFail($id);
        return view('whishlist.edit', compact('whishlist'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'produk_id' => 'required',
        ]);

        $whishlist = Whishlist::findOrFail($id);
        $whishlist->update($request->all());
        return redirect()->route('whishlist.index')->with('success', 'Whishlist berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $whishlist = Whishlist::findOrFail($id);
        $whishlist->delete();
        return redirect()->route('whishlist.index')->with('success', 'Whishlist berhasil dihapus.');
    }
}
