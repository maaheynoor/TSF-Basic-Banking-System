<?php 
include 'header.php';
?>


<?php
 $cust_id=$_GET['id'];
 include 'db/config.php';
$sql ="select * from customers where id=$cust_id";
$query =mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($query);
$senderbalance=$row['balance'];
?>

<div class="container card text-center mt-5" style="width: 40rem;">
  <div class="card-body">
    <h3 class="card-title"><?php echo $row['name'];?></h3>
    <p class="card-text"><?php echo $row['email'];?></p>
    <ul class="list-group list-group-flush">
    <li class="list-group-item"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $senderbalance;?></li>
    <li class="list-group-item"><button class="btn btn-primary" onclick="displaycust()">Transfer</button></li>
  </ul>
  </div>
</div>

<form method="post">
    <div class="container card text-center mt-5" style="width: 30rem;display:none" id="transferForm">
    <div class="card-body">
        <label>Transfer to:</label>  
        <select name="receiver" required>
            <option value="">Select receiver</option>
            <?php
            include 'db/config.php';
            $sql ="select * from customers";
            $query =mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($query))
            {
                if ($row['id']!=$cust_id)
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';      
            }
            ?>
        </select>      
        <br>
        <label>Amount</label>
        <input name="amount" type="number" min="0" required>
        <br>
        <button type="submit" name="transfer" class="btn btn-success">Confirm Transfer</button>
    </div>
    </div>
</form>

<?php 
include 'footer.php';
?>

<?php
if(isset($_POST["transfer"]))
{
    $receiver=$_POST["receiver"];
    $amount=$_POST["amount"];
    $sql ="select balance from customers where id=$receiver";
    $query =mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($query);
    $receiverbalance=$row['balance'];
    if ($senderbalance>=$amount && $amount>=0)
    {
        $status=true; //sucessful
        $updateAmount="UPDATE customers SET balance=$senderbalance-$amount WHERE id=$cust_id";
        $result=mysqli_query($con,$updateAmount);

        $updateAmount="UPDATE customers SET balance=$receiverbalance+$amount WHERE id=$receiver";
        $result=mysqli_query($con,$updateAmount);
    }
    else
    {
        $status=false; //failed
    }
    if($amount>=0)
    {
        $query="INSERT INTO transactions (`sender`, `receiver`, `amount`, `status`) VALUES('$cust_id','$receiver','$amount','$status')";
        $result=mysqli_query($con,$query);
        if($result)
        {
            if($status==true)
            echo '<div id="alert" class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Amount <i class="fa fa-inr" aria-hidden="true"> <strong>'.$amount.'</strong> transferred successfully
            </div>';
            else
            echo '<div id="alert" class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Amount <i class="fa fa-inr" aria-hidden="true"> <strong>'.$amount.'</strong> cannot be transferred due to insufficient balance.
            </div>';
        }
        else
        {
            echo '<div id="alert" class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Transaction failed!
            </div>';
        }
    }
    else{
        echo '<div id="alert" class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Amount is negative!
            </div>';
    }
    // header('location:transfer.php?id='.$cust_id);
}
?>