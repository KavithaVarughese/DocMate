<?php
    //create the tables
    //users
    $q = "CREATE TABLE IF NOT EXISTS users (";
    $q .= "id INT PRIMARY KEY AUTO_INCREMENT,";
    $q .= "email VARCHAR(50) NOT NULL,";
    $q .= "password VARCHAR(40) NOT NULL,";
    $q .= "fname VARCHAR(25) NOT NULL,";
    $q .= "lname VARCHAR(25),";
    $q .= "mob VARCHAR(10))";

    $conn->query($q) or die("User Table Create error -> " . $conn->error);


    //patients
    $q = "CREATE TABLE IF NOT EXISTS ptable (";
    $q .= "pid INT PRIMARY KEY AUTO_INCREMENT,";
    $q .= "pname VARCHAR(40),";
    $q .= "page INT,";
    $q .= "gender VARCHAR(10),";
    $q .= "papa VARCHAR(50),";
    $q .= "mama VARCHAR(50),";
    $q .= "PhNo VARCHAR(10) NOT NULL,";
    $q .= "addr VARCHAR(200),";
    $q .= "doc_id INT NOT NULL,";
    $q .= "FOREIGN KEY (doc_id) REFERENCES users (id) ON DELETE CASCADE)";

    $conn->query($q) or die("Patient Table Create error -> " . $conn->error);

    $q = "ALTER TABLE ptable AUTO_INCREMENT = 100";

    $conn->query($q) or die("Patient Table increment error -> " . $conn->error);

    //treatment
    $q = "CREATE TABLE IF NOT EXISTS treatment (";
    $q .= "tid INT PRIMARY KEY AUTO_INCREMENT,";
    $q .= "curr_date DATE,";
    $q .= "intake_note VARCHAR(300),";
    $q .= "treatment_note VARCHAR(300),";
    $q .= "progress_note VARCHAR(300),";
    $q .= "consultant_note VARCHAR(300),";
    $q .= "extra_note VARCHAR(300),";
    $q .= "treat_id INT NOT NULL,";
    $q .= "FOREIGN KEY (treat_id) REFERENCES ptable (pid) ON DELETE CASCADE)";

    $conn->query($q) or die("Treatment Table Create error -> " . $conn->error);

    $q = "ALTER TABLE treatment AUTO_INCREMENT = 10000";

    $conn->query($q) or die("Treatment Table increment error -> " . $conn->error);

    //treatment
    $q = "CREATE TABLE IF NOT EXISTS appointment (";
    $q .= "aid INT PRIMARY KEY AUTO_INCREMENT,";
    $q .= "aname VARCHAR(40),";
    $q .= "app_date DATE,";
    $q .= "app_time TIME,";
    $q .= "doctor_id INT NOT NULL,";
    $q .= "FOREIGN KEY (doctor_id) REFERENCES users (id) ON DELETE CASCADE,";
    $q .= "patient_id INT NOT NULL,";
    $q .= "FOREIGN KEY (patient_id) REFERENCES ptable (pid) ON DELETE CASCADE)";

    $conn->query($q) or die("Appointment Table Create error -> " . $conn->error);

    $q = "ALTER TABLE appointment AUTO_INCREMENT = 1000000";

    $conn->query($q) or die("Appointment Table increment error -> " . $conn->error);
?>
