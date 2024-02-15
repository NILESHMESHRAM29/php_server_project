<?php
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'test');
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO register(firstName, lastName, gender, email, password, number) VALUES (?, ?, ?, ?, ?, ?)");

        // Check for errors in the prepare step
        if ($stmt === false) {
            die('Error in SQL query: ' . $conn->error);
        }

        $stmt->bind_param("ssssss", $firstName, $lastName, $gender, $email, $password, $number);
        $execval = $stmt->execute();

        // Check for errors in the execute step
        if ($execval === false) {
            die('Error executing statement: ' . $stmt->error);
        }

        echo $execval;
        echo "Registration successfully...";
        $stmt->close();
        $conn->close();
    }
?>
