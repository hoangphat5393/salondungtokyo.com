<?php

namespace App\Exports;

use App\Models\Backend\Page;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportPage implements FromQuery, WithMapping, WithHeadings, WithStyles
{
    /**
     * Trả về query lấy dữ liệu
     */
    public function query()
    {
        return Page::query()->select('name', 'slug');
    }

    /**
     * Định nghĩa mỗi dòng trong Excel
     */
    public function map($page): array
    {
        static $index = 0;
        $index++;

        return [
            $index,                     // STT
            $page->name,                // Trang
            $page->name,                // Tên trang  (hoặc $page->title)
            route('page', $page->slug), // Link trang
        ];
    }

    /**
     * Định nghĩa header
     */
    public function headings(): array
    {
        return [
            'STT',
            'Trang',
            'Tên trang',
            'Link trang',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Apply toàn bộ sheet canh giữa — xử lý trực tiếp
        $sheet->getStyle($sheet->calculateWorksheetDimension())->applyFromArray([
            'alignment' => [
                // 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Trả về các style chi tiết (ví dụ: hàng đầu in đậm)
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
