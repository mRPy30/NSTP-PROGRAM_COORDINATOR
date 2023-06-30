<?php
include 'topbar.php';
include 'db_connect.php';
include 'sidebar.php';

session_start();

$selectedCourseID = "";
$selectedCourseName = "";

if (isset($_GET['courseID']) && isset($_GET['courseName'])) {
    $selectedCourseID = $_GET['courseID'];
    $selectedCourseName = $_GET['courseName'];

    $_SESSION['selectedCourseID'] = $selectedCourseID;
    $_SESSION['selectedCourseName'] = $selectedCourseName;
} elseif (isset($_SESSION['selectedCourseID']) && isset($_SESSION['selectedCourseName'])) {
    $selectedCourseID = $_SESSION['selectedCourseID'];
    $selectedCourseName = $_SESSION['selectedCourseName'];
}


$query = "SELECT sectionName FROM tbl_sections WHERE courseID = $selectedCourseID";
$sectionResult = mysqli_query($conn, $query);

$sections = array(); // Initialize an empty array to store sections

if ($sectionResult && mysqli_num_rows($sectionResult) > 0) {
    while ($section = mysqli_fetch_assoc($sectionResult)) {
        $sections[] = $section; 
    }
}

$query = "SELECT instructor.instructorImage, instructor.instructorName, instructor.id, tbl_sections.sectionName
            FROM instructor
            INNER JOIN tbl_course ON instructor.courseID = tbl_course.courseID
            INNER JOIN tbl_sections ON instructor.sectionID = tbl_sections.sectionID
            WHERE instructor.courseID = $selectedCourseID;";

$result = mysqli_query($conn, $query);

$instructors = array(); // Initialize an empty array to store instructor details

if ($result && mysqli_num_rows($result) > 0) {
    while ($instructor = mysqli_fetch_assoc($result)) {
        // Retrieve the individual values
        $instructorImage = $instructor['instructorImage'];
        $instructorName = $instructor['instructorName'];
        $sectionName = $instructor['sectionName'];
        $instructorID = $instructor['id'];

        // Store the instructor details in the array
        $instructors[] = array(
            'instructorImage' => $instructorImage,
            'instructorName' => $instructorName,
            'sectionName' => $sectionName,
            'instructorID' => $instructorID
        );
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
         /* CSS styles for the table display */
         .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
            position
            
        }
        #course-table {
            width: 500px;
            margin: 10px;
            
        }
        
        #course-table th, #course-table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        
        #course-table th {
            text-align: left;
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
            border-radius:4px;
        }
        
        #course-table .delete-button {
            background-color: #f44336;
            border-radius:4px;
        }

        .upperbox {
            border-bottom: solid black 1px;
            height: 50px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .searchbox {
            display: flex;
            align-items: center;
            margin-left: auto; /* Adjust the margin as needed */
            margin-right: 20px; /* Adjust the margin as needed */
            
        }

        .searchbox input[type="text"] {
            width: 300px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            height: 25px;
        }

        .print button {
            background-color: white;
            border: 1px solid black;
            border-radius: 3px;
            padding: 5px 10px;
            color: black;
            cursor: pointer;
            height: 38px;
            margin-right: 15px;
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

        .tabledisplay {
            width: 800px;
            border: solid black 1px;
            display: flex;
            justify-content: center;
            overflow: hidden;
            flex-direction: column;
            padding: 10px;

        }

        #instructor-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        #instructor-table th,
        #instructor-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        #instructor-table th {
            background-color: #f2f2f2;
        }

        .edit-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            border-radius: 3px;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            border-radius: 3px;
        }

       
        .lowerbox {
            width: 120px;
            margin-top: 500px; /* Adjust the margin-top value as needed */
            position: sticky;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 999;
        }
        /* CSS styles for the popup form */
        
        #addForm {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }

        .form-container {
            width: 300px;
        }

        .form-container h4 {
            margin-top: 0;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
        }

        .form-container input[type="text"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        .form-container button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            border-radius: 3px;
        }

       
        @media print {
            .upperbox,
            .lowerbox,
            .searchbox
            .sidebar{
                display: none;
            }
        }

        .course{
            padding: 5px;
            margin: 5px;
        }

        .image-container {
        width: 100px;
        height: 100px;
        border: 1px solid black;
        border-radius: 50%;
        overflow: hidden;
        }

        .image-container img {
        width: 100%;
        height: 100%;
        object-fit: fill    ;
        }


        .form-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }

        /* Style for the form container */
        .form-container {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            max-width: 500px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        /* Style for the close button */
        .form-container .cancel {
        color: #aaa;
        float: right;
        font-size: 14px;
        font-weight: bold;
        border: none;
        }

        /* Style for the close button on hover */
        .form-container .cancel:hover {
        color: black;
        cursor: pointer;
        }

        /* Style for the Add button */
        .add-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border: none;
        cursor: pointer;
        }

        /* Style for the Add button on hover */
        .add-button:hover {
        opacity: 0.8;
        }

        .form-popup select {
        width: 275px;
        border: 1px solid black;
        font-size: 14px;
        border-radius: 5px;
        padding: 12px;
        display: block;
    }
</style>
</head>

<body>
    <div class="content print-container">

        <div class="upperbox">

            <h3><?php echo $selectedCourseName; ?></h3>
            
            <div class="searchbox">
            <input  type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search section names...">
            </div>

            <div class="print">
            <button onclick="window.print()"> Print</button>
            </div>

            <a href="recordsInstructor.php" class="go-back-button">Go Back</a>

     
        </div>
    
        <div class="tabledisplay">

            <div class="course">
                <p><?php echo $selectedCourseName . ' Instructors' ; ?></p>
            </div>

            <?php if (!empty($instructors)): ?>
            <table id="instructor-table">
                <thead>
                    <tr>
                        <th>Instructor Image</th>
                        <th>Instructor ID</th>
                        <th>Instructor</th>
                        <th>Class Handled</th>
                        <th>Modify</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($instructors as $instructor): ?>
                        <tr>
                
                        <td>
                            <div class="image-container">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($instructor['instructorImage']); ?>" alt="Instructor Image">
                            </div>
                        </td>
                            <td><?php echo $instructor['instructorID']; ?></td>
                            <td><?php echo $instructor['instructorName']; ?></td>
                            <td><?php echo $instructor['sectionName']; ?></td>
                            <td>

                            <button class="edit-button" onclick="openEditForm(<?php echo $instructor['instructorID']; ?>)" instructorID="<?php echo $instructor['instructorID']; ?>">Edit</button>

                            <button class="delete-button" onclick="deleteInstructor(<?php echo $instructor['instructorID']; ?>)">Delete</button>
                                
                        </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No instructors found with the provided course ID.</p>
        <?php endif; ?>
        </div>

        <div class="lowerbox">
        <button class="add-button" id="addInstructorButton">Add Instructor</button>
        </div>
    </div>
    
    <!--pop up form for editting the instructor details-->

        <!-- Add instructor form (hidden by default) -->
        <div id="addForm" class="form-popup">
            <form action="manageInstructor.php" method="POST" class="form-container" enctype="multipart/form-data">
                <h2>Add Instructor</h2>

                
                <label for="instructorImage"><b>Instructor Image</b></label>
                <input type="file" name="instructorImage" accept="image/*" required>

                <label for="instructorID"><b>Instructor ID</b></label>
                <input type="text" placeholder="Enter Instructor ID" name="instructorID" required>

                <label for="instructorName"><b>Instructor Name</b></label>
                <input type="text" placeholder="Enter Instructor Name" name="instructorName" required>

                <label for="sectionName"><b>Section Name</b></label>
                    <select name="sectionName" required>
                    <?php foreach ($sections as $section): ?>
                        <option value="<?php echo $section['sectionName']; ?>"><?php echo $section['sectionName']; ?></option>
                    <?php endforeach; ?>
                    </select>

                <label for="password"><b>Password</b></label>
                <input type="text" placeholder="Enter password" name="password" required>
                
                <br> <br>

                <button type="submit" class="btn" onclick="closeAddForm()">Add</button>
                <button type="button" class="btn cancel" onclick="closeAddForm()">Cancel</button>
         </form>
    </div>


<!-- Edit instructor form (hidden by default) -->
<div id="editForm" class="form-popup">
  <form action="manageInstructor.php" method="POST" class="form-container" enctype="multipart/form-data">
    <h2>Edit Instructor</h2>

    <label for="instructorImage"><b>Instructor Image</b></label>
    <input type="file" name="instructorImage" accept="image/*">

    <label for="instructorID"><b>Instructor ID</b></label>
    <input type="text" placeholder="Enter Instructor ID" name="instructorID" id="instructorID" required>

    <label for="instructorName"><b>Instructor Name</b></label>
    <input type="text" placeholder="Enter Instructor Name" name="instructorName" id="instructorName" required>

    <label for="sectionName"><b>Section Name</b></label>
    <select name="sectionName" id="sectionName" required>
      <?php foreach ($sections as $section): ?>
        <option value="<?php echo $section['sectionName']; ?>">
          <?php echo $section['sectionName']; ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label for="password"><b>Password</b></label>
    <input type="text" placeholder="Enter password" name="password" required>
    
    <br> <br>

    <button type="submit" class="btn" name="updateInstructor">Update</button>
    <button type="button" class="btn cancel" onclick="closeEditForm()">Cancel</button>
  </form>
</div>


<form id="deleteInstructorForm" action="manageInstructor.php" method="post">
    <input type="hidden" name="instructorID" id="instructorIDInput">
    <input type="hidden" name="deleteInstructor" value="1">
</form>


    <script>
        // ---------------------------------- adding instructor open js -------------------------------- //
        
        
                // Get the button element
                var addInstructorButton = document.getElementById('addInstructorButton');

                // Get the popup form element
                var addInstructorForm = document.getElementById('addForm');

                // Add an event listener to the button for the click event
                addInstructorButton.addEventListener('click', function(event) {
                // Prevent the default form submission behavior
                event.preventDefault();

                // Show the popup form
                addInstructorForm.style.display = 'block';
                });


                // Function to close the pop-up form
                function closeAddForm() {
                document.getElementById("addForm").style.display = "none";
                }

         // ------------------------- OPENING EDITING FORM --------------------------------//



            function openEditForm(instructorID) {
            var instructors = <?php echo json_encode($instructors); ?>;
            var instructorDetails = instructors.find(function (i) {
            return i.instructorID === instructorID;
            });

            if (instructorDetails) {
            document.getElementById("instructorID").value = instructorDetails.instructorID;
            document.getElementById("instructorName").value = instructorDetails.instructorName;
            document.getElementById("sectionName").value = instructorDetails.sectionName;
            // Populate other form fields as needed

            document.getElementById("editForm").style.display = "block";
                }
            }

            // Function to close the edit form
            function closeEditForm() {
                document.getElementById("editForm").style.display = "none";
            }

            // Get the button elements for edit buttons
            var editButtons = document.getElementsByClassName('edit-button');

            // Add event listeners to each "Edit" button
            Array.from(editButtons).forEach(function (editButton) {
                editButton.addEventListener('click', function (event) {
                var instructorID = event.target.getAttribute('instructorID');
                openEditForm(instructorID);
                });
            });


            
            
            function deleteInstructor(instructorID) {
                    if (confirm("Are you sure you want to delete this Instructor?")) {
                        document.getElementById('instructorIDInput').value = instructorID;
                        document.getElementById('deleteInstructorForm').submit();
                    }
                }












        // ------------ Search function for filtering the table ---------------------------- //
        
        function searchTable() {
            var input, filter, table, tbody, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("instructor-table");
            tbody = table.getElementsByTagName("tbody")[0];
            tr = tbody.getElementsByTagName("tr");

            // Loop through all table rows and hide those that don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Assuming the instructor name is in the second column

                if (td) {
                    txtValue = td.textContent || td.innerText;

                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }


         // ---------------------- Print function ---------------------------- //
         function printPage() {
            // Hide the unnecessary elements
            var elementsToHide = document.querySelectorAll('.upperbox, .lowerbox, .searchbox');
            for (var i = 0; i < elementsToHide.length; i++) {
                elementsToHide[i].style.display = 'none';
            }

            // Print the page
            window.print();

            // Show the hidden elements after printing
            for (var i = 0; i < elementsToHide.length; i++) {
                elementsToHide[i].style.display = '';
            }
        }
    </script>
</body>
</html>
</body>
</html>
