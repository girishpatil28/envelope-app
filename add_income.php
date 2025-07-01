<?php include 'db.php';?>

<h2> Add Income</h2>
<form method = "POST">
    Amount: <input type ="number" step ="o.o1" name ="amount" required>
    <input type = "submit" name= "submit" value="Add">
</form>

<stylesheetlink rel = "" href = "style.css">

<?php
if (isset ($_POST['submit'])){
    $amount = $_POST['amount'];
    mysqli_query($conn, "INSERT INTO income(amount)VALUES($amount)");
    header ("Location: index.php");
}
?>