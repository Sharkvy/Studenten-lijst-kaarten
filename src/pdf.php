<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

use Dompdf\Dompdf;
use Dompdf\Options;

require_once __DIR__ . '/../vendor/autoload.php';

$mysqli = mysqli_connect("localhost", "PDO", "PDOWachtwoord", "lijststudenten");
$query = "SELECT * FROM studentinfo";
$result = mysqli_query($mysqli, $query);
$count = mysqli_num_rows($result);

// Fetch card data from your database
$cardData = []; // Initialize an empty array

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cardData[] = $row; // Append the row to the $cardData array
    }
}

// Initialize Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options); // Create an instance of Dompdf

// HTML content for the PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Data PDF</title>
    <style>
    h1 {
        text-align: center;
    }
    .container {
        margin: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #184e77;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #184e77;
        color: white;
    }
</style>
</head>
<body>
    <h1>User Data</h1>';

// Add data from your cards here
$html .= '<div class="container">';
$html .= '<table>';
$html .= '<tr><th>Name</th><th>Phone Number</th><th>Email</th></tr>';

// Loop through the card data
foreach ($cardData as $row) {
    $fullName = $row["Naam"] . " " . $row["Tussenvoegsel"] . " " . $row["Achternaam"];
    $html .= "<tr><td>{$fullName}</td><td>{$row['Telefoonnummer']}</td><td>{$row['Email']}</td></tr>";
}

$html .= '</table>';
$html .= '</div>';
$html .= '</body></html>';

// Load HTML content
$dompdf->loadHtml($html);

// Set paper size and orientation (e.g., A4 portrait)
$dompdf->setPaper('A4', 'portrait');

// Render PDF (first rendering call will generate the PDF)
$dompdf->render();

// Output the PDF to the browser and trigger download
$dompdf->stream('user_data.pdf', array('Attachment' => 1));
?>
