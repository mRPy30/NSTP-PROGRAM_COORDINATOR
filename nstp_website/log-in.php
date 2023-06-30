<?php
// CONNECTION
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";
$conn = mysqli_connect($servername, $username, $password, $dbname);

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $username = $_POST['id'];
        $password = $_POST['password'];
        $Result = mysqli_query($conn, "SELECT id, password, 'instructor' as role FROM instructor WHERE id ='$username' AND password='$password'
		UNION
		SELECT id, password, 'student' as role FROM student WHERE id ='$username' AND password='$password'
		UNION
		SELECT id, password, 'admin' as role FROM coordinator WHERE id ='$username' AND password='$password'");

        if (!$Result) {
            // Query execution failed
            die("Query failed: " . mysqli_error($conn));
        }

        $matchedRows = mysqli_num_rows($Result);

        if ($matchedRows > 0) {
            $row = mysqli_fetch_assoc($Result);
            $id = $row['id'];
            $role = $row['role'];

            $_SESSION['name'] = $username;

            if ($role == 'admin') {
                Header("location: adminpage.php?id=$id");
                exit();
            } elseif ($role == 'student') {
                Header("location: studentpage.php?id=$id");
                exit();
            } elseif ($role == 'instructor') {
                Header("location: instructorpage.php?id=$id");
                exit();
            }
        } else {
            // No matching user found
            echo("no data matched");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Activity 4 : LOGIN PAGE!</title>
</head>
<body>
    <center>
        <div class="input">
            <br>
            <h1>LOG IN</h1>
            <br>
            <form method="POST">
                <label for="id">Enter your ID</label>
                <input type="text" name="id">
                <br><br>
                <label for="password">Password:</label>
                <input type="password" name="password">
                <br><br>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </center>
</body>
</html>
