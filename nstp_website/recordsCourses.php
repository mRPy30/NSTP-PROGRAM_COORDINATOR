<?php
include 'topbar.php';
include 'db_connect.php';
include 'sidebar.php';

// Fetch courses from the database
$sql = 'SELECT courseID, courseName FROM tbl_course';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $courses = $result->fetch_all(MYSQLI_ASSOC);

    // Set the session courseID based on the first course in the array
    session_start();
    $_SESSION['courseID'] = $courses[0]['courseID'];
} else {
    $courses = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- CSS styles -->
    <style>
        /* CSS styles for the course table */
        #course-table {
            width: 500px;
            border-collapse: collapse;
            border: 1px solid black;
            margin: 10px;
        }

        #course-table th, #course-table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        #course-table th {
            text-align: left;
            background-color: #f2f2f2;
        }

        #course-table tbody tr:hover {
            background-color: #f5f5f5;
        }

        #course-table .edit-button, #course-table .delete-button {
            padding: 6px 10px;
            border: none;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        #course-table .edit-button {
            background-color: #2196F3;
            border-radius: 4px;
        }

        #course-table .delete-button {
            background-color: #f44336;
            border-radius: 4px;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
        }

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

        .form-container {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            height: 200px;
        }

        .form-container h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
        }

        .form-container input[type="text"] {
            width: 250px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-container button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .form-container button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Style for the pop-up form */
        .form-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            padding: 20px;
            z-index: 9999;
        }

        /* Additional styling for the form container */
        .form-container {
            text-align: center;
        }

        /* Show the pop-up form */
        .show {
            display: block;
        }

        .formbox {
            display: flex;
            justify-content: space-evenly;
            width: 100%;
            max-width: 800px;
        }

        .tabledisplay {
            width: 500px;
        }
        </style>
</head>
<body>

  
    <div class="content">
         <!-------------------------------------- UPPER PART NG PAGE --------------------------------------------->
        <div class="upperbox">
                <h4>COURSES RECORDS</h4>
                <a href="records.php" class="go-back-button">Go Back</a>
        </div>

        <!-- Add New Course Form -->
        <div class="formbox">
            <div class="form-container">
                <h4>Add New Course</h4>
                <form method="post" id="add-course-form" action="manageCourses.php">
                    <label for="courseName">Course Name:</label>
                    <input type="text" id="courseName" name="courseName" required>
                    <br>
                    <br>
                    <button type="submit">Add Course</button>
                </form>
            </div>

          <!--------------------------------------TABLE NG CLASSES --------------------------------------------->
        <!-- Render the course table -->
        <div class="tabledisplay">
            <table id="course-table">
                <!-- Table header -->
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody>
                        <?php if (!empty($courses)): ?>
                            <?php foreach ($courses as $course): ?>
                                <tr>
                                    <td><?php echo $course['courseName']; ?></td>
                                    <td>
                                        <button onclick="openForm('<?php echo $course['courseID']; ?>')" class="edit-button">Edit</button>
                                    </td>
                                    <td>
                                    <button class="delete-button" onclick="deleteCourse(<?php echo $course['courseID']; ?>)">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="3">No courses found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!----------------- POP UP FORM PARA SA PAG EDIT NG COURSE -------------->


        <div id="edit-course-popup" class="form-popup">
            <form method="post" class="form-container" id="edit-course-form" action="manageCourses.php">
                <h4>Edit Course</h4>
                <input type="hidden" name="courseID" id="edit-courseID">
                <label for="edit-courseName">Course Name:</label>
                <input type="text" id="edit-courseName" name="courseName" required>
                <br>
                <br>
                <button type="submit">Update Course</button>
            </form>
        </div>
    
            
    <!----------------- POP UP FORM PARA SA PAG DELETE NG COURSE -------------->

        <form id="deleteCourseForm" action="manageCourses.php" method="post">
            <input type="hidden" name="courseID" id="courseIDInput">
            <input type="hidden" name="deleteCourse" value="1">
        </form>









      <!---------------------------------     JAVASCRIPT CODE ------------------------------------------>    

    <script>

        // ---------------- JS PARA BUMUKAS YUNG POP UP FORM PARA SA PAG EDIT ---------------- //

        // Open the pop-up form and set the course details
        function openForm(courseID) {
            var course = <?php echo json_encode($courses); ?>;
            var courseDetails = course.find(c => c.courseID === courseID);

            if (courseDetails) {
                document.getElementById("edit-courseID").value = courseDetails.courseID;
                document.getElementById("edit-courseName").value = courseDetails.courseName;
                document.getElementById("edit-course-popup").classList.add("show");
            }
        }

        // Close the pop-up form
        function closeForm() {
            document.getElementById("edit-course-popup").classList.remove("show");
        }


          //--------------------------- DELETE CONFIRMATION PROMPT ------------------------------//
    
        function deleteCourse(courseID) {
                if (confirm("Are you sure you want to delete this course?")) {
                    document.getElementById('courseIDInput').value = courseID;
                    document.getElementById('deleteCourseForm').submit();
                }
            }




    </script>



</body>
</html>