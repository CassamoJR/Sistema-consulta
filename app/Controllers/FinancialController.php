<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\Contribution;
use App\Models\Member;

final class FinancialController extends Controller
{
    public function dashboard(): void
    {
        $contribution = new Contribution();
        $member = new Member();

        $data = [
            'title' => 'Painel Financeiro',
            'monthlyTotal' => $contribution->monthlyTotal(),
            'yearlyTotal' => $contribution->yearlyTotal(),
            'overdue' => $member->overdueCount(),
            'provinceReport' => $contribution->byProvince(),
        ];

        $this->view('financial/dashboard', $data);
    }

    public function apiSummary(): void
    {
        header('Content-Type: application/json');

        $contribution = new Contribution();
        $member = new Member();
        echo json_encode([
            'mes' => $contribution->monthlyTotal(),
            'ano' => $contribution->yearlyTotal(),
            'membros_atraso' => $member->overdueCount(),
            'por_provincia' => $contribution->byProvince(),
        ], JSON_UNESCAPED_UNICODE);
    }

    public function exportPdf(): void
    {
        if (!class_exists('TCPDF')) {
            http_response_code(500);
            echo 'TCPDF não instalado.';
            return;
        }

        $pdf = new \TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Write(0, 'Relatório Financeiro ANAPRO');
        $pdf->Output('relatorio-financeiro.pdf', 'D');
    }

    public function exportExcel(): void
    {
        if (!class_exists(\PhpOffice\PhpSpreadsheet\Spreadsheet::class)) {
            http_response_code(500);
            echo 'PhpSpreadsheet não instalado.';
            return;
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Província');
        $sheet->setCellValue('B1', 'Total');

        $row = 2;
        foreach ((new Contribution())->byProvince() as $item) {
            $sheet->setCellValue('A' . $row, $item['provincia']);
            $sheet->setCellValue('B' . $row, $item['total']);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="relatorio-financeiro.xlsx"');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
