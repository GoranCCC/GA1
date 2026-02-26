<?php
require_once('db_connect.php');

$token = $_GET['token'] ?? '';
if (!$token) {
    die('Invalid request.');
}

// Fetch ref and qr path from the database
$stmt = $pdo->prepare("SELECT ref, serialnumber FROM ga1 WHERE token = :token LIMIT 1");
$stmt->execute(['token' => $token]);
$result = $stmt->fetch();

if (!$result) {
    die('Record not found.');
}

$ref = htmlspecialchars($result['ref']);
$serialnumber = htmlspecialchars($result['serialnumber']);
$qrPath = 'uploads/qr_' . $token . '.png';
if (!file_exists($qrPath)) {
    die('QR code not found.');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$ref?></title>
    <style>
        body {
            text-align: center;
            margin: 30px;
            font-family: Arial, sans-serif;
        }
        img {
            max-width: 100%;
            height: auto;
        }

        <style>
        .fixed-picture {
            width: 50px;   
            height: auto;   
            margin-bottom: 5px; 
            display: block;
            margin-left: auto;
            margin-right: auto;  
        }

        h2 {
            margin-bottom: 20px;
            font-size: 36px;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            h2 {
                font-size: 50pt;
                margin-bottom: 30px;
            }
            img {
                width: 300px;
                height: 300px;
            }
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</head>
<body>
    <img src="./ga1_files/CCC-logo.png" alt="Logo" class="fixed-picture">
    <h2><?=$ref?></h2>
    <h2>S/N: <?=$serialnumber?></h2>
    <img src="<?=$qrPath?>" alt="QR Code">
</body>
</html>


