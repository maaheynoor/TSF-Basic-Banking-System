<?php
include 'header.php';
?>
<div class="container-fluid">
<div class="row">

    <div class="col-lg-6 order-lg-1 order-2">
        <h1>Simple Basic Banking System</h1>
        <div class="row ">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card h-100">
                <img src="images/customers.png" width="100%">
                <div class="card-body">
                    <a href="customers.php">Our Customers</a>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
            <div class="card h-100">
                <img src="images/transfer.png" width="100%">
                <div class="card-body">
                    <a href="transfermoney.php">Transfer Money</a> in quick easy steps
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <img src="images/t_history.png" width="100%">
                <div class="card-body">
                    View all <a href="transactions.php">Transactions</a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 order-lg-2 order-1">
    <img src="images/home.png" width="100%">
    </div>
</div>
</div>
<?php
include 'footer.php';
?>
