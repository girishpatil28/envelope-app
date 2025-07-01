<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Envelope Budget App</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Envelope Budget Dashboard</h2>

  <?php
  // Total income
  $income_result = mysqli_query($conn, "SELECT SUM(amount) as total FROM income");
  $income = mysqli_fetch_assoc($income_result)['total'] ?? 0;

  // Total allocated to envelopes
  $envelopes_result = mysqli_query($conn, "SELECT SUM(balance) as total FROM envelopes");
  $allocated = mysqli_fetch_assoc($envelopes_result)['total'] ?? 0;

  $unallocated = $income - $allocated;
  ?>

  <p><strong>Total Income:</strong> ₹<?= number_format($income, 2) ?></p>
  <p><strong>Unallocated Funds:</strong> ₹<?= number_format($unallocated, 2) ?></p>
  <div class = "navigation">
  <a href="add_income.php">➕ Add Income</a> 
  <a href="allocate.php">📂 Allocate to Envelope</a> 
  <a href="spend.php">💸 Spend from Envelope</a>
  </div>
  <h3>Envelopes</h3>
  <table border="1" cellpadding="6">
    <tr><th>Name</th><th>Balance</th></tr>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM envelopes");
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr><td>{$row['name']}</td><td>₹" . number_format($row['balance'], 2) . "</td></tr>";
    }
    ?>
  </table>
</body>
</html>
