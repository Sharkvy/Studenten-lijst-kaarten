<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require_once __DIR__ . '/../vendor/autoload.php';


if (isset($_POST['export'])) {
  $mysqli = mysqli_connect("localhost", "PDO", "PDOWachtwoord", "lijststudenten");
  $query = "SELECT * FROM studentinfo ORDER BY Achternaam DESC";
  $result = mysqli_query($mysqli, $query);

  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="studentinfo.csv"');
  $output = fopen('php://output', 'w');
  fputcsv($output, array('ID', 'Naam', 'Tussenvoegsel', 'Achternaam', 'Telefoonnummer', 'Email'));

  while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
  }

  fclose($output);
  exit();
}
?>
</body>
</html>