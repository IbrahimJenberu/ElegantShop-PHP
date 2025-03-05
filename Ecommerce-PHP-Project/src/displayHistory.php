

<?php

include "connect.php";


if(!(isset($_SESSION["username"])&&(($_SESSION["role"]=="admin")))){

    header("Location: login_page.php"); 

 }



$sql1="SELECT * FROM history2";
$result=mysqli_query($con,$sql1);

if(mysqli_num_rows($result)>0){


        echo "<table style='margin:20px auto;width:70%;text-align:center' border='1' cellpadding='10' cellspacing='0'>
        <tr><th>prod_id</th><th>username</th><th>full_name</th><th>phone</th><th>address</th><th>productName</th><th>quantity</th><th>price</th><th>product_size</th></tr>";
    while ($row=mysqli_fetch_assoc($result)){
       
        echo "<tr><td>$row[id]</td>
        <td>$row[username]</td>
        <td>$row[full_name]</td>
        <td>$row[phone]</td>
        <td>$row[address]</td>
        <td>$row[productName]</td>
        <td>$row[quantity]</td>
        <td>$row[price]</td>
        <td>$row[product_size]</td>
        </tr>";

    }
    echo "</table>";
       
}

?>
