<?php

include 'connection.php';

if(isset($_GET['tax_details_id'])) {
    $taxDetailsId = $_GET['tax_details_id'];
}

$sql = "update tax_details set status = 0 where id = '".$taxDetailsId."' ";
$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if($res) {
    header('location:displayTaxDetails.php');
}

?>