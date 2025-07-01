<?php include 'db.php';?>

<h2> Spend from Envelope</h2>

<form method ="POST">
    Envelope Name:
    <input type ="text" name ="name" required><br>
    Amount to Spend:
    <input type ="number" step="o.o1" name="amount" required><br>
    <input type ="submit" name ="submit" value="spend">
</form>
<link rel="stylesheet" href="style.css">
<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $amount =$_POST['amount'];

    $envelope = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM envelopes WHERE name ='$name'"));
    if(!$envelope){
        echo" envelope not found.";
    }elseif ($amount >$envelope['balance']){
        echo" not enough balance.";
    }else {
        $new_balance = $envelope['balance']-$amount;
        mysqli_query($conn,"UPDATE envelope SET balance=$new_balance WHERE name='$name'");
        header ("Location: index.php");
    }
}
?>