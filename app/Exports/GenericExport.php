<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GenericExport implements FromCollection, WithHeadings, WithStyles
{
    protected $model;
    protected $columns;
    protected $relations;
    protected $endColumn;
    protected $path;

    public function __construct($model, array $columns, $endColumn, $path = '', array $relations = [])
    {
        $this->model = $model;
        $this->columns = $columns;
        $this->relations = $relations;
        $this->endColumn = $endColumn;
        $this->path = $path;
    }

    public function collection()
    {
        $query = $this->model::with($this->getRelationKeys())->get();

        return $query->map(function ($item, $index) {
            $data = [];
            $data['no'] = $index + 1;

            foreach ($this->columns as $column) {
                if ($column === 'image' && $item->$column) {
                    // Generate the public URL for the image
                    $data[$column] = url("dist/assets/img/$this->path/{$item->$column}");
                    continue;
                } else {
                    $data[$column] = $item->$column ?? '';
                }
            }
            foreach ($this->relations as $relation => $fields) {
                if ($relation === 'rItemTambahan' && $item->$relation->isNotEmpty()) {
                    foreach ($fields as $field) {
                        $relatedItems = $item->$relation->pluck($field)->implode(', '); // Join related names with a comma
                        $data["$relation.$field"] = $relatedItems ?: null;
                    }
                } elseif ($item->$relation) {
                    foreach ($fields as $field) {
                        $data["$relation.$field"] = $item->$relation->$field ?? null;
                    }
                } else {
                    foreach ($fields as $field) {
                        $data["$relation.$field"] = null;
                    }
                }
            }
            return $data;
        });
    }

    public function headings(): array
    {
        $headings = [$this->formatFieldName('no')];
        $headings = array_merge($headings, array_map([$this, 'formatFieldName'], $this->columns));

        foreach ($this->relations as $relation => $fields) {
            foreach ($fields as $field) {
                $headings[] = $this->formatFieldName("$field");
            }
        }

        $today = date('d-m-Y');
        return [['Dokumen di download pada tanggal ' . $today], $headings];
    }

    public function styles(Worksheet $sheet)
    {
        // Merge and style title row
        $sheet->mergeCells("A1:{$this->endColumn}1");

        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => 'center'],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'autoSize' => true,
        ]);

        // Apply header styling
        $sheet->getStyle("A2:{$this->endColumn}2")->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'CCFFCC'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Center the heading for the image column
        $imageColumnIndex = array_search('image', $this->columns);
        if ($imageColumnIndex !== false) {
            // Calculate the cell coordinate for the heading
            $imageHeaderCell = $this->getColumnLetter($imageColumnIndex + 1) . '2';
            $sheet
                ->getStyle($imageHeaderCell)
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }

        // Auto-size other columns
        foreach (range('A', $this->endColumn) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A2:{$this->endColumn}{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Center align horizontally for all other cells
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Center align vertically for all other cells
            ],
        ]);

        // Left align the image URL cells
        if ($imageColumnIndex !== false) {
            // Calculate the cell range for the image URLs
            $imageCellRange = "{$this->getColumnLetter($imageColumnIndex + 2)}3:{$this->getColumnLetter($imageColumnIndex + 2)}{$lastRow}";
            // dd($imageCellRange);
            $sheet
                ->getStyle($imageCellRange)
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        }
    }

    // Helper function to convert column index to letter
    private function getColumnLetter($index)
    {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index);
    }

    protected function getRelationKeys()
    {
        return array_keys($this->relations);
    }

    private function formatFieldName($field)
    {
        return ucwords(str_replace('_', ' ', $field));
    }
}
