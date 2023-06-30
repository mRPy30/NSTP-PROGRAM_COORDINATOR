<?php
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "login_system");

    // Count query for student
    $query = "SELECT COUNT(id) AS total_students FROM student";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalStudents = $row['total_students'];
    
    // Count query for COURSE
    $query = "SELECT COUNT(courseID) AS total_courses FROM tbl_course";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalCourse = $row['total_courses'];
   
    $query = "SELECT COUNT(id) AS total_instructors FROM instructor";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalInstructors = $row['total_instructors'];
   


?>


<!DOCTYPE html>
<html>
<head>
    <title>Topbar with Sidebar</title>
    <style>
        /* CSS for topbar */
        .topbar {
            background-color: #6FBB76;
            color: #fff;
            padding: 20px;
        }

        .topbar .logout {
            float: right;
            color: #fff;
            text-decoration: none;
        }

        /* CSS for sidebar */
        .sidebar {
            background-color: #f1f1f1;
            float: left;
            width: 200px;
            height: 100vh;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px;
            background-color: #ddd;
            cursor: pointer;
        }

        .sidebar ul li:hover {
            background-color: #ccc;
        }

        /* CSS for content */
        .content {
            margin-left: 200px; /* Adjust this value to match the width of the sidebar */
            padding: 20px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            
        }

        .total_stud_box {
  height: 75px;
  width: 300px;
  border: solid black 1px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-end;
  padding: 10px; /* Add 'px' unit to the padding value */
  margin: 10px; /* Add 'px' unit to the margin value */
  border-radius: 12px;
  margin-top: 0;
}

h1 {
  margin: 0; /* Reset the margin for the h1 element */
  margin-left: 50px;
}

p {
  font-size: 20px;
  color: black;
  margin: 0; /* Reset the margin for the p element */
  margin-bottom: 10px;
}

        
    </style>
</head>
<body>
    <!-- Topbar -->
    <div class="topbar">
        <a class="logout" href="log-in.php">Logout</a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="records.php">Records</a></li>
            <li><a href="schedule.php">Schedule</a></li>
            <li><a href="programs.php">Programs</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li><a href="compliance.php">Compliance</a></li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="content">
        <!-- Add your main content here -->
   
       

        <div class='total_stud_box'>
            <h1><?php echo $totalStudents; ?></h1>
            <p>Total NSTP Students</p>
        </div>

        <div class='total_stud_box'>
            <h1><?php echo $totalCourse; ?></h1>
            <p>NSTP Program Courses</p>
        </div>

        <div class='total_stud_box'>
            <h1><?php echo $totalInstructors; ?></h1>
            <p>Instructors</p>
        </div>
    </div>





</body>
</html>