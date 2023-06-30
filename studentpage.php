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
<?php include('topbar.php');?>
<style type="text/css">
                            .container {
                                position: absolute;
                                display: flex;
                                flex-direction: row;
                                border: 1px solid black;
                                padding: 10px;
                                width: 1100px;
                                height: 700px;
                                top:450px;
                                left: 840px;
                                transform: translate(-50%, -50%);
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
    <section class="bg-section">
   <!---------Sidebar------------>
   <?php include('sidebar-student.php');?>
    <!---------End Sidebar--------->
  
     
                             <!--Main Content codeeeee-->

                         <div class="container">
                            
                             <div class="nstp">NSTP 1</div>

                             <div class="statusbox"> 

                             <div class="status">Status</div>
                             <div class="courseandsection">Course and Section</div>
                            
                             </div>
                         
                           








                            
                                         

                      
                          
                       
                      

                           
                            

    <!-----End Main content------>        
    </section>
<!-----End of Body------>
</body>
</html>