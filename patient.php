<?php
    include_once("header.php");

    if(!isloggedin())
    {
        header("Location: login.php");
    }

    if(isset($_SESSION["addsubmit"]))
    {
    $pname = "SELECT pname FROM ptable ORDER BY pid DESC LIMIT 1";
    $result = $conn->query($pname);
    $pname = $result->fetch_assoc();

    $pid = "SELECT pid FROM ptable ORDER BY pid DESC LIMIT 1";
    $result = $conn->query($pid);
    $pid = $result->fetch_assoc();

    $page = "SELECT page FROM ptable ORDER BY pid DESC LIMIT 1";
    $result = $conn->query($page);
    $page = $result->fetch_assoc();

    $Gender = "SELECT Gender FROM ptable ORDER BY pid DESC LIMIT 1";
    $result = $conn->query($Gender);
    $Gender = $result->fetch_assoc();

    $Papa = "SELECT Papa FROM ptable ORDER BY pid DESC LIMIT 1";
    $result = $conn->query($Papa);
    $Papa = $result->fetch_assoc();

    $Mama = "SELECT Mama FROM ptable ORDER BY pid DESC LIMIT 1";
    $result = $conn->query($Mama);
    $Mama = $result->fetch_assoc();

    $phno = "SELECT PhNo FROM ptable ORDER BY pid DESC LIMIT 1";
    $result = $conn->query($phno);
    $phno = $result->fetch_assoc();

    $addr = "SELECT addr FROM ptable ORDER BY pid DESC LIMIT 1";
    $result = $conn->query($addr);
    $addr = $result->fetch_assoc();



    }

    if(isset($_SESSION["searchsubmit"]))
    {
    $pname= "SELECT pname FROM ptable WHERE pid = '{$_SESSION["PID"]}'";
    $result = $conn->query($pname);
    $pname = $result->fetch_assoc();

    $pid = "SELECT pid FROM ptable WHERE pid = '{$_SESSION["PID"]}'";
    $result = $conn->query($pid);
    $pid = $result->fetch_assoc();

    $page = "SELECT page FROM ptable WHERE pid = '{$_SESSION["PID"]}'";
    $result = $conn->query($page);
    $page = $result->fetch_assoc();

    $Gender = "SELECT Gender FROM ptable WHERE pid = '{$_SESSION["PID"]}'";
    $result = $conn->query($Gender);
    $Gender = $result->fetch_assoc();

    $Papa = "SELECT Papa FROM ptable WHERE pid = '{$_SESSION["PID"]}'";
    $result = $conn->query($Papa);
    $Papa = $result->fetch_assoc();

    $Mama = "SELECT Mama FROM ptable WHERE pid = '{$_SESSION["PID"]}'";
    $result = $conn->query($Mama);
    $Mama = $result->fetch_assoc();

    $phno = "SELECT PhNo FROM ptable WHERE pid = '{$_SESSION["PID"]}'";
    $result = $conn->query($phno);
    $phno = $result->fetch_assoc();

    $addr = "SELECT addr FROM ptable WHERE pid = '{$_SESSION["PID"]}'";
    $result = $conn->query($addr);
    $addr = $result->fetch_assoc();


    
    }

    $_SESSION["pid"] = $pid["pid"];


    if(isset($_POST["treat_submit"]))
    {
        $intake_note= trim($_POST["intake_note"]);
        $treat_note = trim($_POST["treatment_note"]);
        $progress_note = trim($_POST["progress_note"]);
        $cons_note = trim($_POST["cons_note"]);
        $extra_note = trim($_POST["extra_note"]);

        $q = "INSERT INTO treatment (curr_date,intake_note,treatment_note,progress_note,consultant_note,extra_note,treat_id) VALUES (?,?,?,?,?,?,?)";
        $query = $conn->prepare($q) or die("error - " . $conn->error);
        $query->bind_param("ssssssd",date("Y/m/d"),$intake_note,$treat_note,$progress_note,$cons_note,$extra_note,$pid["pid"]) or die("error - " . $conn->error);
        $query->execute() or die ("error - " . $conn->error);
        
        

        header('Location:submitprint.php');
       
        $query->close();

    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Patient Record</title>
<!--
Pipeline
http://www.templatemo.com/tm-496-pipeline
-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400">   <!-- Google web font "Open Sans", https://fonts.google.com/ -->
    <link rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css">           <!-- Font Awesome, http://fontawesome.io/ -->
    <link rel="stylesheet" href="css2/bootstrap.min.css">                                 <!-- Bootstrap style, http://v4-alpha.getbootstrap.com/ -->
    <link rel="stylesheet" href="css2/magnific-popup.css">                                <!-- Magnific pop up style, http://dimsemenov.com/plugins/magnific-popup/ -->
    <link rel="stylesheet" href="css2/templatemo-style.css">                              <!-- Templatemo style -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
      </head>

      <body>

<form action = "patient.php" method = "post">
        <div class="container-fluid">

            <section id="welcome" >
                
                <div class="tm-banner-inner">
                    <div id="navbar" style="position: absolute; left : 5%; font-size: 150%">
                    <a href="gobackfrompatient.php">Go Back</a>
                    </div>
                    <div id="navbar" style="position: absolute; right : 5%; font-size: 150%">
                    <a href="delete.php" >Delete Patient</a>
                    </div>
                    <h1 class="tm-banner-title">PATIENT RECORD</h1>                        
                </div>                    
            </section>
            
            <section id="welcome" class="tm-content-box tm-banner margin-b-10">
                <div class="tm-banner-inner">
                    <h1 class="tm-banner-title">
    
                <form>
                    <h3 style = "position : absolute;left: 10% " >Patient ID : </h3>
                    <input type="text" style = "font-size: 150%; font-family: Arial;background-color: transparent; border-color: transparent; position: absolute; left : 20% ; top : 17.75%" readonly value=<?php echo $pid["pid"]?>>
                    
             
                </form>

                <div style = "position : absolute; right : 05%;top : 11%" >
                <script language="javascript" class = "mb-4">
                var today = new Date();
                document.write(today);
                 </script>
                </div>
            </h1>                        
                </div>                    
            </section>




            <div class="tm-body">
                <div class="tm-sidebar">
                    <nav class="tm-main-nav">
                        <ul class="tm-main-nav-ul">
                            <li class="tm-nav-item"><a href="#basicinfo" class="tm-nav-item-link tm-button">
                                <i class="fa fa-sitemap tm-nav-fa"></i>Basic Information</a>
                            </li>
                            
                            <li class="tm-nav-item"><a href="#services" class="tm-nav-item-link tm-button">
                                <i class="fa fa-envelope-o tm-nav-fa"></i>Intake Notes</a>
                            </li>
                            <li class="tm-nav-item"><a href="#about" class="tm-nav-item-link tm-button">
                                <i class="fa fa-envelope-o tm-nav-fa"></i>Treatment Notes</a>
                            </li>
                            <li class="tm-nav-item"><a href="#contact1" class="tm-nav-item-link tm-button">
                                <i class="fa fa-envelope-o tm-nav-fa"></i>Progress Notes</a>
                            </li>
                <li class="tm-nav-item"><a href="#contact2" class="tm-nav-item-link tm-button">
                                <i class="fa fa-envelope-o tm-nav-fa"></i>Consultation Notes</a>
                            </li>
            <li class="tm-nav-item"><a href="#contact3" class="tm-nav-item-link tm-button">
                                <i class="fa fa-envelope-o tm-nav-fa"></i>Extra Notes</a>
                            </li>
            <li class="tm-nav-item"><a href="#gallery" class="tm-nav-item-link tm-button">
                                <i class="fa fa-tasks tm-nav-fa"></i>History of Visits</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                
                <div class="tm-main-content">
                    
                    <div class="tm-content-box tm-content-box-home" id = "basicinfo">                        
                        <img src="img/nurse-hospital_2101382c.jpg" alt="Image 1" class="img-fluid tm-welcome-img">                        
                        <div class="tm-welcome-boxes-container">
                            <div class="tm-welcome-box">
                                <div class="tm-welcome-text" >
                                  <h2 class="tm-section-title" >BASIC INFORMATION</h2>
                                        <h6 style = "position : absolute; left : 4%; top : 28%" >Patient Name : </h6>
                                        <input type="text" style = "font-size: 100%; font-family: Arial; position : absolute; left : 20%; top : 26% ;height: 10% ; background-color: transparent; border-color: transparent;" readonly value="<?php echo $pname["pname"]?>">
                                        <h6 style = "position : absolute; left : 4%; top : 35%" >Age : </h6>
                                        <input type="text" style = "font-size: 100%; font-family: Arial; position : absolute; left : 20%; top : 33% ;height: 10% ; background-color: transparent; border-color: transparent;" readonly value=<?php echo $page["page"]?>>
                                        <h6 style = "position : absolute; left : 4%; top : 42%" >Gender : </h6>
                                        <input type="text" style = "font-size: 100%; font-family: Arial; position : absolute; left : 20%; top : 40% ;height: 10% ; background-color: transparent; border-color: transparent;" readonly value=<?php echo $Gender["Gender"]?>>
                                        <h6 style = "position : absolute; left : 4%; top : 49%" >Father's Name: </h6>
                                        <input type="text" style = "font-size: 100%; font-family: Arial; position : absolute; left : 20%; top : 47% ;height: 10% ; background-color: transparent; border-color: transparent;" readonly value="<?php echo $Papa["Papa"]?>">
                                        <h6 style = "position : absolute; left : 4%; top : 56%" >Mother's Name: </h6>
                                        <input type="text" style = "font-size: 100%; font-family: Arial; position : absolute; left : 20%; top : 54% ;height: 10% ; background-color: transparent; border-color: transparent;" readonly value="<?php echo $Mama["Mama"]?>">
                                        <h6 style = "position : absolute; left : 4%; top : 63%" >Phone Number: </h6>
                                        <input type="text" style = "font-size: 100%; font-family: Arial; position : absolute; left : 20%; top : 61% ;height: 10% ; background-color: transparent; border-color: transparent;" readonly value="<?php echo $phno["PhNo"]?>">
                                        <h6 style = "position : absolute; left : 4%; top : 70%">Address: </h6>
                                        <textarea cols = "30" rows = 4 style = "font-size: 100%; font-family: Arial; position : absolute; left : 20%; top : 70% ;background-color: transparent; border-color: transparent;vertical-align: top" ><?php echo $addr["addr"]?></textarea>

                                </div>
                            </div>
            
                        </div>
                    </div>
                        
                    
                    <div id="services" class="tm-content-box tm-gray-bg tm-services">

                        
                            
                        <div class="tm-box-pad">
                            <h2 class="tm-section-title" style = "position : relative ; right = 20%">INTAKE NOTES</h2>
                            <p class="tm-section-description" style = "position : relative ; right = 20%">  
   
        <fieldset>
        
        <p>
            
            <textarea id  = "TA" rows="10" cols = "60" name = "intake_note" ></textarea> 
        </p>
    </fieldset>
    
                        
</div>                                              
                        
                    </div>

                    <!-- slider -->
                    <div id="about" class="tm-content-box">
                        <div class="tm-box-pad tm-bordered-box  ">
                            <h2 class="tm-section-title">TREATMENT NOTES </h2>
       
        <fieldset>
        
        <p>
            
            <textarea id  = "TA" rows="10" cols = "60" name = "treatment_note">Your text here </textarea> 
        </p>
    </fieldset>
    
        </div>
                        </div>
                        <div id="contact1" class="tm-content-box tm-gray-bg">
                        <div class="tm-box-pad tm-bordered-box ">
                            <h2 class="tm-section-title">PROGRESS NOTES </h2>
       
        <fieldset>
        
        <p>
            
            <textarea id  = "TA" rows="10" cols = "60" name = "progress_note">Your text here </textarea> 
        </p>
    </fieldset>
    

                        </div>                       
                    </div>

    <div id="contact2" class="tm-content-box">
                        <div class="tm-box-pad tm-bordered-box ">
                            <h2 class="tm-section-title">CONSULTATION NOTES </h2>
      
        <fieldset>
        
        <p>
            
            <textarea  rows="10" cols = "60" name = "cons_note">Your text here </textarea> 
        </p>
    </fieldset>
    

                        </div>                       
                    </div>

    <div id="contact3" class="tm-content-box tm-gray-bg">
                        <div class="tm-box-pad tm-bordered-box ">
                            <h2 class="tm-section-title">EXTRA NOTES </h2>
        
        <fieldset>
        
        <p>
            
            <textarea id  = "TA" rows="10" cols = "60" name = "extra_note">Your text here </textarea> 
        </p>
    </fieldset>
    

                        </div>                       
                    </div>
<div align="center">
<br><input  type ="submit" 
    style="width: 300px; 
    border: none;
    border-radius: 5px;
    padding: 6px;
    background-color:  #73264d;
    font color: #ffffff;
    margin: 10px 5px;" name = "treat_submit" value = "Submit" ><br><br>
</div>
</form>

<div style="visibility: hidden;">
    <?php include_once("buttonAdd.php");
        include_once("buttonSearch.php");?>
</div>
        <div id="gallery" class="tm-content-box"> 
              <div class="tm-box-pad tm-bordered-box">
                            <h2 class="tm-section-title">HISTORY OF VISITS</h2>
                            <form action="history.php">
                            <br><input  type ="submit" 
                                    style="width: 300px; 
                                    border: none;
                                    border-radius: 5px;
                                    padding: 6px;
                                    background-color:  #73264d;
                                    font color: #ffffff;
                                    margin: 10px 5px;" name = "Go" value = "GO" ><br><br>
                           </form>
                        </div>                       
                       
                    </div>

         
                           
                    <footer class="tm-footer">
                        <p class="text-xs-center">Copyright &copy; 2016 Your Company | Design: <a href="http://templatemo.com" target="_parent">Templatemo</a></p>
                    </footer>

                </div>
            </div>             
        </div>
        
        <!-- load JS files -->
        
        <script src="js2/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
        <script src="https://www.atlasestateagents.co.uk/javascript/tether.min.js"></script> <!-- Tether for Bootstrap (http://stackoverflow.com/questions/34567939/how-to-fix-the-error-error-bootstrap-tooltips-require-tether-http-github-h) -->
        <script src="js2/jquery.magnific-popup.min.js"></script>     <!-- Magnific pop-up (http://dimsemenov.com/plugins/magnific-popup/) -->
        <script src="js2/jquery.singlePageNav.min.js"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
        
        <!-- Templatemo scripts -->
        <script>  

        /* Google map
        ------------------------------------------------*/
        var map = '';
        var center;

        function initialize() {
            var mapOptions = {
                zoom: 16,
                center: new google.maps.LatLng(37.769725, -122.462154),
                scrollwheel: false
            };
        
            map = new google.maps.Map(document.getElementById('google-map'),  mapOptions);

            google.maps.event.addDomListener(map, 'idle', function() {
              calculateCenter();
            });
        
            google.maps.event.addDomListener(window, 'resize', function() {
              map.setCenter(center);
            });
        }

        function calculateCenter() {
            center = map.getCenter();
        }

        function loadGoogleMap(){
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' + 'callback=initialize';
            document.body.appendChild(script);
        } 

        function setNavbar() {
            if ($(document).scrollTop() > 160) {
                $('.tm-sidebar').addClass('sticky');
            } else {
                $('.tm-sidebar').removeClass('sticky');
            }
        }                   
    
        $(document).ready(function(){
            
            // Single page nav
            $('.tm-main-nav').singlePageNav({
                'currentClass' : "active",
                offset : 20
            });

            // Detect window scroll and change navbar
            setNavbar();
            
            $(window).scroll(function() {
              setNavbar();
            });

            // Magnific pop up
            $('.tm-gallery').magnificPopup({
              delegate: 'a', // child items selector, by clicking on it popup will open
              type: 'image',
              gallery: {enabled:true}
              // other options
            });

            // Google Map
            loadGoogleMap();            
        });
    
        </script>             

    </body>
    </html>
