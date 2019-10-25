<?php
  include_once("header.php");

  
  $result=mysqli_query($conn,"SELECT aid,aname,app_date,app_time,patient_id FROM appointment where doctor_id = '{$_SESSION["user_id"]}' ORDER BY app_date,app_time");
  unset($_SESSION["pid"]);
  echo "<table border='1' id = 'customers'>
    <tr>
      <th>appointment Id</th>
      <th>Patient Name</th>
      <th>Date</th>
      <th>Time</th>        
      <th>Patient Id</th>

    </tr> ";

  while($row=mysqli_fetch_array($result))
  {
    echo "<tr>";
    echo "<td>".$row['aid']."</td>";
    echo "<td>".$row['aname']."</td>";
    echo "<td>".$row['app_date']."</td>";
    echo "<td>".$row['app_time']."</td>";
    echo "<td>".$row['patient_id']."</td>";
    echo "</tr>";
  }

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(odd){background-color: #ccffff;}
#customers tr:nth-child(even){background-color: #e6ffff;}


#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #003366;
    color: white;
}
</style>
</head>
<body>
<h1 align="center">ALL APPOINTMENTS</h1>
<?php echo "</table>";?>
<form action = "index.php">
<input type="submit" name="" value="GO BACK">
</form>
</body>
</html>
