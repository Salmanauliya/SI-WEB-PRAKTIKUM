<!DOCTYPE html>
<html>
<head><title>Dashboard - Simple Warehouse</title></head>
<body>
    <h2>Dashboard Gudang</h2>
    <p>Selamat datang, {{ auth()->user()->name }} | <a href="{{ route('logout') }}">Logout</a></p>

    <h3>Data Produk</h3>
    <a href="{{ route('products.create') }}">Tambah Produk Baru</a>
    <br><br>

    @if(session('success')) <p style="color:green">{{ session('success') }}</p> @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pembuat</th>
                <th>Nama Produk</th>
                <th>Kode Produk</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->user->name }}</td>
                <td>{{ $p->nama_produk }}</td>
                <td>{{ $p->kode_produk }}</td>
                <td>{{ $p->stok }}</td>
                <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('products.edit', $p->id) }}">Edit</a> | 
                    <form action="{{ route('products.destroy', $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>