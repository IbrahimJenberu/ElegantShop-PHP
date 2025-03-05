

<?php


include "connect.php";

$sql="CREATE TABLE admin(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,	
    username VARCHAR(30) NOT NULL UNIQUE,	
    password VARCHAR(30) NOT NULL)";

    if(mysqli_query($con,$sql)){

        echo "table admin created sucessfully";
    }

    $sql1="CREATE TABLE customer(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(60) NOT NULL,
        username VARCHAR(30) NOT NULL UNIQUE,
        password VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL ,
        phone VARCHAR(30) NOT NULL,
        address VARCHAR(30) NOT NULL  
        )";

if(!mysqli_query($con,$sql1)){

    echo "table customer NOT created sucessfully";
}
else
{
    echo "table customer created";
}




$sql2="CREATE TABLE product(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    productName VARCHAR(30) NOT NULL,
    price VARCHAR(30) NOT NULL,
    image VARCHAR(30) NOT NULL
    )";

if(!mysqli_query($con,$sql2)){

    echo "table product NOT created sucessfully";
}
else
{
    echo "table product created";
}



  $sql3="CREATE TABLE history(
    id INT(6),
    username VARCHAR(50),
    full_name VARCHAR(60) NOT NULL,
    phone VARCHAR(30) NOT NULL, 
    address VARCHAR(30) NOT NULL,  
    productName VARCHAR(30) NOT NULL,
    quantity VARCHAR(10),
    price VARCHAR(30) NOT NULL,
    product_size VARCHAR(30) NOT NULL
    )";

if(!mysqli_query($con,$sql3)){

    echo "table history NOT created sucessfully";
}
else
{
    echo "table history created";
}



$sql4="CREATE TABLE history2(
    id INT(6),
    username VARCHAR(50),
    full_name VARCHAR(60) NOT NULL,
    phone VARCHAR(30) NOT NULL, 
    address VARCHAR(30) NOT NULL,  
    productName VARCHAR(30) NOT NULL,
    quantity VARCHAR(10),
    price VARCHAR(30) NOT NULL,
    product_size VARCHAR(30) NOT NULL
    )";

if(!mysqli_query($con,$sql4)){

    echo "table history2 NOT created sucessfully";
}
else
{
    echo "table history2 created";
}



$sql3="CREATE TABLE feedback(
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(50),
     email VARCHAR(50),
    message VARCHAR(1000)
    
    )";

if(!mysqli_query($con,$sql3)){

    echo "table feedback NOT created sucessfully";
}
else
{
    echo "table feedback created";
}
    


?>
