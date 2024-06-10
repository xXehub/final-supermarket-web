<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Supplier</th>
            <th>Nama Supplier</th>
            <th>Alamat</th>
            <th>No. HP</th>
            <th>Deskripsi</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($supplier as $index => $supplier)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $supplier->kode_supplier }}</td>
                <td>{{ $supplier->nama_supplier }}</td>
                <td>{{ $supplier->alamat }}</td>
                <td>{{ $supplier->no_hp }}</td>
                <td>{{ $supplier->deskripsi }}</td>
                <td>{{ $supplier->created_at }}</td>
                <td>{{ $supplier->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
