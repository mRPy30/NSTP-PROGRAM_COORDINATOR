<?php
include 'topbar.php';
include 'db_connect.php';
include 'sidebar.php';

// Start the session
session_start();

// Retrieve the selected course ID and name from session variables
$courseID = $_GET['courseID'];
$courseName = $_GET['courseName'];

// Fetch sections for the selected course from the database
$sql = "SELECT sectionID, sectionName FROM tbl_sections WHERE courseID = '$courseID'";
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
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }


        .upperbox .go-back-button {
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


        .section-box {
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
                <h4><?php echo $courseName; ?> Sections</h4>
                <a href="recordsStudent.php" class="go-back-button">Go Back</a>
            </div>

            <div class="middlebox">
                
            <?php
            // Check if there are any sections
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $sectionID = $row['sectionID'];
                    $sectionName = $row['sectionName'];
                    $encodedSectionName = urlencode($sectionName);

                    echo "<a href='sectionStudentDetails.php?sectionID=$sectionID&sectionName=$encodedSectionName'>";
                    echo "<div class='section-box'>";
                    echo "<p> $sectionName</p>";
                    echo "</div>";
                }
            } else {
                echo "No sections found for the selected course.";
            }
            ?>


                 
          
            </div>
        </div>
</body>
</html>
