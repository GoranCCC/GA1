<?php
declare(strict_types=1);

// 🚫 ABSOLUTELY NO OUTPUT BEFORE THIS FILE
// 🚫 NO SPACES BEFORE <?php
// 🚫 NO BOM

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/db_connect.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

// Prevent any previous output
if (ob_get_length()) {
    ob_end_clean();
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header row
$headers = ['ID', 'Reference', 'Company', 'Serial No.', 'PDF', 'QR', 'Token', 'Created'];
$sheet->fromArray($headers, null, 'A1');

$stmt = $pdo->query("SELECT * FROM ga1 ORDER BY created_at DESC");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$row = 2;

foreach ($data as $r) {
    $sheet->setCellValue("A$row", $r['id']);
    $sheet->setCellValue("B$row", $r['ref']);
    $sheet->setCellValue("C$row", $r['username']);
    $sheet->setCellValue("D$row", $r['serialnumber']);
    $sheet->setCellValue("E$row", $r['pdf_url']);
    $sheet->setCellValue("G$row", $r['token']);
    $sheet->setCellValue("H$row", $r['created_at']);

    // ✅ QR image
    $qrFile = __DIR__ . '/uploads/qr_' . $r['token'] . '.png';
    if (is_file($qrFile)) {
        $drawing = new Drawing();
        $drawing->setPath($qrFile);
        $drawing->setHeight(80);
        $drawing->setCoordinates("F$row");
        $drawing->setWorksheet($sheet);

        $sheet->getRowDimension($row)->setRowHeight(70);
        $sheet->getColumnDimension('F')->setWidth(18);
    }

    $row++;
}

// Headers MUST be sent last
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="ga1_report.xlsx"');
header('Cache-Control: max-age=0');
header('Pragma: public');
header('Expires: 0');

// Write file
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

exit;
