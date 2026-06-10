<?php
include('connection.php');

$mid = $_GET['mid'];

$sql = "SELECT * FROM form WHERE mid='$mid'";
$data = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"href="style.css">
    <title>Registration Form</title>
</head>
<body>
    <div class ="container">
        <form action="#" method="POST" enctype="multipart/form-data">
        <div class="tittle">
            Manager Updation Form
         </div>
         <div class="form">
            <div class="input_field">
                <label>Manager ID</label>
                <input type="text" value="<?php echo $result['mid']; ?>" name="manager_id" class="input" required>
            </div>

            <div class="input_field">
                <label>Name</label>
                <input type="text" value="<?php echo $result['name']; ?>" name="name" class="input" required>
            </div>

            <div class="input_field">
                <label>Father Name</label>
                <input type="text" value="<?php echo $result['fname']; ?>" name="father_name" class="input" required>
            </div>

            <div class="input_field">
                <label>Date of Birth</label>
                <input type="date" value="<?php echo $result['dob']; ?>" name="date_of_birth" class="input" required>
            </div>

            <div class="input_field">
                <label>Photo</label>
                <input type="file" name="photo" class="input" >
            </div>
            <div class="input_field">
                <input type="submit" value="Update" class="btn" name="update">
            </div>  
         </div>
     </form>
    </div>    
</body>
</html>

<?php

if(isset($_POST['update']))
{
    $manager_id = $_POST['manager_id'];
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $date_of_birth = $_POST['date_of_birth'];

    $photo = $_FILES['photo']['name'];

    if($photo != "")
    {
        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            "uploads/".$photo
        );

        $query = "UPDATE form SET
                  mid='$manager_id',
                  name='$name',
                  fname='$father_name',
                  dob='$date_of_birth',
                  photo='$photo'
                  WHERE mid='$mid'";
    }
    else
    {
        $query = "UPDATE form SET
                  mid='$manager_id',
                  name='$name',
                  fname='$father_name',
                  dob='$date_of_birth'
                  WHERE mid='$mid'";
    }

    $data = mysqli_query($conn,$query);

    if($data)
    {
        echo "Record Updated Successfully";
        <meta http-equiv="refresh" content="1;url=http://localhost/DMRF/display.php">
        <?php

    }
    else
    {
        echo mysqli_error($conn);
    }
}

?>