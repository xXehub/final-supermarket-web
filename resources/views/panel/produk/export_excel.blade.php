<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Supplier</th>
            <th>Harga</th>
            <th>Stock</th>
            <th>Deskripsi</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($produk as $index => $produk)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $produk->kode_produk }}</td>
                <td>{{ $produk->nama_produk }}</td>
                <td>{{ $produk->kategori->nama_kategori }}</td>
                <td>{{ $produk->supplier->nama_supplier }}</td>
                <td>{{ $produk->harga }}</td>
                <td>{{ $produk->stock }}</td>
                <td>{{ $produk->deskripsi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
