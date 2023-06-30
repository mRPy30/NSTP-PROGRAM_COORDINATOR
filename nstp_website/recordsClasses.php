

<?php

include 'topbar.php';
include 'db_connect.php';
include 'sidebar.php';


// Start the session
session_start();

// Include the necessary files
include 'db_connect.php';

// Fetch courses from the database
$sql = 'SELECT courseID, courseName FROM tbl_course';
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <style>
        .upperbox {
            border-bottom: solid black 1px;
            height: 50px;
            width: 100%;
            display: flex;
            margin-bottom: 20px;
        }

        .upperbox .go-back-button {
            margin-left: 900px;
            display: inline-block;
            padding: 10px 20px;
            height: 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
        }

        .upperbox .go-back-button:hover {
            background-color: #45a049;
        }

        .course-box {
            border: solid 1px black;
            margin: 10px;
            width: 250px;
            padding: 10px 20px;
            align-items: center;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .middlebox {
            padding: 5px;
            margin: 5px;
            width: 800px;
            height: 550px;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-content: flex-start;
            margin-left: 200px;
            padding-top: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="upperbox">
            <h4>COURSES RECORDS</h4>
            <a href="records.php" class="go-back-button">Go Back</a>
        </div>

        <div class="middlebox">
            <?php
            // Check if there are any courses
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $courseID = $row['courseID'];
                    $courseName = $row['courseName'];
                    $encodedCourseName = urlencode($courseName);

                    echo "<a href='courseClasses.php?courseID=$courseID&courseName=$encodedCourseName'>";
                    echo "<div class='course-box'>";
                    echo "<p>$courseName</p>";
                    echo "</div>";
                    echo "</a>";
                }
            } else {
                echo "No courses found.";
            }
            ?>
        </div>
    </div>
</body>
</html>
