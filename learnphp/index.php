<?php
    require_once("./config.php");

    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if(mysqli_connect_errno()){
        die("Connection to database fail!");
    }
    // echo "Connection success";

    //Insert new record into table user
    $username = "i5gic";
    $password = crypt("123456", KEY_SALT);
    $fullname = "I5GIC";

    $sql = "insert into users (username, password, full_name) 
                values ('$username', '$password', '$fullname')";
    $result = mysqli_query($con, $sql);

    if($result){
        echo "New record is inserted into database";
    }else{
        echo "Fail to create new record ".mysqli_errno();
    }

    //Selecting record from database
    $username = "i5gic";
    $password = "123456";
    $encryptedPassword = crypt($password, KEY_SALT);

    $selectSql = "select * from users where username='$username' and password = '$encryptedPassword'";

    $result = mysqli_query($con, $selectSql);
    if(count($result) > 0){
        while ($row = mysqli_fetch_object($result)) {
            echo "<p>User: $row->username, Fullname: $row->full_name</p>";
        }
    }else{
        echo "No record found";
    }

    mysqli_close($con);
?>