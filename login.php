<?php
    include_once("header.php");

    if(isloggedin())
    {
        header("Location: index.php");
    }

    $e = FALSE;
    $err = "";
    $errname = "";

    if(isset($_POST["register"]))
    {
        $username = trim($_POST["username"]);
        $password = $_POST["password"];
        $fname = trim($_POST["fname"]);
        $lname = trim($_POST["lname"]);
        $mob = trim($_POST["mobile"]);

        $e = empty($username) || empty($password) || empty($fname);
        if($e)
            $errnames .= "Fill the required fields. ";
        $e = $e || !filter_var($username, FILTER_VALIDATE_EMAIL);
        if(!filter_var($username, FILTER_VALIDATE_EMAIL))
            $erremail .= "Enter your NITC email address correctly. ";      
        
        if(!$e)
        {
            $q = "INSERT INTO users (email, password, fname, lname, mob) VALUES (?, SHA(?), ?, ?, ?)";
            $query = $conn->prepare($q) or die("error - " . $conn->error);
            $query->bind_param("sssss", $username, $password, $fname, $lname, $mob) or die("error - " . $conn->error);

            $query->execute() or die("error - " . $conn->error);

            if($conn->affected_rows == 1)
            {
                $_SESSION["username"] = $username;
                $_SESSION["fname"] = $fname;
                $_SESSION["lname"] = $lname;
                $_SESSION["user_id"] = $conn->insert_id;
                header("Location:http://localhost/neema/index.php");
            }
            $query->close();
        }
    }

    if(isset($_POST["login"]))
    {
        $username = trim($_POST["username"]);
        $password = $_POST["password"];

        $e = empty($username) || empty($password);
        if($e)
        {
            $errname = "Username / Password cannot be empty. ";
        }
        else
        {
            $id = 0;
            $fname = "";
            $lname = "";
            $q = "SELECT id, fname, lname FROM users WHERE email = ? AND password = SHA(?)";
            $query = $conn->prepare($q) or die("error1 - " . $conn->error);
            $query->bind_param("ss", $username, $password) or die("error2 - " . $conn->error);

            $query->execute() or die("error - " . $conn->error);

            $query->store_result();

            $query->bind_result($id, $fname, $lname) or die("error - " . $conn->error);
            $query->fetch() or die("error - " . $conn->error);

            if($query->num_rows == 1)
            { 
                $_SESSION["username"] = $username;
                $_SESSION["fname"] = $fname;
                $_SESSION["lname"] = $lname;
                $_SESSION["user_id"] = $id;
                header("Location:index.php");
            }

            else
            {
                $e = TRUE;
                $err = "Username & Password does not match. ";
            }

            $query->close();
        }
    }
?>


    
        <?php
            if($e)
            {
                echo '<div id="error"><p><b>'. $err . '<b></p></div>';
            }
        ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login V16</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="css1/flaticon.css">
<!--===============================================================================================-->
</head>
    <body>
        
        <div class="limiter">

            <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <a style = "position: absolute; top : 13%; left : 35% ; font-size: 300% ; color: #ff69b4  "class="navbar-brand" href="index.html"><i class="flaticon-pharmacy"></i><span>DOC</span>MATE</a>
                <span class="login100-form-title p-b-41" style="position: absolute; top: 25%; right: 53%">
                    Account Login
                </span>

                <span class="login100-form-title p-b-41" style="position: absolute; right : 25%; top : 14%">
                    Register
                </span>

                <form action = "login.php" method = "post" class="login100-form validate-form p-b-33 p-t-5 " style = "position: absolute; top : 30%; right : 40%">

                    <div class="wrap-input100 validate-input" data-validate = "Enter username">
                        <input class="input100" type="email" name="username" placeholder="Email">
                        <span class="focus-input100" data-placeholder="&#xe82a;" style="color: red"><?php echo $errname;?></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-32">
                        <input type = "submit" name= "login" value = "Login" class="login100-form-btn">
                        
                    </div>

                </form>
                
                <form action = "login.php" method = "post"class="login100-form validate-form p-b-33 p-t-5" style="position: absolute;right : 5%; top : 20%">

                    <div class="wrap-input100 validate-input" data-validate = "Enter username">
                        <input class="input100" type="email" name="username" placeholder="Email">
                        <span class="focus-input100" data-placeholder="&#xe82a;" style="color: red"><?php echo $errnames; echo $erremail;?></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Enter username">
                        <input class="input100" type="text" name="fname" placeholder="First Name">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Enter username">
                        <input class="input100" type="text" name="lname" placeholder="Last Name">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Enter username">
                        <input class="input100" type="tel" name="mobile" placeholder="Phone Number">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-32" >
                        <input type = "submit" name ="register" value = "register" class="login100-form-btn ">
                          
                        
                    </div>

                </form>
            </div>
        </div>
    </div>
    </body>
</html>
