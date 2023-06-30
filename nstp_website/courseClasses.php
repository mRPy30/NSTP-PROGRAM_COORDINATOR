
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

$sql = "SELECT * FROM tbl_sections WHERE courseID = '$selectedCourseID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sections = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $sections = array();
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
            padding: 5px;
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
            width: 600px;
            border: solid black 1px;
            display: flex;
            justify-content: center;
            overflow: hidden;


        }

        #course-table {
            width: 90%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        #course-table th,
        #course-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        #course-table th {
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
        #add-section-popup {
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
        
        @media print {
            .upperbox,
            .lowerbox,
            .searchbox
            .sidebar{
                display: none;
            }
        }

        #edit-section-popup .cancel-button {
            background-color: #ccc;
            color: #fff;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            margin-left: 70px;
        }

        #edit-section-popup .cancel-button:hover {
            background-color: #999;
        }
    </style>
</head>

<body>
    <div class="content print-container">
    
    <!-------------------------------------- UPPER PART NG PAGE --------------------------------------------->
    
        <div class="upperbox">

            <h3><?php echo $selectedCourseName; ?></h3>
            
            <div class="searchbox">
            <input  type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search section names...">
            </div>

            <div class="print">
            <button onclick="window.print()"> Print</button>
            </div>

            <a href="recordsClasses.php" class="go-back-button">Go Back</a>

     
        </div>

       
         <!--------------------------------------TABLE NG CLASSES --------------------------------------------->

        <div class="tabledisplay">
            <table id="course-table">
                <thead>
                    <tr>
                        <th>Section Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="scrollable-tbody">
                            <?php if (!empty($sections)): ?>
                                <?php foreach ($sections as $section): ?>
                                    <tr>
                                        <td><?php echo $section['sectionName']; ?></td>
                                        <td>
                                            <button onclick="openForm('<?php echo $section['sectionID']; ?>')" class="edit-button">Edit</button>
                                        </td>
                                        <td>
                                            <a href="manageClass.php?delete=<?php echo $section['sectionID']; ?>&courseID=<?php echo $selectedCourseID; ?>&courseName=<?php echo $selectedCourseName; ?>" class="delete-button">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                        <tr>
                            <td colspan="3">No sections found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!--------------------------------------  PARA SA ADDITION BUTTON --------------------------------------------->
        <div class="lowerbox">
            <button id="add-course-button" style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;">Add Section</button>
        </div>
    </div>





    <!----------------- POP UP FORM NG PAG ADD NG BAGONG CLASS -------------->

        <div id="add-section-popup" class="form-popup">
            <form method="post" class="form-container" id="add-section-form" action="manageClass.php">
                <h4>Add Class</h4>
                <label for="add-sectionName">Section Name:</label>
                <input type="text" name="sectionName" placeholder="Enter section name">
                <button type="submit">Add Class</button>
            </form>
        </div>

   
    <!----------------- POP UP FORM PARA SA PAG EDIT NG ISANG CLASS -------------->

        <div id="edit-section-popup" class="form-popup">
            <form method="post" class="form-container" id="edit-section-form" action="manageClass.php">
                <h4>Edit Course</h4>
                <input type="hidden" name="sectionID" id="edit-sectionID">
                <label for="edit-sectionName">Section Name:</label>
                <input type="text" id="edit-sectionName" name="sectionName" required>
                <br><br>
                <button type="submit">Update Section</button>
                <button type="button" class="cancel-button">Cancel</button>
            </form>
        </div>










    
     <!---------------------------------     JAVASCRIPT CODE ------------------------------------------>
    <script>

            // ---------------- JS PARA BUMUKAS YUNG POP UP FORM PARA SA PAG EDIT ---------------- //

        function openForm(sectionID) {
            var section = <?php echo json_encode($sections); ?>;
            var sectionDetails = section.find(s => s.sectionID === sectionID);

            if (sectionDetails) {
                document.getElementById("edit-sectionID").value = sectionDetails.sectionID;
                document.getElementById("edit-sectionName").value = sectionDetails.sectionName;
                document.getElementById("edit-section-popup").style.display = 'block';
            }
        }

        // Close the pop-up form
        function closeForm() {
            document.getElementById("edit-section-popup").style.display = 'none';
        }

        
        // Close the edit section pop-up form when the cancel button is clicked
        document.querySelector('#edit-section-popup .cancel-button').addEventListener('click', () => {
                document.getElementById('edit-section-popup').style.display = 'none';
            });











        // ---------------- JS PARA BUMUKAS YUNG POP UP FORM PARA SA PAG ADD NG BAGONG CLASS ---------------- //

        // Get the button element
        var addCourseButton = document.getElementById('add-course-button');

        // Get the popup form element
        var editCoursePopup = document.getElementById('add-section-popup');

        // Add an event listener to the button for the click event
        addCourseButton.addEventListener('click', function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Show the popup form
            editCoursePopup.style.display = 'block';
        });



        // --------------------------------- JS PARA SA PAG SEARCH  ------------------------------- //

        function searchTable() {
            var input, filter, table, tbody, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("course-table");
            tbody = table.getElementsByTagName("tbody")[0];
            tr = tbody.getElementsByTagName("tr");

            // Loop through all table rows and hide those that don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0]; // Assuming the section name is in the first column

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

        // --------------------------------- JS PARA SA PAG PRINT  ------------------------------- //
        
        // Print function
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