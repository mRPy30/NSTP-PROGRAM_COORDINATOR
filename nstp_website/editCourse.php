<?php
include 'topbar.php';
include 'db_connect.php';
include 'sidebar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['courseName'], $_POST['courseID'])) {
        $courseName = $_POST['courseName'];
        $courseID = $_POST['courseID'];
        
        // Update the course in the database
        $updateQuery = "UPDATE tbl_course SET courseName = '$courseName' WHERE courseID = '$courseID'";
        $conn->query($updateQuery);
        
        // Redirect back to the page to refresh the course table
        header('Location: recordsCourses.php');
        exit();
    }
}

if (isset($_GET['courseID'])) {
    $courseID = $_GET['courseID'];
    
    // Fetch the course details from the database
    $sql = "SELECT courseID, courseName FROM tbl_course WHERE courseID = '$courseID'";
    $result = $conn->query($sql);

   
    if ($result->num_rows == 1) {
        $course = $result->fetch_assoc();
    } else {
        // Course not found, handle the error accordingly
    }
} else {
    // Handle the case when courseID is not provided in the query parameters
}
?>
