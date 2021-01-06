<?php 
include 'header.php';
?>

<div class="container">
    <h2>List of Customers</h2>
    <div class="table-responsive-sm">
    <table class="table table-hover table-condensed table-dark table-bordered">
        <thead class="thead-light text-center ">
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Current Balance</th>
                <?php
                if(isset($transfer))
                echo '<th></th>';
                ?>
            </tr>
        </thead>
        <tbody>
        <?php 
        include 'db/config.php';
        $sql ="select * from customers";
        $query =mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($query))
        {
        ?>
            <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $row['balance'];?></td>
            
            <?php
            if(isset($transfer))
            echo '<td><a class="btn btn-primary" href="transfer.php?id='. $row['id'].'">Transact</a></td>';
            ?>
            
            </tr>
        <?php }?>

        </tbody>
    </table>

</div>

<?php 
include 'footer.php';
?>