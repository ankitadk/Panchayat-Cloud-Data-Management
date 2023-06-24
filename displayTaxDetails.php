<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tax Details</title>
</head>
<body>
    <div class="container my-5 border">
        <button class="btn btn-primary my-5"><a href="addTaxDetails.php" class="text-light">Add Tax Details</a></button>

        <table class="table">
        <thead>
            <tr>
            <th scope="col">Sr. No.</th>
            <th scope="col">Name of Tax Payer</th>
            <th scope="col">Ward Name</th>
            <th scope="col">House Number</th>
            <th scope="col">Areears Tax (B/F From Previous Year)</th>
            <th scope="col">Years Demand  F.Y. 2023-2024</th>
            <th scope="col">Total Tax Payable F.Y. 2023-2024</th>
            <th scope="col">Amount Paid  Receipt & Date</th>
            <th scope="col">Fine/Penalty @10%</th>
            <th scope="col">Total Tax Payable Including Penalty</th>
            <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>

            <?php
                $sql = "select td.id, CONCAT_WS('', u.first_name, u.middle_name, u.last_name) AS cust_name, td.ward_name, td.house_no, td.arrears, td.fine_amount, td.tax_amount, td.total_tax, td.total_payable_tax, td.amount_paid, td.date_of_payment from tax_details AS td INNER JOIN users AS u ON td.customer_id = u.id where td.status = 1";
                $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                $i = 1;
                if(mysqli_num_rows($res) > 0) {
                    while($data = mysqli_fetch_assoc($res))
                    {
                        // print_r($data);
                        echo '<tr><th scope="row">'.$i.'</th>
                        <td>'.$data['cust_name'].'</td>
                        <td>'.$data['ward_name'].'</td>
                        <td>'.$data['house_no'].'</td>
                        <td>'.$data['arrears'].'</td>
                        <td>'.$data['tax_amount'].'</td>
                        <td>'.$data['total_tax'].'</td>
                        <td>'.$data['amount_paid'].' ['.$data['date_of_payment'].']</td>
                        <td>'.$data['fine_amount'].'</td>
                        <td>'.$data['total_payable_tax'].'</td>
                        <td>
                        <button class="btn btn-primary"><a href="updateTaxDetails.php?tax_details_id='.$data['id'].'" class="text-light">Update</a></button>
                        <button class="btn btn-danger"><a href="deleteTaxDetails.php?tax_details_id='.$data['id'].'" class="text-light">Delete</a></button>
                        </td>
                        </tr>';

                        $i++;                 
                    }
                }
                die;
            ?>

            
        </tbody>
        </table>
    </div>    
</body>
</html>