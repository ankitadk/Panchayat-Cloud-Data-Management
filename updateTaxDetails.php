<?php

include 'connection.php';

if(isset($_GET['tax_details_id'])) {
    $taxDetailsId = $_GET['tax_details_id'];
}

$sql = "select td.financial_year, CONCAT_WS('', u.first_name, u.middle_name, u.last_name) AS cust_name, ad.address, u.mobile1, td.ward_name, td.house_no, td.arrears, td.fine_amount, td.tax_amount, td.total_tax, td.total_payable_tax, td.amount_paid, td.mode_of_payment, td.paid_by, td.date_of_payment, td.collected_by from tax_details AS td INNER JOIN users AS u ON td.customer_id = u.id INNER JOIN address_details AS ad ON u.id = ad.user_id where td.status = 1 and td.id = '".$taxDetailsId."' ";
$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$data = mysqli_fetch_assoc($res);
if(!empty($data)) {
    $finYear = $data['financial_year'];
    $custName = $data['cust_name'];
    $custAddress = $data['address'];
    $custMobile = $data['mobile1'];
    $wardName = $data['ward_name'];
    $houseNumber = $data['house_no'];
    $arrears = $data['arrears'];
    $fineAmt = $data['fine_amount'];
    $taxAmt = $data['tax_amount'];
    $totalTax = $data['total_tax'];
    $totalPayableTax = $data['total_payable_tax'];
    $paidAmt = $data['amount_paid'];
    $paymentMode = $data['mode_of_payment'];
    $paidBy = $data['paid_by'];
    $paymentDate = $data['date_of_payment'];
    $collectedBy = $data['collected_by'];
}

if(isset($_POST['submit'])) {
    $finYear = $_POST['fin_year'];
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

    $sql = "update tax_details set financial_year = '".$finYear."', ward_name = '".$wardName."', house_no = '".$houseNumber."', arrears = '".$arrears."', fine_amount = '".$fineAmt."', tax_amount = '".$taxAmt."', total_tax = '".$totalTax."', total_payable_tax = '".$totalPayableTax."', amount_paid = '".$paidAmt."', mode_of_payment = '".$paymentMode."', paid_by = '".$paidBy."', date_of_payment = '".$paymentDate."', collected_by = '".$collectedBy."', updated_on = now() where id = '".$taxDetailsId."' ";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if($res) {
        header('location:displayTaxDetails.php');
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
            <h3 align="center" class="my-3">Update Tax Details</h3>
            <hr/>            
            <div class="mb-3">
                <label>Financial Year</label>
                <input type="text" class="form-control" name="fin_year" placeholder="Enter Finalcial Year" autocomplete="off" value="<?php echo $finYear; ?>">
            </div>
            <div class="mb-3">
                <label>Customer Name</label>
                <input type="text" class="form-control" name="cust_name" placeholder="Enter Customer Name" readonly value="<?php echo $custName; ?>">
            </div>
            <div class="mb-3">
                <label>Customer Address</label>
                <input type="text" class="form-control" name="cust_address" placeholder="Enter Customer Address" autocomplete="off" value="<?php echo $custAddress; ?>">
            </div>
            <div class="mb-3">
                <label>Mobile Number</label>
                <input type="text" class="form-control" name="cust_mobile" placeholder="Enter Customer Mobile Number" autocomplete="off" value="<?php echo $custMobile; ?>">
            </div>
            <div class="mb-3">
                <label>Ward Name</label>
                <input type="text" class="form-control" name="ward_name" placeholder="Enter Ward Name" autocomplete="off" value="<?php echo $wardName; ?>">
            </div>
            <div class="mb-3">
                <label>House Number</label>
                <input type="text" class="form-control" name="house_number" placeholder="Enter House Number" autocomplete="off" value="<?php echo $houseNumber; ?>">
            </div>
            <div class="mb-3">
                <label>Arrears</label>
                <input type="text" class="form-control" name="arrears" placeholder="Enter Arrears Amount" autocomplete="off" value="<?php echo $arrears; ?>">
            </div>
            <div class="mb-3">
                <label>Fine Amount</label>
                <input type="text" class="form-control" name="fine_amt" placeholder="Enter Fine Amount" autocomplete="off" value="<?php echo $fineAmt; ?>">
            </div>
            <div class="mb-3">
                <label>Tax Amount</label>
                <input type="text" class="form-control" name="tax_amt" placeholder="Enter Total Amount" autocomplete="off" value="<?php echo $taxAmt; ?>">
            </div>
            <div class="mb-3">
                <label>Total Tax</label>
                <input type="text" class="form-control" name="total_tax" placeholder="Enter Total Tax" autocomplete="off" value="<?php echo $totalTax; ?>">
            </div>
            <div class="mb-3">
                <label>Total Payable Tax</label>
                <input type="text" class="form-control" name="total_payable_tax" placeholder="Enter Total Payable Tax" autocomplete="off" value="<?php echo $totalPayableTax; ?>">
            </div>
            <div class="mb-3">
                <label>Amount Paid</label>
                <input type="text" class="form-control" name="paid_amt" placeholder="Enter Amount Paid" autocomplete="off" value="<?php echo $paidAmt; ?>">
            </div>
            <div class="mb-3">
                <label>Mode Of Payment</label>
                <input type="text" class="form-control" name="payment_mode" placeholder="Enter Mode Of Payment" autocomplete="off" value="<?php echo $paymentMode; ?>">
            </div>
            <div class="mb-3">
                <label>Paid By</label>
                <input type="text" class="form-control" name="paid_by" placeholder="Enter Name of Payer" autocomplete="off" value="<?php echo $paidBy; ?>">
            </div>
            <div class="mb-3">
                <label>Date Of Payment</label>
                <input type="text" class="form-control" name="payment_date" placeholder="Enter Date Of Payment" autocomplete="off" value="<?php echo $paymentDate; ?>">
            </div>
            <div class="mb-3">
                <label>Collected By</label>
                <input type="text" class="form-control" name="collected_by" placeholder="Enter Name" autocomplete="off" value="<?php echo $collectedBy; ?>">
            </div>
            <button type="submit" class="btn btn-primary mb-3" name="submit">Update</button>
        </form>
    </div>
  </body>
</html>