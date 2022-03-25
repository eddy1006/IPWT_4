<?php
$insert = "";
if (isset($_POST['name'])) {
    $server = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($server, $username, $password, "seat_allocation");

    if (!$conn) {
        die("Connected successfully" . mysqli_connect_error());
    }

    $name = $_POST['name'];
    $id = $_POST['application_id'];
    $cutoff = $_POST['cutoff'];
    $course = $_POST['course'];

    if (($cutoff < 100 && $course == "Computer Science") || ($cutoff < 80 && $course == "Electrical and Electronics Eng")) {
        $insert  =  "<br><p style='text-align : center; font-size : 20px; color : red;'>Branch not available for given scored marks</p><br>";
    } else {
        $q1 = "SELECT * FROM `courses` WHERE course_name ='$course'";
        $result = mysqli_query($conn, $q1);
        while ($res = mysqli_fetch_array($result)) {
            if ($res[1] == $res[2]) {
                $insert =  "<p style='text-align : center; font-size : 20px; color : red'>Seat not available</p>";
            } else {
                $query = "INSERT INTO `student` (`name`, `application_id`, `cut_off`, `course`) VALUES ('$name', '$id', '$cutoff', '$course');";
                if ($conn->query($query) == true) {
                    //echo "Data Successfully Inserted";
                    $insert = "<br><p style='text-align : center; font-size : 20px; color : green;'>Congratualtions! Seat successfully allocated</p><br>";
                } else {
                    echo "Something went wrong";
                }

                $q2 = "UPDATE `courses` SET booked = booked + 1 WHERE course_name = '$course';";
                if ($conn->query($q2) != true) {
                    echo "<br>Cant update seats something went wrong!";
                }
            }
        }
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIT Seat Allocation</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Welcome to VIT Seat Allocation procedure</h1>
    <p id="table"></p>
    <h2>Fill in your details :</h2><br>
    <form action="index.php" method="post" id="form1">
        <input type="text" name="name" id="name" placeholder="Enter your name">
        <input type="text" name="application_id" id="application_id" placeholder="Enter your application_id">
        <input type="number" name="cutoff" id="cutoff" placeholder="Enter marks scored in VITEEE">
        <!-- <input type="text" name="course" id="course" placeholder="Enter the course"> -->
        <label for="course">Select a branch : </label>
        <select id="course" name="course">
            <option> Computer Science</option>
            <option> Electrical and Electronics Eng </option>
            <option> Electronics and Communication </option>
            <option> Civil Engineering </option>
            <option> Mechanical Engineering </option>
            <option> Chemical Engineering </option>
            <option> Biotechnology </option>
        </select>
        <input type="submit" value="Submit">
    </form>
    <?php
        echo $insert;
    ?>
    <img src="https://peopleorbit.vit.ac.in/images/VIT-New-Logo.jpg" alt="vit_logo">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="index.js"></script>
</body>

</html>