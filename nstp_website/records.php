<!DOCTYPE html>
<html>
<head>
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
            flex-direction: column;
            justify-content: space-between;
        }

        .records_box {
            height: 75px;
            width: 300px;
            border: solid black 1px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            padding: 10px;
            margin: 10px;
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

        .upperbox { 
            border-bottom: solid black 1px;
            height: 50px;
            width: 100%;
            display: flex;
            margin-bottom: 20px;
        }

        .upperbox h4 {
            margin-left: 15px;
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
            <li><a href="adminpage.php">Home</a></li>
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
        <div class="upperbox">
            <h4> RECORDS </h4>
        </div>
        
        <div class="middlebox">
            <div class="records_box" id="courses_box">
                <h3> Courses Records</h3>
            </div>

            <div class="records_box" id="classes_box">
                <h3> Classes Records</h3>
            </div>

            <div class="records_box" id="students_box">
                <h3> Student Records</h3>
            </div> 

            <div class="records_box" id="instructor_box">
                <h3> Instructor Records</h3>
            </div> 

            <div class="records_box" id="financial_box">
                <h3> Financial Records</h3>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('courses_box').addEventListener('click', function() {
            window.location.href = 'recordsCourses.php';
        });
        
        document.getElementById('classes_box').addEventListener('click', function() {
            window.location.href = 'recordsClasses.php';
        });

        document.getElementById('students_box').addEventListener('click', function() {
            window.location.href = 'recordsStudent.php';
        });

        document.getElementById('instructor_box').addEventListener('click', function() {
            window.location.href = 'recordsInstructor.php';
        });

        document.getElementById('financial_box').addEventListener('click', function() {
            window.location.href = 'recordsFinances.php';
        });









        



    </script>
</body>
</html>
