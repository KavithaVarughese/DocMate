<?php
    include_once("header.php");

    if(!isloggedin())
    {
        header("Location: login.php");
    }

    $e = FALSE;
    $err = "";

    $n= "SELECT COUNT(*) FROM appointment WHERE (DATE(app_date) = CURDATE()) AND (doctor_id = '{$_SESSION["user_id"]}')";
    $result = $conn->query($n);
    $n = $result->fetch_assoc();


    if(isset($_POST["Addsubmit"]))
    {
        $pname = trim($_POST["PName"]);
        $pid = trim($_POST["PId"]);
        $page = trim($_POST["PAge"]);
        $gender = trim($_POST["gender"]);
        $papa = trim($_POST["PAPA"]);
        $mama = trim($_POST["MAMA"]);
        $phno = trim($_POST["phno"]);
        $addr = trim($_POST["ADD"]);

        $e = empty($PName) || empty($phno);
        if($e)
            $err .= "Fill the required fields. ";
        
        $e = !preg_match("/^\d{10}$/",$phno);
        if(!preg_match("/^\d{10}$/",$phno))
            $errmob .= "Enter a proper mobile number. "; 
        
        if(!$e)
        {


        $q = "INSERT INTO ptable (pname,page,gender,papa,mama,PhNo,addr,doc_id) VALUES (?, ?,?,?,?,?,?,?)";
        $query = $conn->prepare($q) or die("error - " . $conn->error);
        $query->bind_param("sisssdsd",$pname,$page,$gender,$papa,$mama,$phno,$addr,$_SESSION["user_id"]) or die("error - " . $conn->error);
        $query->execute() or die ("error - " . $conn->error);
          
          $_SESSION["addsubmit"] =$_POST["Addsubmit"] ;
          header('Location:http://localhost/neema/patient.php');
       
        $query->close();

        }

        

    }

    if(isset($_POST["addapp"]))
    {
        $pname = trim($_POST["pname"]);
        $phno = trim($_POST["phno"]);
        $date = trim($_POST["date"]);
        $time = trim($_POST["time"]);

        $pid = "SELECT pid FROM ptable WHERE PhNo = '{$phno}'";
        $result = $conn->query($pid);
        $pid = $result->fetch_assoc();

        $e = empty($time) || empty($phno) ||empty($date);
        if($e)
            $err .= "Fill the required fields. ";
        
        $e = !preg_match("/^\d{10}$/",$phno);
        if(!preg_match("/^\d{10}$/",$phno))
            $errmob .= "Enter a proper mobile number. "; 
        
        if(!$e)
        {


        $q = "INSERT INTO appointment (aname,app_date,app_time,doctor_id,patient_id) VALUES (?,?,?,?,?)";
        $query = $conn->prepare($q) or die("error - " . $conn->error);
        $query->bind_param("sssdd",$pname,$date,$time,$_SESSION["user_id"],$pid["pid"]) or die("error - " . $conn->error);
        $query->execute() or die ("error - " . $conn->error);
          
          header('Location:index.php');
       
        $query->close();

        }

        

    }

    if(isset($_POST["checkPatientList"]))
    {
      header('Location:patientlist.php');

    }

    if(isset($_POST["Searchsubmit"]))
    {

        $pname = trim($_POST["PName"]);
        $_SESSION["PNAME"] = $pname; 

        $check= "SELECT pname FROM ptable WHERE PhNo = '{$_SESSION["PNAME"]}' AND doc_id = '{$_SESSION["user_id"]}'";
        $check2 = "SELECT pid FROM ptable WHERE PhNo = '{$_SESSION["PNAME"]}' AND doc_id = '{$_SESSION["user_id"]}'";
        $result = $conn->query($check);
        $check = $result->fetch_assoc();
        $result2 = $conn->query($check2);
        $check2 = $result2->fetch_assoc();

        $_SESSION["PID"] = $check2["pid"];
        

        if($check["pname"]==NULL)
        { 
          ?>
          <style type="text/css">#error{
          display:block;
          }</style>
          <?php
        }
        else
        {
                 
        $_SESSION["searchsubmit"] = $_POST["Searchsubmit"] ;
        header('Location:http://localhost/neema/patient.php');
       
        // $query->close();
        }

    }
    else
    {
    ?>
    <style type="text/css">#error{
    display:none;
    }</style>
    <?php
    }

    // include_once("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Doctor's Home Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="css1/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css1/animate.css">
    
    <link rel="stylesheet" href="css1/owl.carousel.min.css">
    <link rel="stylesheet" href="css1/owl.theme.default.min.css">
    <link rel="stylesheet" href="css1/magnific-popup.css">

    <link rel="stylesheet" href="css1/aos.css">

    <link rel="stylesheet" href="css1/ionicons.min.css">

    <link rel="stylesheet" href="css1/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css1/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css1/flaticon.css">
    <link rel="stylesheet" href="css1/icomoon.css">
    <link rel="stylesheet" href="css1/style.css">
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div id="navbar" style="position: absolute;right : 4%;font-size: 150%">
      <a href="logout.php">Logout</a>
      </div>
      <a style = "position: absolute; top : -15%; left : 3% ; font-size: 300% ; color: #ff69b4  "class="navbar-brand" href="index.html"><i class="flaticon-pharmacy" style="color:#ff69b4 ;font-size: 100% ;"></i>DocMate</a>
      <div class="container">
        <a class="navbar-brand" href="index.html" style="color: "></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
        </button>
            
        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="index.html" class="nav-link">
            <script language="javascript" class = "mb-4">
              var today = new Date();
              document.write(today);
            </script></a></li>
          
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->
    
    <div class="hero-wrap" style="background-image: url('images/bg_1.jpg'); background-attachment:fixed;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div style="color: black; position: absolute;right: 3%;top : 0% ; font-size: 200%; color: #996699; width: 95%  ">
            <marquee scrollamount = "13">
            You have <?php echo $n["COUNT(*)"]?> appointments today!
          </marquee>
          </div>
          <div class="col-md-8 ftco-animate text-center">
            <h2 class="mb-4">Hi Dr.<?php echo $_SESSION["fname"] ." ". $_SESSION["lname"] ." !"?> </h2><span>
            <h3 class="mb-4">The art of Medicine consists in amusing the patient while nature cures the disease.</h3><span><h5 align="right">-Voltaire</h5><span>
    
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-services">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-md-4 ftco-animate py-5 nav-link-wrap">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link px-4 active" id="v-pills-fitness-tab" data-toggle="pill" href="#v-pills-fitness" role="tab" aria-controls="v-pills-fitness" aria-selected="true"><span class="mr-3 flaticon-stethoscope"></span> Search Patient</a>


              <a class="nav-link px-4 " id="v-pills-master-tab" data-toggle="pill" href="#v-pills-master" role="tab" aria-controls="v-pills-master" aria-selected="false"><span class="mr-3 flaticon-cardiogram"></span> Add Patient</a>

              

              <a class="nav-link px-4" id="v-pills-spa-tab" data-toggle="pill" href="#v-pills-spa" role="tab" aria-controls="v-pills-spa" aria-selected="false"><span class="mr-3 flaticon-ambulance"></span> Add Appointments</a>

              <a class="nav-link px-4" id="v-pills-spa-tab" data-toggle="pill" href="#v-pills-upc" role="tab" aria-controls="v-pills-spa" aria-selected="false"><span class="mr-3 flaticon-ambulance"></span> Upcoming Appointments</a>

              <a class="nav-link px-4" id="v-pills-spa-tab" data-toggle="pill" href="#v-pills-tod" role="tab" aria-controls="v-pills-spa" aria-selected="false"><span class="mr-3 flaticon-ambulance"></span> Today's Appointments</a>
            </div>
          </div>
          <div class="col-md-8 ftco-animate p-4 p-md-5 d-flex align-items-center">
            
            <div class="tab-content pl-md-5" id="v-pills-tabContent">

              <div class="tab-pane fade py-5" id="v-pills-master" role="tabpanel" aria-labelledby="v-pills-master-tab">
                <span class="icon mb-3 d-block flaticon-cardiogram"></span>
                <h2 class="mb-4">ADD PATIENT</h2>
                <p>  
            
              <form action="index.php" method="post">
                
                Name<input type="text" placeholder="name" name="PName" value="" ><br>
                <span style= "color:red"><?php echo $err ?></span><br><br>
                Age<input type="int" name="PAge" value=""><br><br>
                Gender<br>
                <div style = "text-align: left">
                  <input style = "position: absolute;" type="radio" name="gender" value="Male"><span style = "position: absolute; left : 18%">Male</span>
                  <input style = "position: absolute; left : 28%"type="radio" name="gender" value="Female">
                  <span style = "position: absolute;left : 35%">Female</span>
                  <input style = "position: absolute; left : 48%"type="radio" name="gender" value="Others">
                  <span style = "position: absolute; left : 56%">Others</span>
                </div>
                <br><br>

                Father's name<input type="text" name="PAPA" ><br><br>
                Mother's name<input type="text" name="MAMA" ><br><br>

                Phone Number<input type="tel" name="phno" ><br>
                <span style= "color:red"><?php echo $errmob ?></span><br><br>
                Address<br><textarea rows = "4" cols = "70" name="ADD" style = "border-radius: 4px; border-color: #d3d3d3;"></textarea>
                <?php include_once("buttonAdd.php");?>

          
            </form>
        </p>
               
              </div> 
              <div class="tab-pane fade show active py-5" id="v-pills-fitness" role="tabpanel" aria-labelledby="v-pills-fitness-tab">
                <span class="icon mb-3 d-block flaticon-stethoscope"></span>
                <h2 class="mb-4">Search Patient</h2>
                <p><form action="index.php" method="post">
        Search by Phone Number<input type="text" name="PName" value="" ><br><br></p>
                <div id = "error" name = "error" class = "errormessage"
                style = "color: red ">
                Patient doesn't exist!!!
                </div>
                <p>
                  <?php include_once("buttonSearch.php");?>
             
                <p><input type="submit" class="btn btn-primary" value="Patient List" name = "checkPatientList"></p>
              </div>

              <div class="tab-pane fade py-5" id="v-pills-spa" role="tabpanel" aria-labelledby="v-pills-spa-tab">
                <span class="icon mb-3 d-block flaticon-ambulance"></span>
                <h2 class="mb-4">Add Appointments</h2>

                <p>  
            
              <form action="index.php" method="post">
                
                Name<input type="text" placeholder="name" name="pname" value="" ><br>
                <span style= "color:red"><?php echo $err ?></span><br><br>
        
          
                Phone Number<input type="tel" name="phno" ><br>
                <span style= "color:red"><?php echo $errmob ?></span><br><br>
              
              Time<input type="Time" name="time" ><br>
                <span style= "color:red"></span><br><br>


                Date<input type="Date" name="date"><br>
                <span style="color:red"></span><br><br>
                <div>
                <input type="submit" name="addapp" class="btn btn-primary"value="Submit">
                </div>

          
                </form>
                </p>

                
              </div>

              <div class="tab-pane fade py-5" id="v-pills-upc" role="tabpanel" aria-labelledby="v-pills-spa-tab">
                <span class="icon mb-3 d-block flaticon-ambulance"></span>
                <h2 class="mb-4">Upcoming Appointments</h2>

                <p>  
            
                <a href="dispApp.php">View Upcoming Appointments</a>
                </p>

                
              </div>

              <div class="tab-pane fade py-5" id="v-pills-tod" role="tabpanel" aria-labelledby="v-pills-spa-tab">
                <span class="icon mb-3 d-block flaticon-ambulance"></span>
                <h2 class="mb-4">Today's Appointments</h2>

                <p>  
            
                <a href="todaysApp.php">View Today's Appointment</a>
                </p>

                
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>

  
  <script src="js1/jquery.min.js"></script>
  <script src="js1/jquery-migrate-3.0.1.min.js"></script>
  <script src="js1/popper.min.js"></script>
  <script src="js1/bootstrap.min.js"></script>
  <script src="js1/jquery.easing.1.3.js"></script>
  <script src="js1/jquery.waypoints.min.js"></script>
  <script src="js1/jquery.stellar.min.js"></script>
  <script src="js1/owl.carousel.min.js"></script>
  <script src="js1/jquery.magnific-popup.min.js"></script>
  <script src="js1/aos.js"></script>
  <script src="js1/jquery.animateNumber.min.js"></script>
  <script src="js1/bootstrap-datepicker.js"></script>
  <script src="js1/jquery.timepicker.min.js"></script>
  <script src="js1/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js1/google-map.js"></script>
  <script src="js1/main.js"></script>
    
  </body>
</html>

