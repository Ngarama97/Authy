<?php

session_start();

//create a database with name crud with 3 columns ID, NAME, COURSE

$db = mysqli_connect('localhost', 'root',  '', 'crud');

// initialize the variables 
$name = "";
$course = "";
$id = 0;
$update = false;

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $course = $_POST['course'];

    // if the user inputs the details put the data in DB
    mysqli_query($db, "INSERT INTO users (name, course) VALUES ('$name', '$course')");
    $_SESSION['message'] = "Course is created";
    header("location:index.php");
}
//get the id from the form and delete the entire row from DB

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($db, "DELETE FROM users WHERE id = $id");
    $_SESSION['message'] = "Your course is Delete";
    header("location: index.php");
}

// update the info in the DB
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $course = $_POST['course'];
    $id = $_POST['id'];

    mysqli_query($db, "UPDATE users SET name ='$name', course = '$course' WHERE id = '$id'");
    $_SESSION['message'] = "The information is Updated";
    header("location: index.php");
}
