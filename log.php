<?php
    // Connection property
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "busticket";
    // Create connection
    $conn = new mysqli($server, $username, $password, $database);
    // Check connection error status
    if ($conn->connect_error){
        die("Error : " . $conn->connect_error);
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "SELECT * FROM register WHERE email = '$email' AND password = '$password'";
        $exists = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($exists);
        if ($rows == 1) {
            header('Location:http://' . $_SERVER['HTTP_HOST'] . '/form.php', true, 303);
        } else {
            echo "wrong";
        }
    }
    $conn->close();
?>