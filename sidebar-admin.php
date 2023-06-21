 <style>
*{
    padding: 0;
    box-sizing: border-box;
    margin: 0;
}

    /*****Sidebar*****/ 
 
  .bg-section .sidebar {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    width: 250px;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    height: 100vh;
    overflow-y: auto;
    background: rgba(255, 255, 255, 0.92);
    transition: 0.5s;
    display: block;
    z-index: 1028;
   } 
  .sidebar .navbar-nav{
        margin: 10px 30px;
    }
  .sidebar .navbar-nav .pcoded-inner-navbar {
        flex-direction: column;
    }
   .navbar-nav .pcoded-inner-navbar ul{
        width: 100%;
    }
    .nav {
        display: flex;
        flex-wrap: wrap;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }
    .sidebar .nav .nav-link{
        padding: 15px 25px;
        
        color: #000000;
        font-size: 17px;
        font-family: 'Poppins';
        font-style: normal;
        line-height: 30px;
    }
    .sidebar .nav .nav-link i {
        margin-right: 5px;
        font-size: 20px;
    }
    .sidebar .nav .nav-link.active {
        color: #008A0E;
    }
    .sidebar .nav .nav-link.active:hover {
	    color: #008A0E;
	    box-shadow: 2.5px 3px #00000063;
	}
    /*******RESPONSIVE**********/
@media (min-width: 1400px){
.container {
    max-width: 1320px;
}
}
@media (max-width: 1120px) {}

@media (min-width: 992px){ 
    .container {
        min-width: 1520px;
    }
    .custom_nav-container {
        min-width: 1000px;
  }
    .header-section .row .logout {
        top: 20px;
        min-width: 1000vh;
    }
    .navbar-expand-lg {
        flex-flow: row nowrap;
        justify-content: flex-start;
    }
    .header-section .row .logout{
        top: 20px;
        min-width: 1000vh;
    }
    .header-section .row .logo img{
        width: 80px;
        height: 70px;
        position: sticky;
    }
}
@media (min-width: 768px){
    .col-lg-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
/****End Sidebar*****/
 </style>
 
 <!---------Sidebar------------>
  <nav class="sidebar navbar-collapsed" >
            <div class="navbar-wrapper">
                    <div class="navbar-nav">
                       <ul class="nav pcoded-inner-navbar">
                        <li><a class="nav-link active" aria-current="page" href="adminpage.php"><i class="fa-sharp fa-solid fa-house"></i> Home </a></li>
                        <li><a class="nav-link" href="adminpage.php?page=admin-shedule"><i class="fa-sharp fa-regular fa-calendar-days"></i> Schedule </a></li>
                        <li><a class="nav-link" href="adminpage.php?page=admin-programs"><i class="fa-solid fa-people-group"></i> Programs </a></li>
                        <li><a class="nav-link" href="adminpage.php?page=admin-feedback"><i class="fa-solid fa-comment"></i> Feedback </a></li>
                        <li><a class="nav-link" href="adminpage.php?page=admin-records"><i class="fa-sharp fa-regular fa-rectangle-list"></i> Records </a></li>
                        <li><a class="nav-link" href="adminpage.php?page=admin-reports"><i class="fa-sharp fa-solid fa-chart-pie"></i> Reports </a></li>
                        <li><a class="nav-link" href="adminpage.php?page=admin-compliance" style="font-size: 15px; margin "><i class="fa-solid fa-clipboard-check"></i> Compliance </a></li>
                       </ul><p>hotdog</p>
                    </div>
                </div>
            </nav>
        </div>
<!-------End Sidebar------------>        