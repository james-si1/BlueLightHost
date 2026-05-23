@extends('admin.layout')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Produk</h1>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">

        {{-- SEARCH BAR --}}
        <form method="GET" action="{{ route('admin.products.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari nama produk..."
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>

                @if(request('search'))
                <div class="col-md-2">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary w-100">
                        Reset
                    </a>
                </div>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Supplier</th>
                        <th>Kategori</th>
                        <th>Harga Modal</th>
                        <th>Harga Jual</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $p)
                    <tr>
                        <td width="90">
                            @if($p->foto)
                            <img src="{{ asset('storage/' . $p->foto) }}"
                                width="70"
                                style="border-radius:6px;">
                            @else
                            -
                            @endif
                        </td>

                        <td>{{ $p->nama_barang }}</td>

                        <td>{{ $p->supplier->nama_supplier ?? '-' }}</td>

                        <td>{{ $p->category->nama_kategori ?? '-' }}</td>

                        <td>
                            Rp {{ number_format($p->harga_modal, 0, ',', '.') }}
                        </td>

                        <td>
                            Rp {{ number_format($p->harga_jual, 0, ',', '.') }}
                        </td>

                        <td>
                            <a href="{{ route('admin.products.edit', $p->id) }}"
                                class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.products.destroy', $p->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Hapus produk ini?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada data produk
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $products->withQueryString()->links() }}
        </div>

    </div>
</div>
@endsection