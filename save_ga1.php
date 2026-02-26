<?php
require_once('db_connect.php');
require_once('tcpdf/tcpdf.php');
require_once('phpqrcode/qrlib.php');


// Create directories if they don't exist
$directories = ['signatures', 'uploads', 'logs'];
foreach ($directories as $dir) {
    if (!file_exists($dir) && !mkdir($dir, 0755)) {
        error_log("Failed to create directory: $dir");
        die(json_encode(['error' => 'System configuration error']));
    }
}
if (isset($_POST['username']) && $_POST['username'] === '__other__') {
  $_POST['username'] = trim($_POST['username_other'] ?? '');
}

// Input validation function
function validateInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Date formatting function
function formatDateForDB($dateString) {
    $dateString = trim($dateString);
    if (empty($dateString)) return null;
    $date = DateTime::createFromFormat('d/m/Y', $dateString);
    if ($date && $date->format('d/m/Y') === $dateString) {
        return $date->format('Y-m-d');
    }
    $timestamp = strtotime($dateString);
    return $timestamp === false ? null : date('Y-m-d', $timestamp);
}

// Process signatures
function processSignature($data) {
    if (empty($data)) return null;
    $data = str_replace(['data:image/png;base64,', ' '], ['', '+'], $data);
    $decoded = base64_decode($data);
    if (!$decoded) throw new Exception("Invalid signature data");
    $filename = 'signatures/sig_' . bin2hex(random_bytes(8)) . '.png';
    if (!file_put_contents($filename, $decoded)) {
        throw new Exception("Failed to save signature");
    }
    return $filename;
}

try {
    // Required fields validation
    $required = ['date1', 'ref', 'username', 'particulars', 'type', 'serialnumber'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Missing required field: $field");
        }
    }

    // Generate token and QR code file path early
    $token = bin2hex(random_bytes(16));
    $qrFilePath = 'uploads/qr_' . $token . '.png';
    $qrUrlLink = 'https://' . $_SERVER['HTTP_HOST'] . '/view.php?token=' . $token;
    QRcode::png($qrUrlLink, $qrFilePath);

    // Prepare data for DB
    $data = [
        'date1' => formatDateForDB(validateInput($_POST['date1'])),
        'ref' => validateInput($_POST['ref']),
        'username' => validateInput($_POST['username']),
        'address' => validateInput($_POST['address'] ?? ''),
        'address1' => validateInput($_POST['address1'] ?? ''),
        'particulars' => validateInput($_POST['particulars']),
        'type' => validateInput($_POST['type']),
        'serialnumber' => validateInput($_POST['serialnumber']),
        'datem' => formatDateForDB(validateInput($_POST['datem'] ?? '')),
        'swl1' => validateInput($_POST['swl1'] ?? ''),
        'configuration1' => validateInput($_POST['configuration1'] ?? ''),
        'swl2' => validateInput($_POST['swl2'] ?? ''),
        'configuration2' => validateInput($_POST['configuration2'] ?? ''),
        'swl3' => validateInput($_POST['swl3'] ?? ''),
        'configuration3' => validateInput($_POST['configuration3'] ?? ''),
        'date2' => formatDateForDB(validateInput($_POST['date2'] ?? '')),
        'defect1' => validateInput($_POST['defect1'] ?? 'None'),
        'repair1' => validateInput($_POST['repair1'] ?? ''),
        'defect2' => validateInput($_POST['defect2'] ?? 'None'),
        'timeframe' => validateInput($_POST['timeframe'] ?? ''),
        'repair2' => validateInput($_POST['repair2'] ?? ''),
        'parts' => validateInput($_POST['parts'] ?? 'None'),
        'inspectorname' => validateInput($_POST['inspectorname']),
        'authoriser' => validateInput($_POST['authoriser']),
        'purpose' => validateInput($_POST['purpose'] ?? ''),
        'tick1' => isset($_POST['tick1']) ? 1 : 0,
        'tick2' => isset($_POST['tick2']) ? 1 : 0,
        'tick3' => isset($_POST['tick3']) ? 1 : 0,
        'tick4' => isset($_POST['tick4']) ? 1 : 0,
        'tick5' => isset($_POST['tick5']) ? 1 : 0,
        'tick6' => isset($_POST['tick6']) ? 1 : 0,
        'test' => isset($_POST['test']) ? 1 : 0,
        'exam' => isset($_POST['exam']) ? 1 : 0,
        'signature1' => processSignature($_POST['signature1_data'] ?? ''),
        'signature2' => processSignature($_POST['signature2_data'] ?? ''),
        'token' => $token,
        'qr_url' => $qrFilePath
    ];

    // Insert into DB including qr_url
    $stmt = $pdo->prepare("INSERT INTO ga1 (
        date1, ref, username, address, address1, particulars, type, serialnumber,
        datem, swl1, configuration1, swl2, configuration2, swl3, configuration3,
        date2, defect1, repair1, defect2, timeframe, repair2, parts, inspectorname,
        authoriser, purpose, tick1, tick2, tick3, tick4, tick5, tick6,
        signature1_path, signature2_path, token, qr_url, test, exam
    ) VALUES (
        :date1, :ref, :username, :address, :address1, :particulars, :type, :serialnumber,
        :datem, :swl1, :configuration1, :swl2, :configuration2, :swl3, :configuration3,
        :date2, :defect1, :repair1, :defect2, :timeframe, :repair2, :parts, :inspectorname,
        :authoriser, :purpose, :tick1, :tick2, :tick3, :tick4, :tick5, :tick6,
        :signature1, :signature2, :token, :qr_url, :test, :exam
    )");
    $stmt->execute($data);


// Extract tick values from form data
$t1 = $data['tick1'] ?? '0';
$t2 = $data['tick2'] ?? '0';
$t3 = $data['tick3'] ?? '0';
$t4 = $data['tick4'] ?? '0';
$t5 = $data['tick5'] ?? '0';
$t6 = $data['tick6'] ?? '0';
$t7 = $data['test'] ?? '0';
$t8 = $data['exam'] ?? '0';

// Function to show checkbox-like symbol
function renderCheckbox($value) {
    $checked = ($value == "1");
    return $checked 
        ? '<span style="color:blue; font-size:14pt">☑</span>' 
        : '<span style="font-size:14pt">☐</span>';
}

// PDF generation
$pdf = new TCPDF();
$pdf->SetFont('dejavusans', 14);
$pdf->SetCreator('Safety First Consultancy');
$pdf->SetAuthor($data['inspectorname']);
$pdf->SetTitle('GA1 Report - ' . $data['ref']);
$pdf->AddPage();
$pdf->Image('./ga1_files/CCC-logo.png', $x =165, $y =0, 32, 50);


// Start HTML content
$html = '
<br>
<br>
<h2 style="color: #009; text-align: center;">Report of Thorough Examination GA1</h2>
</br>

<table border="1" cellpadding="5" cellspacing="0" style=" width: 100%; font-size: 12pt;">
    <tr>
        <td width="50%" style="background-color: #accfd1;"><strong>Date:</strong> ' . $data['date1'] . '</td>
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
        <td><strong>Date:</strong> ' . $data['datem'] . '</td>
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
        <td>' . $data['date2'] . '</td>
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

<table border="1" cellpadding="5" cellspacing="0" style=" width: 100%; font-size: 12pt;">
    <tr>
        <td width="50%"><strong>Signature (Examiner):</strong><br/><img src="' . $data['signature1'] . '" height="100" /></td>
        <td width="50%"><strong>Signature (Receiver):</strong><br/><img src="' . $data['signature2'] . '" height="100" /></td>
    </tr>
</table>
';


// Output PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Define PDF filename and paths
$pdfFilename = 'ga1_' . $data['ref'] . '.pdf';
$pdfRelativePath = 'uploads/' . $pdfFilename;
$pdfFullPath = __DIR__ . '/' . $pdfRelativePath;

// Save PDF file to server
$pdf->Output($pdfFullPath, 'F');

// Get the last inserted ID
$lastId = $pdo->lastInsertId();

// Update PDF path in the database for this record
$updateStmt = $pdo->prepare("UPDATE ga1 SET pdf_url = ? WHERE id = ?");
$updateStmt->execute([$pdfRelativePath, $lastId]);

// Now output confirmation HTML
echo '<!DOCTYPE html>
<html>
<head>
    <title>Form Submitted</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 40px;
        }
        .button {
            display: inline-block;
            margin: 12px;
            padding: 14px 24px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
        }
        .button:hover {
            background: #0056b3;
        }
        .button-green {
            background: #28a745;
        }
        .button-green:hover {
            background: #218838;
        }
        h2 {
            color: #333;
        }
        .button-group {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <h2>Your GA1 form has been saved successfully!</h2>
    
    <div class="button-group">
        <a class="button" href="view.php?token='.$token.'" target="_blank">View Submission</a>
        <a class="button" href="'.$pdfRelativePath.'" target="_blank">View PDF</a>
        <a class="button" href="print_qr.php?token='.$token.'" target="_blank">Print QR Code</a>
    </div>

    <a class="button button-green" href="ga1.php">Create New GA1</a>

</body>
</html>';
}
catch (Exception $e) {
    error_log("GA1 Form Error: " . $e->getMessage());
    header('HTTP/1.1 400 Bad Request');
    die(json_encode(['error' => $e->getMessage()]));
}
?>