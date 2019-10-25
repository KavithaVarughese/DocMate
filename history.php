<?php
  include_once("header.php");
  $result=mysqli_query($conn,"SELECT DISTINCT treatment.tid,treatment.curr_date,treatment.intake_note,treatment.treatment_note,treatment.progress_note,treatment.consultant_note,treatment.extra_note,treatment.treat_id FROM treatment INNER JOIN ptable ON treatment.treat_id='{$_SESSION["pid"]}' AND ptable.doc_id='{$_SESSION["user_id"]}'");
  echo "<table border='1' id = 'customers'>
    <tr>
      <th>Treatment Id</th>
      <th>Date</th>
      <th>Intake Note</th>
      <th>Treatment Note</th>      
      <th>Progress Note</th>
      <th>Consultant Note</th>
      <th>Extra Note</th>
      <th>Patient Id</th>
    </tr> ";
  while($row=mysqli_fetch_array($result))
  {
    echo "<tr>";
    echo "<td>".$row['tid']."</td>";
    echo "<td>".$row['curr_date']."</td>";
    echo "<td>".$row['intake_note']."</td>";
    echo "<td>".$row['treatment_note']."</td>";
    echo "<td>".$row['progress_note']."</td>";
    echo "<td>".$row['consultant_note']."</td>";
    echo "<td>".$row['extra_note']."</td>";
    echo "<td>".$row['treat_id']."</td>";
    echo "</tr>";
  }
  // unset($_SESSION["pid"]);

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
<h1 align="center">HISTORY OF VISITS</h1>
<?php echo "</table>";?>
<form action = "patient.php">
<input type="submit" name="" value="GO BACK">
</form>
</body>
</html>
