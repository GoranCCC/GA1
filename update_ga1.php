<?php
require_once('db_connect.php');
require_once('tcpdf/tcpdf.php');

// Extract tick values from form data
function renderCheckbox($value) {
    $checked = ($value == "1");
    return $checked 
        ? '<span style="color:blue; font-size:14pt">☑</span>' 
        : '<span style="font-size:14pt">☐</span>';
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request method.');
}

$token = $_POST['token'] ?? '';
if (empty($token)) {
    die('Invalid request: no token provided.');
}

// Directory to save signatures
$uploadDir = __DIR__ . '/uploads/signatures/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Function to save Base64 signature image to file
function saveSignatureImage($base64Data, $uploadDir, $token, $prefix) {
    if (!$base64Data) return '';

    if (preg_match('/^data:image\/(\w+);base64,/', $base64Data, $type)) {
        $base64Data = substr($base64Data, strpos($base64Data, ',') + 1);
        $type = strtolower($type[1]); // e.g. png

        if (!in_array($type, ['png', 'jpg', 'jpeg'])) {
            return '';
        }

        $base64Data = str_replace(' ', '+', $base64Data);
        $imageData = base64_decode($base64Data);
        if ($imageData === false) {
            return '';
        }
    } else {
        return '';
    }

    $fileName = $prefix . '_' . $token . '_' . time() . '.' . $type;
    $filePath = $uploadDir . $fileName;
    if (file_put_contents($filePath, $imageData)) {
        return 'uploads/signatures/' . $fileName;
    }
    return '';
}

// Fetch current signature paths so we can keep old ones if not updated
$stmt = $pdo->prepare("SELECT signature1_path, signature2_path FROM ga1 WHERE token = ?");
$stmt->execute([$token]);
$currentData = $stmt->fetch(PDO::FETCH_ASSOC);

// Save new signatures if submitted, else keep old
$signature1_path = saveSignatureImage($_POST['signature1_data'] ?? '', $uploadDir, $token, 'signature1');
$signature2_path = saveSignatureImage($_POST['signature2_data'] ?? '', $uploadDir, $token, 'signature2');

$signature1_path = $signature1_path ?: ($currentData['signature1_path'] ?? '');
$signature2_path = $signature2_path ?: ($currentData['signature2_path'] ?? '');

// Prepare and execute the UPDATE with posted form data
$stmt = $pdo->prepare("
    UPDATE ga1 SET 
        date1 = :date1,
        ref = :ref,
        username = :username,
        address = :address,
        address1 = :address1,
        particulars = :particulars,
        type = :type,
        serialnumber = :serialnumber,
        datem = :datem,
        swl1 = :swl1,
        swl2 = :swl2,
        swl3 = :swl3,
        configuration1 = :configuration1,
        configuration2 = :configuration2,
        configuration3 = :configuration3,
        purpose = :purpose,
        date2 = :date2,
        defect1 = :defect1,
        repair1 = :repair1,
        defect2 = :defect2,
        timeframe = :timeframe,
        repair2 = :repair2,
        parts = :parts,
        inspectorname = :inspectorname,
        authoriser = :authoriser,
        tick1 = :tick1,
        tick2 = :tick2,
        tick3 = :tick3,
        tick4 = :tick4,
        tick5 = :tick5,
        tick6 = :tick6,
        test = :test,
        exam = :exam,
        signature1_path = :signature1_path,
        signature2_path = :signature2_path
    WHERE token = :token
");

$stmt->execute([
    ':date1' => $_POST['date1'] ?? '',
    ':ref' => $_POST['ref'] ?? '',
    ':username' => $_POST['username'] ?? '',
    ':address' => $_POST['address'] ?? '',
    ':address1' => $_POST['address1'] ?? '',
    ':particulars' => $_POST['particulars'] ?? '',
    ':type' => $_POST['type'] ?? '',
    ':serialnumber' => $_POST['serialnumber'] ?? '',
    ':datem' => !empty($_POST['datem']) ? $_POST['datem'] : null,
    ':swl1' => $_POST['swl1'] ?? '',
    ':swl2' => $_POST['swl2'] ?? '',
    ':swl3' => $_POST['swl3'] ?? '',
    ':configuration1' => $_POST['configuration1'] ?? '',
    ':configuration2' => $_POST['configuration2'] ?? '',
    ':configuration3' => $_POST['configuration3'] ?? '',
    ':purpose' => $_POST['purpose'] ?? '',
    ':date2' => $_POST['date2'] ?? '',
    ':defect1' => $_POST['defect1'] ?? '',
    ':repair1' => $_POST['repair1'] ?? '',
    ':defect2' => $_POST['defect2'] ?? '',
    ':timeframe' => $_POST['timeframe'] ?? '',
    ':repair2' => $_POST['repair2'] ?? '',
    ':parts' => $_POST['parts'] ?? '',
    ':inspectorname' => $_POST['inspectorname'] ?? '',
    ':authoriser' => $_POST['authoriser'] ?? '',
    ':tick1' => isset($_POST['tick1']) ? 1 : 0,
    ':tick2' => isset($_POST['tick2']) ? 1 : 0,
    ':tick3' => isset($_POST['tick3']) ? 1 : 0,
    ':tick4' => isset($_POST['tick4']) ? 1 : 0,
    ':tick5' => isset($_POST['tick5']) ? 1 : 0,
    ':tick6' => isset($_POST['tick6']) ? 1 : 0,
    ':test' => isset($_POST['test']) ? 1 : 0,
    ':exam' => isset($_POST['exam']) ? 1 : 0,
    ':signature1_path' => $signature1_path,
    ':signature2_path' => $signature2_path,
    ':token' => $token
]);

// NOW fetch updated record to use for PDF generation
$stmt = $pdo->prepare("SELECT * FROM ga1 WHERE token = :token LIMIT 1");
$stmt->execute(['token' => $token]);
$data = $stmt->fetch();

$t1 = $data['tick1'] ?? '0';
$t2 = $data['tick2'] ?? '0';
$t3 = $data['tick3'] ?? '0';
$t4 = $data['tick4'] ?? '0';
$t5 = $data['tick5'] ?? '0';
$t6 = $data['tick6'] ?? '0';
$t7 = $data['test'] ?? '0';
$t8 = $data['exam'] ?? '0';

if (!$data) {
    die('No record found after update.');
}

// PDF generation
$pdf = new TCPDF();
$pdf->SetFont('dejavusans', 14);
$pdf->SetCreator('Safety First Consultancy');
$pdf->SetAuthor($data['inspectorname']);
$pdf->SetTitle('GA1 Report - ' . $data['ref']);
$pdf->AddPage();
$pdf->Image('./ga1_files/CCC-logo.png', $x = 165, $y = 0, 32, 50);


// Start HTML content
$html = '
<br>
<br>
<h2 style="color: #009; text-align: center;">Report of Thorough Examination GA1</h2>
</br>

<table border="1" cellpadding="5" cellspacing="0" style=" width: 100%; font-size: 12pt;">
    <tr>
        <td width="50%" style="background-color: #accfd1;"><strong>Date:</strong> ' . (!empty($data['date1']) ? date('d/m/Y', strtotime($data['date1'])) : 'Not specified') . '</td>
        <td width="50%" style="background-color: #accfd1;"><strong>Reference:</strong> ' . $data['ref'] . '</td>
    </tr>
    <tr>
        <td style="background-color: #accfd1;"><strong>Name of employer or owner:</strong></td>
        <td>' . $data['username'] . '</td>
    </tr>
    <tr>
        <td style="background-color: #accfd1;"><strong>Address of employer:</strong></td>
        <td>' . $data['address'] . '</td>
    </tr>
    <tr>
        <td style="background-color: #accfd1;"><strong>Address where examination was made:</strong></td>
        <td>' . $data['address1'] . '</td>
    </tr>
    <tr>
        <td style="background-color: #accfd1;"><strong>Particulars identifying equipment:</strong></td>
        <td>' . $data['particulars'] . '</td>
    </tr>
    <tr>
        <td style="background-color: #accfd1;"><strong>Type of Lifting Equipment:</strong></td>
        <td>' . $data['type'] . '</td>
    </tr>
    <tr>
        <td><strong>Serial Number:</strong> ' . $data['serialnumber'] . '</td>
        <td width="50%" style=""><strong>Date:</strong> ' . (!empty($data['datem']) ? date('d/m/Y', strtotime($data['datem'])) : 'Not specified') . '</td>
    </tr>
</table>

</br>
<br>

<table border="1" cellpadding="5" cellspacing="0" style=" width: 100%; font-size: 12pt;">
    <tr bgcolor="#009" color="#FFF">
        <th width="50%"><strong>Safe Working Load</strong></th>
        <th width="50%"><strong>Configuration(s)</strong></th>
    </tr>
    <tr>
        <td>' . $data['swl1'] . '</td>
        <td>' . $data['configuration1'] . '</td>
    </tr>
    <tr>
        <td>' . $data['swl2'] . '</td>
        <td>' . $data['configuration2'] . '</td>
    </tr>
    <tr>
        <td>' . $data['swl3'] . '</td>
        <td>' . $data['configuration3'] . '</td>
    </tr>
</table>
<br>

<p style="font-size: 9pt; text-align: center;">Note: Each configuration should reflect the working arrangements as per manufacturer’s instructions.</p>

</br>
<br>
<br>

<table style=" width: 100%;border-collapse:collapse; text-align: center; font-size: medium;">
        <tbody><tr style="height: 100px;border-collapse:collapse;">
            <td style="width: 50%; border-style: solid; border-color: dimgray;"> Testing ' . renderCheckbox($t7) . '</td>
            <td style="width: 50%; border-style: solid; border-color: dimgray;"> Thorough Examination ' . renderCheckbox($t8) . '</td>
        </tr>
    </tbody></table>
    </br>
    <br>
    <br>

<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; font-size: 12pt;">
    <tr>
        <td width="50%" style="background-color: #accfd1;"><strong>Purpose of thorough examination:</strong></td>
        <td width="50%">' . $data['purpose'] . '</td>
    </tr>
    <tr>
        <td style="background-color: #accfd1;"><strong>Next examination due before:</strong></td>
       <td>' . (!empty($data['date2']) ? date('d/m/Y', strtotime($data['date2'])) : 'Not specified') . '</td>
    </tr>
</table>
</br>
<br>

<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; font-size: 12pt;">
    <tr>
        <td width="50%" style="background-color: #accfd1;"><strong>Defects dangerous to persons:</strong></td>
        <td width="50%" style="background-color: #accfd1;"><strong>Repairs required:</strong></td>
    </tr>
    <tr>
        <td>' . $data['defect1'] . '</td>
        <td>' . $data['repair1'] . '</td>
    </tr>
</table>

</br>
<br>

<table border="1" cellpadding="5" cellspacing="0" style=" width: 100%; font-size: 12pt;">
    <tr>
        <td width="33%" style="background-color: #accfd1;"><strong>Defect which could become a danger to persons:</strong></td>
        <td width="33%" style="background-color: #accfd1;"><strong>Timeframe for defect becoming a danger:</strong></td>
        <td width="33%" style="background-color: #accfd1;"><strong>Repair, renewal or alteration required to remedy this defect, including date(s)</strong></td>
    </tr>
    <tr>
        <td>' . $data['defect2'] . '</td>
        <td>' . $data['timeframe'] . '</td>
        <td>' . $data['repair2'] . '</td>
    </tr>
</table>

<br/>
<br>
<br>
<br>

<table border="1" cellpadding="5" cellspacing="0" style="background: #accfd1; width: 100%; text-align: center; font-size: medium; border-style: solid;">
  <tbody>
    

    <tr style="height: 100px; border-style: solid; border-color: dimgray; width: 100%;">
      <td style="width: 40%; border-style: solid; border-color: dimgray;">
        We have undertaken the test / thorough examination as prescribed
      </td>
      <td style="width: 10%; border-style: solid; border-color: dimgray;">
        ' . renderCheckbox($t1) . '
      </td>
      <td style="width: 40%; border-style: solid; border-color: dimgray;">
        Keep this report of thorough examination safe and available for inspection
      </td>
      <td style="width: 10%; border-style: solid; border-color: dimgray;">
        ' . renderCheckbox($t2) . '
      </td>
    </tr>

    <tr style="height: 100px; border-style: solid; border-color: dimgray; width: 100%;">
      <td style="width: 40%; border-style: solid; border-color: dimgray;">
        We have identified defects which are or could be a danger to persons
      </td>
      <td style="width: 10%; border-style: solid; border-color: dimgray;">
        ' . renderCheckbox($t3) . '
      </td>
      <td style="width: 40%; border-style: solid; border-color: dimgray;">
        Undertake identified repairs
      </td>
      <td style="width: 10%; border-style: solid; border-color: dimgray;">
        ' . renderCheckbox($t4) . '
      </td>
    </tr>

    <tr style="height: 100px; border-style: solid; border-color: dimgray; width: 100%;">
      <td style="width: 40%; border-style: solid; border-color: dimgray;">
        The particulars in this report of thorough examination are correct
      </td>
      <td style="width: 10%; border-style: solid; border-color: dimgray;">
        ' . renderCheckbox($t5) . '
      </td>
      <td style="width: 40%; border-style: solid; border-color: dimgray;">
        Arrange for a thorough examination or test before the latest date or as prescribed
      </td>
      <td style="width: 10%; border-style: solid; border-color: dimgray;">
        ' . renderCheckbox($t6) . '
      </td>
    </tr>
  </tbody>
</table>

<br/>
<br>
<br>

<table border="1" cellpadding="5" cellspacing="0" style="background-color: #accfd1; width: 100%; font-size: 12pt;">
    <tr>
        <td width="50%"><strong>Name & Qualifications (inspector):</strong><br/>' . $data['inspectorname'] . '</td>
        <td width="50%"><strong>Authorised by:</strong><br/>' . $data['authoriser'] . '</td>
    </tr>
</table>

<br/>

<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; font-size: 12pt;">
    <tr>
        <td width="50%">
            <strong>Signature (Examiner):</strong><br/>';
if (!empty($data['signature1_path']) && file_exists(__DIR__ . '/' . $data['signature1_path'])) {
    $html .= '<img src="' . $data['signature1_path'] . '" height="100" />';
} else {
    $html .= '<em>No signature</em>';
}
$html .= '</td>
        <td width="50%">
            <strong>Signature (Receiver):</strong><br/>';
if (!empty($data['signature2_path']) && file_exists(__DIR__ . '/' . $data['signature2_path'])) {
    $html .= '<img src="' . $data['signature2_path'] . '" height="100" />';
} else {
    $html .= '<em>No signature</em>';
}
$html .= '</td>
    </tr>
</table>';

// Generate unique filename with timestamp
$pdfFileName = 'ga1_' . $token . '_' . time() . '.pdf';
$pdfPath = 'uploads/' . $pdfFileName;
$absolutePath = __DIR__ . '/' . $pdfPath;

if (!file_exists(__DIR__ . '/uploads')) {
    mkdir(__DIR__ . '/uploads', 0755, true);
}
$pdf->writeHTML($html, true, false, true, false, '');

// Save the PDF
$pdf->Output(__DIR__ . '/' . $pdfPath, 'F');
// Verify PDF was created
if (!file_exists($absolutePath)) {
    die("Failed to generate PDF file");
}
// Update database with PDF path
$stmt = $pdo->prepare("UPDATE ga1 SET pdf_url = :pdf_url WHERE token = :token");
$stmt->execute([
    ':pdf_url' => $pdfPath,
    ':token' => $token
]);

// Check if update was successful
if ($stmt->rowCount() === 0) {
    die("Failed to update database with PDF path");
}

// Redirect with cache-busting
header("Location: view.php?token=" . urlencode($token) . "&t=" . time());
exit;
?>
