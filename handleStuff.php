<?php

$productId = (isset($_POST['hidProductId'])) ? (int) htmlspecialchars($_POST['hidProductId']) : 0;

$paymentData = array();
$paymentData .= $_POST['firstname'];
$paymentData .= $_POST['email'];
$paymentData .= $_POST['address'];
$paymentData .= $_POST['city'];
$paymentData .= $_POST['state'];
$paymentData .= $_POST['zip'];
$paymentData .= $_POST['cardname'];
$paymentData .= $_POST['cardnumber'];
$paymentData .= $_POST['expmonth'];
$paymentData .= $_POST['expyear'];
$paymentData .= $_POST['cvv'];


print_r($paymentData);

include 'objects.php';

$test = new Test();

?>