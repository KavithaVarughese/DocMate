<?php
  include_once("header.php");

  
  $result=mysqli_query($conn,"SELECT pid,pname,page,gender,papa,mama,PhNo FROM ptable where doc_id = '{$_SESSION["user_id"]}'");
  unset($_SESSION["pid"]);
  echo "<table border='1' id = 'customers'>
    <tr>
      <th>Patient Id</th>
      <th>Patient Name</th>
      <th>Patient Age</th>
      <th>Patient Gender</th>      
      <th>Patient Father</th>
      <th>Patient Mother</th>
      <th>Patient Phone Number</th>

    </tr> ";

  while($row=mysqli_fetch_array($result))
  {
    echo "<tr>";
    echo "<td>".$row['pid']."</td>";
    echo "<td>".$row['pname']."</td>";
    echo "<td>".$row['page']."</td>";
    echo "<td>".$row['gender']."</td>";
    echo "<td>".$row['papa']."</td>";
    echo "<td>".$row['mama']."</td>";
    echo "<td>".$row['PhNo']."</td>";
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
  <h1 align="center">PATIENT LIST</h1>
<?php echo "</table>";?>
<form action = "index.php">
<input type="submit" name="" value="GO BACK">
</form>
</body>
</html>
