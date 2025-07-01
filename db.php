<?php
$conn = mysqli_connect("localhost", "root", "2829", "envelope_budget");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
