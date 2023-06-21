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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----------TITLE------------>
    <link rel="shortcut icon" href="logo.png" type="">
    <title>
        <?php echo "Instructor Page"; ?>
    </title>

    <!----------CSS------------>
    <link rel="stylesheet" href="style_instructor.css">

    <!----------BOOTSTRAP------------>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!----------FONTS------------>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Inter:wght@400;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">

    <!----------ICONS------------>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/11a4f2cc62.js" crossorigin="anonymous"></script>

    <!---Inner topbar--->
    <?php include('topbar.php'); ?>

</head>

<!----Body----->

<body>
    <section class="bg-section">
        <!---------Sidebar------------>
        <?php include('sidebar-instructor.php'); ?>

        <!---------End Sidebar--------->

        <!--Main Content-->
        <div class="pcoded-main-content">
            <div class="container pt-4 px-4">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="homepage-title">
                            <?php echo " Instructor Name: $instructorName" ?>
                            <h1>FILIPINO SUBJECT-
                                <?php echo "$instructorCourse" ?>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="box">
                        <div class="content-box">
                            <h4>2022 - 2023</h4>
                            <span>ACADEMIC YEAR</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <div class="content-box">
                            <h4>SECOND</h4>
                            <span>SEMESTER</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-----End Main content------>
    </section>
    <!-----End of Body------>
</body>

</html>