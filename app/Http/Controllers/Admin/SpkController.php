<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpkKriteria;
use App\Models\SpkAlternatif;
use App\Models\SpkPenilaian;
use App\Imports\SpkPenilaianImport;
use Maatwebsite\Excel\Facades\Excel;

class SpkController extends Controller
{
    public function index()
    {
        $this->setupDefaultData();

        $kriterias = SpkKriteria::orderBy('kode')->get();
        $alternatifs = SpkAlternatif::orderBy('kode')->get();
        $penilaians = SpkPenilaian::latest()->get();

        $hasilSaw = $this->hitungSaw($penilaians);

        return view('admin.spk.index', compact(
            'kriterias',
            'alternatifs',
            'penilaians',
            'hasilSaw'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_responden' => 'required|string|max:255',
            'c1' => 'required|integer|min:1|max:3',
            'c2' => 'required|integer|min:1|max:3',
            'c3' => 'required|integer|min:1|max:3',
        ]);

        SpkPenilaian::create([
            'nama_responden' => $request->nama_responden,
            'c1' => $request->c1,
            'c2' => $request->c2,
            'c3' => $request->c3,
        ]);

        return redirect()->route('admin.spk.index')
            ->with('success', 'Data kuesioner berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        SpkPenilaian::findOrFail($id)->delete();

        return redirect()->route('admin.spk.index')
            ->with('success', 'Data kuesioner berhasil dihapus.');
    }

    private function hitungSaw($penilaians)
    {
        $hasil = [];

        if ($penilaians->count() == 0) {
            return $hasil;
        }

        foreach ($penilaians as $p) {

            /* 
        ----- NORMALISASI SAW -----
        
         C1 = Harga (Cost)
         1 = Murah    => 1
         2 = Menengah => 0.5
         3 = Mahal    => 0.33
        
         C2 = Keindahan (Benefit)
         1 = Kurang Menarik => 0.33
         2 = Menarik        => 0.66
         3 = Sangat Menarik => 1
        
         C3 = Perawatan (Benefit)
         1 = Sulit         => 0.33
         2 = Mudah         => 0.66
         3 = Sangat Mudah  => 1
        */

            $normalC1 = match ($p->c1) {
                1 => 1,
                2 => 0.5,
                default => 0.33,
            };

            $normalC2 = match ($p->c2) {
                3 => 1,
                2 => 0.66,
                default => 0.33,
            };

            $normalC3 = match ($p->c3) {
                3 => 1,
                2 => 0.66,
                default => 0.33,
            };

            /*
        | PERHITUNGAN SAW |
        */

            $skor =
                ($normalC1 * 0.5) +
                ($normalC2 * 0.3) +
                ($normalC3 * 0.2);

            $skor = round($skor, 3);

            /*
        | REKOMENDASI IKAN |
        */

            if ($skor >= 0.75) {
                $rekomendasi = 'Ikan Cupang';
            } elseif ($skor >= 0.43) {
                $rekomendasi = 'Ikan GlowFish';
            } else {
                $rekomendasi = 'Ikan KOI';
            }

            $hasil[] = [
                'id' => $p->id,
                'nama_responden' => $p->nama_responden,

                'c1' => $p->c1,
                'c2' => $p->c2,
                'c3' => $p->c3,

                'normal_c1' => $normalC1,
                'normal_c2' => $normalC2,
                'normal_c3' => $normalC3,

                'skor' => $skor,
                'rekomendasi' => $rekomendasi,
            ];
        }

        return $hasil;
    }

    private function setupDefaultData()
    {
        if (SpkKriteria::count() == 0) {
            SpkKriteria::insert([
                [
                    'kode' => 'C1',
                    'nama' => 'Harga',
                    'tipe' => 'cost',
                    'bobot' => 0.5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kode' => 'C2',
                    'nama' => 'Keindahan',
                    'tipe' => 'benefit',
                    'bobot' => 0.3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kode' => 'C3',
                    'nama' => 'Tingkat Kemudahan Keperawatan',
                    'tipe' => 'benefit',
                    'bobot' => 0.2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        if (SpkAlternatif::count() == 0) {
            SpkAlternatif::insert([
                [
                    'kode' => 'A1',
                    'nama_ikan' => 'Ikan Cupang',
                    'keterangan' => 'Skor tinggi, harga terjangkau, indah, dan mudah dirawat.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kode' => 'A2',
                    'nama_ikan' => 'Ikan KOI',
                    'keterangan' => 'Skor rendah, harga relatif mahal dan perawatan lebih sulit.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kode' => 'A3',
                    'nama_ikan' => 'Ikan GlowFish',
                    'keterangan' => 'Skor sedang, harga cukup murah dan tampilan menarik.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new SpkPenilaianImport, $request->file('file_excel'));

        return redirect()->route('admin.spk.index')
            ->with('success', 'Data kuesioner dari Excel berhasil diimport.');
    }
}
