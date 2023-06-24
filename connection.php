<?php

$conn = new mysqli('localhost', 'root', '', 'panchayat-cloud-data-management');

if(!$conn) {
    die(mysqli_error($conn));
}

?>