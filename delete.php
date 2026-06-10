<?php

include("includes/connection.php");

$id = $_GET['mid'];

$query = "DELETE FROM form WHERE mid='$id'";

$data = mysqli_query($conn,$query);

if($data)
{
    echo "Record Deleted Successfully";
    ?>
    <meta http-equiv="refresh" content="1;url=display.php">
    <?php
}
else
{
    echo mysqli_error($conn);
}

?>