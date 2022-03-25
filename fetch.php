<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
  background-color: #3CB043;
}

th {text-align: left; background-color: #23395d; color: white;}
</style>
</head>
<body>
<?php
    $server = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($server,$username,$password,"seat_allocation");

    if(!$conn){
       echo "Connection to db failed";
    } 

    $query = "SELECT * FROM `courses`";
    $result = mysqli_query($conn,$query);

    echo "<table>
            <tr>
            <th>Branch Name</th>
            <th>Total seats</th>
            <th>Booked</th>
            <th>Available</th>
            <th>Campus</th>
            </tr>";
    while($res = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" . $res[0] . "</td>";
        echo "<td>" . $res[1] . "</td>";
        echo "<td>" . $res[2] . "</td>";
        if($res[1]-$res[2] == 0){
          echo "<td style = 'background-color : red;'>"."<strong>NIL</strong>"."</td>";
        }else{
          echo "<td>" . $res[1]-$res[2] . "</td>";
        }
        echo "<td>" . "Vellore" . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    $conn->close();

?>
</body>
</html>