<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportService
{
    /**
     * Export collection to CSV file
     *
     * @param Collection $collection
     * @param array $headers
     * @param string $filename
     * @return StreamedResponse
     */
    public function exportToCsv(Collection $collection, array $headers, string $filename): StreamedResponse
    {
        return response()->streamDownload(function () use ($collection, $headers) {
            $output = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($output, array_values($headers));
            
            // Add data rows
            foreach ($collection as $item) {
                $row = [];
                foreach (array_keys($headers) as $key) {
                    $row[] = data_get($item, $key, '');
                }
                fputcsv($output, $row);
            }
            
            fclose($output);
        }, $filename . '.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }
    
    /**
     * Export collection to Excel file
     *
     * @param Collection $collection
     * @param array $headers
     * @param string $filename
     * @return StreamedResponse
     */
    public function exportToExcel(Collection $collection, array $headers, string $filename): StreamedResponse
    {
        return response()->streamDownload(function () use ($collection, $headers) {
            // Create new Spreadsheet
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            
            // Add headers
            $col = 'A';
            foreach (array_values($headers) as $header) {
                $sheet->setCellValue($col . '1', $header);
                $col++;
            }
            
            // Add data rows
            $row = 2;
            foreach ($collection as $item) {
                $col = 'A';
                foreach (array_keys($headers) as $key) {
                    $sheet->setCellValue($col . $row, data_get($item, $key, ''));
                    $col++;
                }
                $row++;
            }
            
            // Auto-size columns
            foreach (range('A', $col) as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }
            
            // Create Excel writer
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $filename . '.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
    
    /**
     * Export collection to PDF file
     *
     * @param Collection $collection
     * @param array $headers
     * @param string $filename
     * @return StreamedResponse
     */
    public function exportToPdf(Collection $collection, array $headers, string $filename): StreamedResponse
    {
        return response()->streamDownload(function () use ($collection, $headers) {
            // Use TCPDF or another PDF library to create a proper PDF
            // This is a placeholder implementation
            $pdf = new \TCPDF();
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 10);
            
            // Add headers
            $html = '<table border="1">';
            $html .= '<tr>';
            foreach (array_values($headers) as $header) {
                $html .= '<th>' . htmlspecialchars($header) . '</th>';
            }
            $html .= '</tr>';
            
            // Add data rows
            foreach ($collection as $item) {
                $html .= '<tr>';
                foreach (array_keys($headers) as $key) {
                    $html .= '<td>' . htmlspecialchars((string)data_get($item, $key, '')) . '</td>';
                }
                $html .= '</tr>';
            }
            
            $html .= '</table>';
            
            $pdf->writeHTML($html);
            $pdf->Output('file.pdf', 'S');
        }, $filename . '.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }
}