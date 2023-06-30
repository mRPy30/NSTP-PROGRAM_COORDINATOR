<?php
include 'db_connect.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve the form data
    $name = $_POST["name"];
    $id = $_POST["id"];
    $course = $_POST["course"];
    $section = $_POST["section"];
    $password = $_POST["password"];

    // Check if the ID already exists in the database
    $checkQuery = "SELECT * FROM student WHERE id = '$id'";
    $checkResult = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "duplicate id";
    } else {
        // Get the section ID from the selected section value
        $sectionIDQuery = "SELECT sectionID FROM tbl_sections WHERE sectionName = '$section'";
        $sectionIDResult = mysqli_query($conn, $sectionIDQuery);
        $sectionID = mysqli_fetch_assoc($sectionIDResult)['sectionID'];

        // Prepare and execute the SQL statement to insert data into the student table
        $sql = "INSERT INTO student (name, id, course, sectionID, password) VALUES ('$name', '$id', '$course', '$sectionID', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "Sign up successful!";
            // Redirect to the login page after successful sign up
            header("Location: log-in.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// Fetch course data from the database
$query = "SELECT courseID, courseName FROM tbl_course";
$result = mysqli_query($conn, $query);
$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch section data from the database
$query = "SELECT sectionID, sectionName FROM tbl_sections";
$result = mysqli_query($conn, $query);
$sections = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>SIGN UP</title>

    <style>

    .container {
                border: solid 1px black;
                width: 450px;
                border-radius: 10px;
                overflow: hidden;
            }

    .form-control {
            margin-bottom: 18px;
            position: relative;
    }

    .form {
            padding: 40px;
     }

    .form-control label {
            display: inline-block;
            margin-bottom: 10px;
            left: 15px;
            position: absolute;
            

    }

    .form-control input {
        width: 400px;
        border: 1px solid black;
        font-size: 14px;
        border-radius: 5px;
        padding: 12px;
        display: block;
    }

    .form-control input:focus {
        border-color: #777;
    }

    .form-control.success input {
        border-color: #39df7e;
    }

    .form-control.error input {
        border-color: #df3434;
    }

    .form-control i {
        position: absolute;
        right: 35px;
        top: 30px;
        visibility: hidden;
    }
    .form-control small {
        color: #df3434;
        position: absolute;
        left: 20px;
        display: none; /* Change visibility to display */
    }
    .form-control.success i.fa-check-circle {
        color: #39df7e;
        visibility: visible;
    }

    .form-control.error i.fa-exclamation-circle {
        color: #df3434;
        visibility: visible;
    }
    

    .form-control select:focus {
        border-color: #777;
    }
    
    .form-control.success select {
        border-color: #39df7e;
    }

    .form-control.error select {
        border-color: #df3434;
    }
   



    .form-control-1 {
            margin-bottom: 18px;
            position: relative;
    }
    

    .form-control-1 select {
        width: 275px;
        border: 1px solid black;
        font-size: 14px;
        border-radius: 5px;
        padding: 12px;
        display: block;
    }

    .form-control-1 label {
            display: inline-block;
            margin-bottom: 10px;
            left: 4px;
            position: absolute;
            

    }


    .form-control-2 {
            margin-bottom: 18px;
            position: relative;
    }

    .form-control-2 select {
        width: 140px;
        border: 1px solid black;
        font-size: 14px;
        border-radius: 5px;
        padding: 12px;
        display: block;
        margin-left: 10px;
    }

    .form-control-2 label {
            display: inline-block;
            margin-bottom: 10px;
            left: 11px;
            position: absolute;
            

    }
    .box-control {
       
        display:flex;
        margin-left:11px;
    }


    </style>
</head>
<body>
    <center>
    <div class="container">

        <div class="header">
            <h2>SIGN UP</h2>
        </div>

        
        <form method="POST">

        <div class="form-control">
            <label for="name">Name:</label>
            <br>
            <input type="text" id='name' name="name">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error</small>
        </div>
            
        <div class="form-control">
            <label for="id">Student ID:</label>
            <br>
            <input type="text" id='id' name="id" required>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error</small>
        </div>

        <div class="box-control">
            <div class="form-control-1">
                <label for="course">NSTP Program:</label>
                <br>
                <select name="course" id="course">
                    <!-- code for getting nstp program -->
                    <?php foreach ($courses as $course) : ?>
                        <option value="<?php echo $course['courseID']; ?>"><?php echo $course['courseName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
                   
            <div class="form-control-2">     
                <label for="section">Section:</label>
                <br>
                <!-- code for getting sections in the nstp program -->
                <select name="section" id="section">
                <?php foreach ($sections as $section) : ?>
                        <option value="<?php echo $section['sectionID']; ?>"><?php echo $course['sectionName']; ?></option>
                <?php endforeach; ?>
                </select>
            </div>
        
        </div>

        <div class="form-control">          
            <label for="password">Password:</label>
            <br>
            <input type="password" id='password' name="password">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error</small>
        </div>

         <div class="form-control">  
         <br>
         <input type="submit" value="submit" >
        </div>

        </form>
    </div>
    </center>

    <script>
        // JavaScript code to populate the section dropdown dynamically

        // Define an object to store the sections for each course
        var sections = {
            <?php
            // Fetch section data from the database based on courses
            $query = "SELECT courseID, sectionName FROM tbl_sections";
            $result = mysqli_query($conn, $query);
            $sections = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Organize the sections by course ID
            $sectionsByCourse = [];
            foreach ($sections as $section) {
                $courseId = $section['courseID'];
                $sectionName = $section['sectionName'];

                if (!isset($sectionsByCourse[$courseId])) {
                    $sectionsByCourse[$courseId] = [];
                }

                $sectionsByCourse[$courseId][] = $sectionName;
            }

            // Output the sections as JavaScript object
            foreach ($sectionsByCourse as $courseId => $courseSections) {
                echo "$courseId: [";
                foreach ($courseSections as $index => $section) {
                    if ($index !== 0) {
                        echo ", ";
                    }
                    echo "'$section'";
                }
                echo "], ";
            }
            ?>
        };

        // Get reference to the section dropdown
        var sectionDropdown = document.getElementById('section');

        // Add an event listener to the course dropdown
        document.getElementById('course').addEventListener('change', function() {
            // Clear the section dropdown
            sectionDropdown.innerHTML = '';

            // Get the selected course ID
            var selectedCourseId = this.value;

            // Retrieve the sections for the selected course
            var selectedCourseSections = sections[selectedCourseId];

            // Populate the section dropdown based on the selected course
            selectedCourseSections.forEach(function(section) {
                var option = document.createElement('option');
                option.textContent = section;
                sectionDropdown.appendChild(option);
            });
        });

        // Trigger the change event initially to populate the section dropdown
        document.getElementById('course').dispatchEvent(new Event('change'));


            // ------------------- JAVASCRIPT code for form validation -----------------------//

        // JavaScript code for form validation

        const form = document.querySelector('form');
        const name = document.getElementById('name');
        const id = document.getElementById('id');
        const password = document.getElementById('password');

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            if (validate()) {
                form.submit(); // Submit the form if validation succeeds
            }
        });

        const namePattern = /^[a-zA-Z ]+$/;

        function validate() {
            const nameVal = name.value.trim();
            const idVal = id.value.trim();
            const passwordVal = password.value.trim();

            let isValid = true; // Track the validation result

            // Name validation
            if (nameVal === '') {
                setErrorMsg(name, 'Name cannot be blank');
                isValid = false;
        
           
            } else if (/\d/.test(nameVal)) {
                setErrorMsg(name, 'Names should have no numeric characters');
                isValid = false;

            } else if (!namePattern.test(nameVal)) {
                setErrorMsg(name, 'Names should only contain letters and spaces');
                isValid = false;

            } else {
                setSuccessMsg(name);
            }

            // ID validation
            if (idVal === '') {
                setErrorMsg(id, 'ID cannot be blank');
                isValid = false;
            } else if (!/^\d+$/.test(idVal)) {
                setErrorMsg(id, 'ID should only contain numbers');
                isValid = false;
            } else if (idVal.length !== 9) {
                setErrorMsg(id, 'ID should have exactly 9 digits');
                isValid = false;
            } else {
                setSuccessMsg(id);
            }

            // Password validation
            if (passwordVal === '') {
                setErrorMsg(password, 'Password cannot be blank');
                isValid = false;
            } else if (passwordVal.length < 8) {
                setErrorMsg(password, 'Password should have at least 8 characters');
                isValid = false;
            } else if (!/[A-Z]/.test(passwordVal)) {
                setErrorMsg(password, 'Password should contain at least 1 uppercase letter');
                isValid = false;
            } else if (!/[a-z]/.test(passwordVal)) {
                setErrorMsg(password, 'Password should contain at least 1 lowercase letter');
                isValid = false;
            } else if (!/\d/.test(passwordVal)) {
                setErrorMsg(password, 'Password should contain at least 1 numeric character');
                isValid = false;
            } else {
                setSuccessMsg(password);
            }

            return isValid; // Return the overall validation result
        }


        function setErrorMsg(input, errorMsg) {
            const formControl = input.parentElement;
            const small = formControl.querySelector('small');
            formControl.className = 'form-control error';
            small.innerText = errorMsg;
            small.style.display = 'block'; // Change visibility to display
        }

        function setSuccessMsg(input) {
            const formControl = input.parentElement;
            formControl.className = 'form-control success';
            const small = formControl.querySelector('small');
            small.style.display = 'none'; // Change visibility to display
        }
    </script>
</body>
</html>
