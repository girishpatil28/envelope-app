<?php include 'db.php'; ?>

<h2>Allocate to Envelope</h2>

<form method="POST">
  Envelope Name:
  <input type="text" name="name" required><br>
  Amount:
  <input type="number" step="0.01" name="amount" required><br>
  <input type="submit" name="submit" value="Allocate">
</form>
<link rel="stylesheet" href="style.css">

<?php
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $amount = $_POST['amount'];

  // Check current unallocated
  $income = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) as total FROM income"))['total'] ?? 0;
  $allocated = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(balance) as total FROM envelopes"))['total'] ?? 0;
  $unallocated = $income - $allocated;

  if ($amount > $unallocated) {
    echo "❌ Not enough unallocated funds!";
  } else {
    // Add or update envelope
    $exists = mysqli_query($conn, "SELECT * FROM envelopes WHERE name='$name'");
    if (mysqli_num_rows($exists)) {
      mysqli_query($conn, "UPDATE envelopes SET balance = balance + $amount WHERE name='$name'");
    } else {
      mysqli_query($conn, "INSERT INTO envelopes (name, balance) VALUES ('$name', $amount)");
    }
    header("Location: index.php");
  }
}
?>
