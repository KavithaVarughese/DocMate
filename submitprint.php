<?php
  include_once("header.php");

  
  $result=mysqli_query($conn,"SELECT tid,intake_note,treatment_note,progress_note,consultant_note,extra_note FROM treatment ORDER BY tid DESC LIMIT 1");
  unset($_SESSION["pid"]);
  echo "<table border='1' id = 'customers'>
    <tr>
      <th>Treatment Id</th>
      <th>Intake Notes</th>
      <th>Treatment Notes</th>
      <th>Progress Notes</th>        
      <th>Consultant Notes</th>
      <th>Extra Note</th>

    </tr> ";

  while($row=mysqli_fetch_array($result))
  {
    echo "<tr>";
    echo "<td>".$row['tid']."</td>";
    echo "<td>".$row['intake_note']."</td>";
    echo "<td>".$row['treatment_note']."</td>";
    echo "<td>".$row['progress_note']."</td>";
    echo "<td>".$row['consultant_note']."</td>";
    echo "<td>".$row['extra_note']."</td>";
    echo "</tr>";
  }
echo "</table>";
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
<form action = "index.php">
<input type="submit" name="" value="GO BACK">
</form>
<form action = "deletetreatment.php">
<input type="submit" name="" value="DELETE">
</form>
<form action = "index.php">
<input type="submit" name="" value="SET NEXT APPOINTMENT">
</form>
</body>
</html>
