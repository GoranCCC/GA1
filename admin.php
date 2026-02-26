<?php

require_once('db_connect.php');
$stmt = $pdo->query("SELECT * FROM ga1 ORDER BY created_at DESC");
$forms = $stmt->fetchAll(PDO::FETCH_ASSOC);
$companies = array_values(array_unique(array_column($forms, 'username')));
sort($companies);
?>
<!DOCTYPE html>
<html>
<head>
  <title>GA1 Submission Records</title>
  <meta charset="UTF-8">
  <style>
    table { border-collapse: collapse; width: 100%; }
    th, td { padding: 8px; border: 1px solid #ccc; }
    th { cursor: pointer; background: #f2f2f2; }
  </style>
</head>
<body>

<h2>GA1 Submissions List</h2>

<!-- Filters -->
<div style="display:flex; gap:10px; align-items:center; margin-bottom:10px;">
  <input
    type="text"
    id="ga1Search"
    placeholder="Search GA1 records..."
    style="padding:8px; width:300px;"
    onkeyup="applyFilters()"
  />

  <select id="companyFilter" onchange="applyFilters()" style="padding:8px;">
    <option value="">All Companies</option>
    <?php foreach ($companies as $c): ?>
      <option value="<?= htmlspecialchars($c) ?>"><?= htmlspecialchars($c) ?></option>
    <?php endforeach; ?>
  </select>
</div>

<a href="export_ga1_excel.php"
   style="padding:8px 12px; background:#1d4ed8; color:#fff; border-radius:6px; text-decoration:none;">
  Export to Excel
</a>


<table id="ga1Table">
  <thead>
    <tr>
      <th onclick="sortGA1(0)">ID ⇅</th>
      <th onclick="sortGA1(1)">Reference ⇅</th>
      <th onclick="sortGA1(2)">Company ⇅</th>
      <th onclick="sortGA1(3)">Serial No. ⇅</th>
      <th>PDF</th>
      <th>QR</th>
      <th onclick="sortGA1(6)">Token ⇅</th>
      <th onclick="sortGA1(7)">Created ⇅</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($forms as $f): ?>
      <tr>
        <td><?= (int)$f['id'] ?></td>
        <td><?= htmlspecialchars($f['ref'] ?? '') ?></td>
        <td><?= htmlspecialchars($f['username'] ?? '') ?></td>
        <td><?= htmlspecialchars($f['serialnumber'] ?? '') ?></td>
        <td>
          <?php if (!empty($f['pdf_url'])): ?>
            <a href="<?= htmlspecialchars($f['pdf_url']) ?>" target="_blank">View PDF</a>
          <?php else: ?>
            No PDF
          <?php endif; ?>
        </td>
        <td>
          <img src="uploads/qr_<?= htmlspecialchars($f['token'] ?? '') ?>.png" width="120" alt="QR">
        </td>
        <td><?= htmlspecialchars($f['token'] ?? '') ?></td>
        <td><?= htmlspecialchars($f['created_at'] ?? '') ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<script>
function applyFilters() {
  const search = document.getElementById("ga1Search").value.toLowerCase();
  const company = document.getElementById("companyFilter").value;

  const rows = document.querySelectorAll("#ga1Table tbody tr");

  rows.forEach(row => {
    const textMatch = row.innerText.toLowerCase().includes(search);
    const companyCell = row.cells[2].innerText.trim();
    const companyMatch = !company || companyCell === company;

    row.style.display = (textMatch && companyMatch) ? "" : "none";
  });
}
</script>

<script>
let ga1SortCol = null;
let ga1SortAsc = true;

function sortGA1(colIndex) {
  const table = document.getElementById("ga1Table");
  const tbody = table.tBodies[0];
  const rows = Array.from(tbody.rows);

  if (ga1SortCol === colIndex) ga1SortAsc = !ga1SortAsc;
  else { ga1SortCol = colIndex; ga1SortAsc = true; }

  rows.sort((a, b) => {
    let A = a.cells[colIndex].innerText.trim().toLowerCase();
    let B = b.cells[colIndex].innerText.trim().toLowerCase();

    const numA = parseFloat(A);
    const numB = parseFloat(B);

    if (!isNaN(numA) && !isNaN(numB)) return ga1SortAsc ? numA - numB : numB - numA;
    return ga1SortAsc ? A.localeCompare(B) : B.localeCompare(A);
  });

  rows.forEach(row => tbody.appendChild(row));
}
</script>
<script>
function exportGA1ToCSV() {
  const table = document.getElementById("ga1Table");
  const rows = table.querySelectorAll("thead tr, tbody tr");

  let csv = [];
  for (const row of rows) {
    // skip hidden rows (filtered out)
    if (row.parentElement.tagName.toLowerCase() === "tbody" && row.style.display === "none") continue;

    const cells = row.querySelectorAll("th, td");
    const rowData = [];

    cells.forEach((cell, index) => {
      let text = "";

      // For the PDF column: export link url if exists
      if (cell.querySelector("a")) {
        text = cell.querySelector("a").getAttribute("href") || cell.innerText;
      }
      // For QR column: export image src if exists
      else if (cell.querySelector("img")) {
        text = cell.querySelector("img").getAttribute("src") || "";
      }
      else {
        text = cell.innerText;
      }

      text = text.replace(/"/g, '""'); // escape quotes
      rowData.push(`"${text.trim()}"`);
    });

    csv.push(rowData.join(","));
  }

  const csvString = csv.join("\n");
  const blob = new Blob([csvString], { type: "text/csv;charset=utf-8;" });
  const url = URL.createObjectURL(blob);

  const link = document.createElement("a");
  link.href = url;
  link.download = "ga1_export.csv";
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}
</script>

</body>
</html>
