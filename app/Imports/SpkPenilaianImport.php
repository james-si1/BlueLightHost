<?php

namespace App\Imports;

use App\Models\SpkPenilaian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class SpkPenilaianImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Import_SPK' => new SpkPenilaianSheetImport(),
        ];
    }
}

class SpkPenilaianSheetImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    public function headingRow(): int
    {
        return 1;
    }

    public function model(array $row)
    {
        return new SpkPenilaian([
            'nama_responden' => $row['nama_responden'],
            'c1' => (int) $row['c1'],
            'c2' => (int) $row['c2'],
            'c3' => (int) $row['c3'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nama_responden' => 'required|string|max:255',
            '*.c1' => 'required|integer|min:1|max:3',
            '*.c2' => 'required|integer|min:1|max:3',
            '*.c3' => 'required|integer|min:1|max:3',
        ];
    }
}
