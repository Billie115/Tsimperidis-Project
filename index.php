<?php
include 'sub_sites/temporarydb.php';

ob_start();
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {
        $sql = "SELECT * FROM Login WHERE username=? AND password=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $user = $stmt->get_result();

        if ($user->num_rows === 1) {
            $_SESSION["username"] = $username;
            echo "<script>
           alert('Welcome back User !');
           </script>";
            header("Location: sub_sites/dashboard.php");
            exit();
        } else {
            $message = "Invalid username or password";
            echo "<script>alert('Invalid username or password!');</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginpage.css">
    <link href='https://cdn.boxicons.com/3.0.6/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<main>

    <body>
        <div class="wrapper">
            <form method="POST">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx  bx-user-square'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx  bx-lock-keyhole'></i>
                </div>
                <button class="btn" type="submit">Login</button>
            </form>
        </div>
    </body>
</main>

</html>