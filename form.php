<?php include("includes/connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <title>Manager Registration Form</title>
</head>
<body>

<div class="container">

    <form id="managerForm" action="" method="POST" enctype="multipart/form-data">

        <div class="tittle">
            Manager Registration Form
        </div>

        <div class="form">

            <div class="input_field">
                <label>Manager ID</label>
                <input type="text" name="manager_id" id="manager_id" class="input" required>
            </div>

            <div class="input_field">
                <label>Name</label>
                <input type="text" name="name" id="name" class="input" required>
            </div>

            <div class="input_field">
                <label>Father Name</label>
                <input type="text" name="father_name" id="father_name" class="input" required>
            </div>

            <div class="input_field">
                <label>Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="input" required>
            </div>

            <div class="input_field">
                <label>Photo</label>
                <input type="file" name="photo" id="photo" class="input" required>
            </div>

            <div class="input_field">
                <input type="submit" value="Register" class="btn" name="register">
            </div>

        </div>

    </form>

</div>

<?php

if(isset($_POST['register']))
{
    $manager_id = $_POST['manager_id'];
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $date_of_birth = $_POST['date_of_birth'];

    $photo = $_FILES['photo']['name'];
    $temp_name = $_FILES['photo']['tmp_name'];

    move_uploaded_file($temp_name, "uploads/".$photo);

    $sql = "INSERT INTO form
            (mid,name,fname,dob,photo)
            VALUES
            ('$manager_id',
             '$name',
             '$father_name',
             '$date_of_birth',
             '$photo')";

    $data = mysqli_query($conn,$sql);

    if($data)
    {
        echo "<script>alert('Data Inserted Successfully');</script>";
    }
    else
    {
        echo mysqli_error($conn);
    }
}

?>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function(){

    $("#managerForm").submit(function(){

        $(".error").remove();

        let valid = true;

        let mid = $("#manager_id").val().trim();
        let name = $("#name").val().trim();
        let fname = $("#father_name").val().trim();

        // Manager ID Validation
        if(mid == "")
        {
            $("#manager_id").after("<span class='error'>Manager ID Required</span>");
            valid = false;
        }
        else if(!/^[0-9]+$/.test(mid))
        {
            $("#manager_id").after("<span class='error'>Only Numbers Allowed</span>");
            valid = false;
        }

        // Name Validation
        if(name == "")
        {
            $("#name").after("<span class='error'>Name Required</span>");
            valid = false;
        }
        else if(!/^[A-Za-z ]+$/.test(name))
        {
            $("#name").after("<span class='error'>Only Alphabets Allowed</span>");
            valid = false;
        }

        // Father Name Validation
        if(fname == "")
        {
            $("#father_name").after("<span class='error'>Father Name Required</span>");
            valid = false;
        }
        else if(!/^[A-Za-z ]+$/.test(fname))
        {
            $("#father_name").after("<span class='error'>Only Alphabets Allowed</span>");
            valid = false;
        }

        return valid;
    });

});
</script>

</body>
</html>