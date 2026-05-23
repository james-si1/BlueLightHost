@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Sistem Penunjang Keputusan</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Import Data Kuesioner Excel
            </h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.spk.import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Upload File Excel</label>
                    <input type="file" name="file_excel" class="form-control" accept=".xlsx,.xls,.csv" required>
                    <small class="text-muted">
                        Format kolom wajib: nama_responden, c1, c2, c3
                    </small>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Import Excel
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kriteria</h6>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Kriteria</th>
                                <th>Tipe</th>
                                <th>Bobot</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($kriterias as $k)
                            <tr>
                                <td>{{ $k->kode }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>
                                    @if($k->tipe == 'cost')
                                    <span class="badge badge-danger">Cost</span>
                                    @else
                                    <span class="badge badge-success">Benefit</span>
                                    @endif
                                </td>
                                <td>{{ $k->bobot }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <small class="text-muted">
                        C1 Harga = Cost, C2 Keindahan = Benefit, C3 Tingkat Kemudahan Keperawatan = Benefit.
                    </small>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Alternatif</h6>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Alternatif</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($alternatifs as $a)
                            <tr>
                                <td>{{ $a->kode }}</td>
                                <td>{{ $a->nama_ikan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <small class="text-muted">
                        Alternatif digunakan sebagai hasil rekomendasi berdasarkan skor SAW.
                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Input Data Kuesioner Manual
            </h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.spk.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <label>Nama Responden</label>
                        <input type="text" name="nama_responden" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label>C1 - Harga</label>
                        <select name="c1" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="1">1 - Murah</option>
                            <option value="2">2 - Menengah</option>
                            <option value="3">3 - Mahal</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>C2 - Keindahan</label>
                        <select name="c2" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="1">1 - Kurang Menarik</option>
                            <option value="2">2 - Menarik</option>
                            <option value="3">3 - Sangat Menarik</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>C3 - Perawatan</label>
                        <select name="c3" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="1">1 - Sulit</option>
                            <option value="2">2 - Mudah</option>
                            <option value="3">3 - Sangat Mudah</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    Simpan Kuesioner
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                Data Kuesioner Responden
            </h6>

            <span class="badge badge-info">
                Total Data: {{ $penilaians->count() }}
            </span>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Responden</th>
                            <th>C1 Harga</th>
                            <th>C2 Keindahan</th>
                            <th>C3 Perawatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($penilaians as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->nama_responden }}</td>
                            <td>{{ $p->c1 }}</td>
                            <td>{{ $p->c2 }}</td>
                            <td>{{ $p->c3 }}</td>
                            <td>
                                <form action="{{ route('admin.spk.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data kuesioner</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Hasil Normalisasi dan Perhitungan SAW
            </h6>
        </div>

        <div class="card-body">
            <div class="alert alert-light border">
                <strong>Rumus SAW:</strong>
                C1 Harga menggunakan Cost, sedangkan C2 Keindahan dan C3 Perawatan menggunakan Benefit.
                Bobot yang digunakan: C1 = 0.5, C2 = 0.3, C3 = 0.2.
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Responden</th>
                            <th>Normal C1</th>
                            <th>Normal C2</th>
                            <th>Normal C3</th>
                            <th>Skor Akhir</th>
                            <th>Rekomendasi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($hasilSaw as $index => $h)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $h['nama_responden'] }}</td>
                            <td>{{ $h['normal_c1'] }}</td>
                            <td>{{ $h['normal_c2'] }}</td>
                            <td>{{ $h['normal_c3'] }}</td>
                            <td>
                                <strong>{{ $h['skor'] }}</strong>
                            </td>
                            <td>
                                @if($h['rekomendasi'] == 'Ikan Cupang')
                                <span class="badge badge-success">{{ $h['rekomendasi'] }}</span>
                                @elseif($h['rekomendasi'] == 'Ikan GlowFish')
                                <span class="badge badge-info">{{ $h['rekomendasi'] }}</span>
                                @else
                                <span class="badge badge-warning">{{ $h['rekomendasi'] }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada hasil perhitungan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(count($hasilSaw) > 0)
            @php
            $cupang = collect($hasilSaw)->where('rekomendasi', 'Ikan Cupang')->count();
            $glowfish = collect($hasilSaw)->where('rekomendasi', 'Ikan GlowFish')->count();
            $koi = collect($hasilSaw)->where('rekomendasi', 'Ikan KOI')->count();

            $tertinggi = collect([
            'Ikan Cupang' => $cupang,
            'Ikan GlowFish' => $glowfish,
            'Ikan KOI' => $koi,
            ])->sortDesc()->keys()->first();
            @endphp

            <div class="alert alert-primary mt-3">
                <strong>Kesimpulan:</strong>
                Berdasarkan hasil perhitungan metode SAW, rekomendasi terbanyak adalah
                <strong>{{ $tertinggi }}</strong>.
                <br>
                Total Cupang: {{ $cupang }},
                GlowFish: {{ $glowfish }},
                KOI: {{ $koi }}.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection