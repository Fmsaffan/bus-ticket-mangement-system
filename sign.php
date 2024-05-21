<?php
    $servername = "localhost";
    $database = "busticket";
    $username = "root";
    $password = "";
    // create connection
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed : ". $conn->connect_error);
    }
    // Get use details from html file given name from signin form
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Validation for email and password if email or password is not null
    if (empty($email) || empty($password)) {
        echo "wrong";
    } else {
        // Check if email is already exists in register table
        $check_email = "SELECT email FROM register WHERE email = ? LIMIT 1";
        // Insert user data into register table
        $query = "INSERT INTO register (email, password) values (?,?)";
        // Execute $check_email query
        $cmd = $conn->prepare($check_email);
        $cmd->bind_param('s', $email);
        $cmd->execute();
        $cmd->bind_result($email);
        $cmd->store_result();
        $rnum = $cmd->num_rows;
        // Excecute $query when no rows found above given email
        if ($rnum == 0) {
            $cmd->close();
            $cmd = $conn->prepare($query);
            $cmd->bind_param('ss', $email, $password);
            $cmd->execute();
            header('Location: http://' . $_SERVER['HTTP_HOST'] . "/login.html");
        } else {
            echo "You entered gmail accound already registered";
        }
    }
    // Close connection
    $conn->close();
?>