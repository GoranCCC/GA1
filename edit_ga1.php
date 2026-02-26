<?php
require_once('db_connect.php');
require_once('tcpdf/tcpdf.php');
require_once('phpqrcode/qrlib.php');

$token = $_GET['token'] ?? '';

// Fetch data
$stmt = $pdo->prepare("SELECT * FROM ga1 WHERE token = ?");
$stmt->execute([$token]);
$form = $stmt->fetch();

if (!$form) {
    die("Invalid token.");
}

// Display form
?>
<form method="POST" action="update_ga1.php">
    <input type="hidden" name="old_token" value="<?= $form['token'] ?>">
    Inspector: <input type="text" name="inspector_name" value="<?= htmlspecialchars($form['inspector_name']) ?>">
    <button type="submit">Save New Version</button>
</form>
