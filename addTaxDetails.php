<?php

include 'connection.php';

if(isset($_POST['submit'])) {
    $finYear = $_POST['fin_year'];
    $custName = mysqli_real_escape_string($conn, $_POST['cust_name']);
    $custAddress = mysqli_real_escape_string($conn, $_POST['cust_address']);
    $custMobile = $_POST['cust_mobile'];
    $wardName = mysqli_real_escape_string($conn, $_POST['ward_name']);
    $houseNumber = mysqli_real_escape_string($conn, $_POST['house_number']);
    $arrears = $_POST['arrears'];
    $fineAmt = $_POST['fine_amt'];
    $taxAmt = $_POST['tax_amt'];
    $totalTax = $_POST['total_tax'];
    $totalPayableTax = $_POST['total_payable_tax'];
    $paidAmt = $_POST['paid_amt'];
    $paymentMode = $_POST['payment_mode'];
    $paidBy = mysqli_real_escape_string($conn, $_POST['paid_by']);
    $paymentDate = $_POST['payment_date'];
    $collectedBy = mysqli_real_escape_string($conn, $_POST['collected_by']);

    $sql = "select id from users where first_name = '".$custName."' and mobile1 = '".$custMobile."' limit 1";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if(mysqli_num_rows($res) < 1) {
        $sql = "insert into users (first_name, mobile1, created_on) values ('".$custName."', '".$custMobile."', now()) ";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        $sql = "select id from users where first_name = '".$custName."' and mobile1 = '".$custMobile."' limit 1";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if(mysqli_num_rows($res) > 0) {echo "\n===";
            $data = mysqli_fetch_array($res);
            $userId = $data['id'];

            $sql = "insert into address_details (user_id, address, created_on) values ('".$userId."', '".$custAddress."', now()) ";
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        }

    } else {
        $data = mysqli_fetch_array($res);
        $userId = $data['id'];
    }
    
    $sql = "select id from tax_details where financial_year = '".$finYear."' and customer_id = '".$userId."' and status=1 limit 1";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if(mysqli_num_rows($res) < 1) {
        $sql = "insert into tax_details (financial_year, customer_id, ward_name, house_no, arrears, fine_amount, tax_amount, total_tax, total_payable_tax, amount_paid, mode_of_payment, paid_by, date_of_payment, collected_by, created_on) values ('".$finYear."', '".$userId."', '".$wardName."', '".$houseNumber."', '".$arrears."', '".$fineAmt."', '".$taxAmt."', '".$totalTax."', '".$totalPayableTax."', '".$paidAmt."', '".$paymentMode."', '".$paidBy."', '".$paymentDate."', '".$collectedBy."', now()) ";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if($res) {
            header('location:displayTaxDetails.php');
        }
    } else {
        echo "Details already exists for the selected User and Financial Year.";
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Tax Details</title>
  </head>
  <body>
    <div class="container my-5 border">
        <form method="POST">
            <h3 align="center" class="my-3">Add Tax Details</h3>
            <hr/>
            <!--div-- class="mb-3">
                <label>Financial Year</label>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Financial Year
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="#">2022-23</a></li>
                        <li><a class="dropdown-item" href="#">2023-24</a></li>
                        <li><a class="dropdown-item" href="#">2024-25</a></li>
                    </ul>
                </div>
            </!--div-->
            <div class="mb-3">
                <label>Financial Year</label>
                <input type="text" class="form-control" name="fin_year" placeholder="Enter Finalcial Year" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Customer Name</label>
                <input type="text" class="form-control" name="cust_name" placeholder="Enter Customer Name" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Customer Address</label>
                <input type="text" class="form-control" name="cust_address" placeholder="Enter Customer Address" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Mobile Number</label>
                <input type="text" class="form-control" name="cust_mobile" placeholder="Enter Customer Mobile Number" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Ward Name</label>
                <input type="text" class="form-control" name="ward_name" placeholder="Enter Ward Name" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>House Number</label>
                <input type="text" class="form-control" name="house_number" placeholder="Enter House Number" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Arrears</label>
                <input type="text" class="form-control" name="arrears" placeholder="Enter Arrears Amount" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Fine Amount</label>
                <input type="text" class="form-control" name="fine_amt" placeholder="Enter Fine Amount" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Tax Amount</label>
                <input type="text" class="form-control" name="tax_amt" placeholder="Enter Total Amount" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Total Tax</label>
                <input type="text" class="form-control" name="total_tax" placeholder="Enter Total Tax" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Total Payable Tax</label>
                <input type="text" class="form-control" name="total_payable_tax" placeholder="Enter Total Payable Tax" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Amount Paid</label>
                <input type="text" class="form-control" name="paid_amt" placeholder="Enter Amount Paid" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Mode Of Payment</label>
                <input type="text" class="form-control" name="payment_mode" placeholder="Enter Mode Of Payment" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Paid By</label>
                <input type="text" class="form-control" name="paid_by" placeholder="Enter Name of Payer" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Date Of Payment</label>
                <input type="text" class="form-control" name="payment_date" placeholder="Enter Date Of Payment" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Collected By</label>
                <input type="text" class="form-control" name="collected_by" placeholder="Enter Name" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary mb-3" name="submit">Submit</button>
        </form>
    </div>
  </body>
</html>