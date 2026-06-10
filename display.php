<?php
include("connection.php");

$sql = "SELECT * FROM form";
$data = mysqli_query($conn, $sql);

$total = mysqli_num_rows($data);

if($total > 0)
{
    echo "<h2 align='center'>Manager Information</h2>";
    echo "<center><table border='3' cellspacing='7' cellpadding='7'>";

    echo "<tr>
            <th>Manager ID</th>
            <th>Name</th>
            <th>Father Name</th>
            <th>Date of Birth</th>
            <th>Photo</th>
            <th>Action</th>
          </tr>";

    while($result = mysqli_fetch_assoc($data))
    {
        echo "<tr>
                <td>".$result['mid']."</td>
                <td>".$result['name']."</td>
                <td>".$result['fname']."</td>
                <td>".$result['dob']."</td>
                <td><img src='uploads/".$result['photo']."' height='100' width='100'></td>
                <td>
                    <a href='update.php?mid=".$result['mid']."'>Edit</a> |
                    <a href='delete.php?mid=".$result['mid']."' onclick=\"return confirm('Are you sure?')\">Delete</a>
                </td>
              </tr>";
    }

    echo "</table></center>";
}
else
{
    echo "Table is empty";
}
?>
</table>
</center>