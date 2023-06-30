<?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "login_system";
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      $accountID = $_GET['id'];


      // query for the name of the instructor
      $query = "SELECT instructorName FROM instructor WHERE id = '$accountID'";
      $result = mysqli_query($conn, $query);

      if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $instructorName = $row['instructorName'];
      } else {
          // Handle the case if the instructor is not found
          $instructorName = "Unknown";
      }

    
      
      // query for the instructor handled course
      $query = "SELECT tbl_course.courseName FROM instructor
                LEFT JOIN tbl_course ON instructor.courseID = tbl_course.courseID
                WHERE instructor.id = '$accountID'";
      $result = mysqli_query($conn, $query);
      if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $instructorCourse = $row['courseName'];
      } else {
          // Handle the case if the instructor is not found
          $instructorCourse = "Unknown";
      }

      ?>




<!DOCTYPE html>
<html lang="en">
<head>



    

                        <?php echo" Instructor Name: $instructorName"?>
                        <h1>NSTP- <?php echo"$instructorCourse"?> </h1>
                        
</body>
</html>