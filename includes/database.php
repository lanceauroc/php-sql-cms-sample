<?php 

// The following parameters are taken by mysqli_connect("localhost","my_user","my_password","my_db")
$connect = mysqli_connect('localhost', 'php-sql-cms-sample', 'phpsqlcmssample', 'php-sql-cms-sample');

if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}else{
    echo "connection success <br>";
}
?>