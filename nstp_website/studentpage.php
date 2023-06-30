<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----------TITLE------------>
    <link rel="shortcut icon" href="logo.png" type="">
    <title><?php echo "Instructor Page"; ?></title>

     <!----------CSS------------>
    <link rel="stylesheet" href="style_student.css">

     <!----------BOOTSTRAP------------>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     
     <!----------FONTS------------>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&family=Inter:wght@400;800&family=Poppins:wght@400;500&display=swap" rel="stylesheet">

    <!----------ICONS------------>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/11a4f2cc62.js" crossorigin="anonymous"></script>


     
<!---Inner topbar--->
<header class=" flex-column flex-md-row bd-navbar sticky-top header-section navbar-expand  ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8 logo ">
                   <img src="logo.png" alt="">
                    <div class=" p1">
                        <p class="font-weight-normal">CVSU-IMUS CAMPUS</p>
                    </div>
                    <div class="p2">
                        <p>NSTP PROGRAM</p>
                    </div>
                    <div class="w-100 logout">
                        <button type="button" class="btn btn-light rounded btn-logout float-left " a href="logout.php"><i
                                class="fa-solid fa-arrow-right-from-bracket"></i> LOGOUT </button>
                    </div>
                </div>
            </div>
    </header>
    <style type="text/css">
                            .container {
                        
                            /*add flexbox style*/

                            display: flex;
                            flex-direction: row;
                            border: 1px black solid;
                            width: 1100px;
                            }    
                            
                            .nstp{
                            border: 1px black solid;
                            width: 735px;
                            height: 217px;
                            margin: 10px;
                            background-color: #FFE193;
                            }

                            .statusbox {
                            border: 1px black solid;
                            width: 400px;
                            height: 217px;
                            margin: 10px;
                            padding: 1px;
                           

                            }

                            .status{
                            border: 1px black solid;
                            width: 365px;
                            height: 93px;
                            margin: 10px;
                            background-color: #FFFFFF;
                            }

                            .courseandsection{
                            border: 1px black solid;
                            width: 365px;
                            height: 93px;
                            margin: 10px;
                            background-color: #FFFFFF;
                            }

                        </style>





</head>

<!----Body----->
<body>

   <!---------Sidebar------------>
   

   <section class="bg-section">
   <nav class="sidebar navbar-collapsed" >
            <div class="navbar-wrapper">
                    <div class="navbar-nav">
                       <ul class="nav pcoded-inner-navbar">
                        <li><a class="nav-link active" aria-current="page" href="studentpage.php"><i class="fa-sharp fa-solid fa-house"></i> Home </a></li>
                        <li><a class="nav-link" href="studentpage.php?page=student-classes"><i class="fa-solid fa-book"></i> Classes </a></li>
                        <li><a class="nav-link" href="studentpage.php?page=student-feedback"><i class="fa-solid fa-people-group"></i> Programs </a></li>
                        <li><a class="nav-link" href="studentpage.php?page=student-programs"><i class="fa-solid fa-comment"></i> Feedback </a></li>
                       </ul>
                    </div>
                </div>
            </nav>
        </div>    
    <!---------End Sidebar--------->
        

        <!--Main Content-->
        <div class="pcoded-main-content">
                <div class="container pt-4">
                    <div class="row align-items-center">
                        <div class="col-lg-12">

                             <!--Main Content codeeeee-->

                         <div class="container">
                            
                             <div class="nstp">NSTP 1</div>

                             <div class="statusbox"> 

                             <div class="status">Status</div>
                             <div class="courseandsection">Course and Section</div>
                            
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