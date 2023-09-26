<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herhaaling opdracht👍😼</title>
    <link rel="stylesheet" href="style.css?v=">
</head>
<body>
<?php
$mysqli = mysqli_connect("localhost", "PDO", "PDOWachtwoord", "lijststudenten");
$query = "SELECT * FROM studentinfo ORDER BY Achternaam DESC";
$result = mysqli_query($mysqli, $query);
$count = mysqli_num_rows($result);
?>
<div class="head-container">
  <div class="container-left">
    <div class="search-container">
      <input class="search" type="text">
      <i id="search-icon" class="fa-solid fa-magnifying-glass"></i>
    </div>

    <div class="sort">
      <div class="sort-container">
        <p class="sort-text">Sort by:</p>
        <button class="sort-button" data-value="1">Z-A</button>
        <button class="sort-button" data-value="2">A-Z</button>
      </div>
    </div>

    <!-- add the export button -->
    <div class="export">
      <form method="post" action="./export.php">
        <button type="submit" name="export" class="export-button">Export as CSV</button>
      </form>
      <form action="./pdf.php" class="pdf-form"method="post">
      <a href="./pdf.php" class="btn">Exporteer naar PDF</a>
      </form>
    </div>
  </div>

  <div class="card-container">
  <?php while($row = mysqli_fetch_array($result)): ?>
    <div class="card" id="card-<?php echo $row['ID']; ?>" data-lastname="<?php echo $row['Achternaam']; ?>">
      <div class="card-header">
        <h2 class="card-name"><?php echo $row['Naam'] . ' ' . $row['Achternaam']; ?></h2>
      </div>
      <div class="card-body">
        <?php if (!empty($row['Tussenvoegsel'])): ?>
          <p class="card-info" id="tussenvoegsel-<?php echo $row['ID']; ?>" style="display: none;">Tussenvoegsel: <?php echo $row['Tussenvoegsel']; ?></p>
        <?php endif; ?>
      </div> 
      <div class="card-body">
        <p class="card-info" id="telefoonnummer-<?php echo $row['ID']; ?>" style="display: none;">Telefoonnummer: <?php echo $row['Telefoonnummer']; ?></p>
      </div>
      <div class="card-body">
        <p class="card-info" id="email-<?php echo $row['ID']; ?>" style="display: none;">Email: <a href="./forum.php"<?php echo $row['Email']; ?>><?php echo $row['Email']; ?></a></p>
      </div>
    </div>
  <?php endwhile; ?>
</div>
</div>

</body>
<script src="https://kit.fontawesome.com/19b050893f.js" crossorigin="anonymous"></script>
<script src="./script.js"></script>
</html>







        