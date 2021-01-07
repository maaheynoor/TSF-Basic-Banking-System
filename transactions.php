<?php
include 'header.php';
?>
<div class="container">
    <h2>Transactions of the bank</h2>
    <div class="table-responsive-sm">
    <table class="table table-hover table-dark table-condensed table-bordered">
        <thead  class="thead-light text-center ">
            <tr>
                <th colspan=2>Sender</th>
                <th colspan=2>Receiver</th>
                <th rowspan=2>Amount Transferred</th>
                <th rowspan=2>Date and Time of transaction</th>
                <th rowspan=2>Status</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include 'db/config.php';
        $sql ="SELECT  t.sender,c1.name as sendername,t.receiver,c2.name as receivername,t.amount,t.datetime,t.status
        FROM transactions t
        JOIN customers c1 ON t.sender=c1.id
        JOIN customers c2 ON t.receiver=c2.id ";
        $query =mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($query))
        {
        ?>
            <tr>
            <td><?php echo $row['sender'];?></td>
            <td><?php echo $row['sendername'];?></td>
            <td><?php echo $row['receiver'];?></td>
            <td><?php echo $row['receivername'];?></td>
            <td><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $row['amount'];?></td>
            <td><?php echo date("d-m-Y H:i", strtotime($row['datetime']));?></td>
            <td class="text-white bg-<?php
            if($row['status']==1)
            {
                echo 'success';
            }
            else{
                echo 'danger';
            }
            ?>">
            <?php
            if($row['status']==1)
            {
                echo 'Successful';
            }
            else{
                echo 'Failed';
            }
            ?>
            </td>
            </tr>
        <?php }?>

        </tbody>
    </table>
</div>
</div>
<?php
include 'footer.php';
?>
