<?php
    session_start();
    if ($_SESSION["usergroup"] !== 1)
    {
        header("Location:./index.php"); 
        die();
    }
    
    $courseName = $_GET["courseName"];
    
    include "./php/DatabaseFunctions.php";
    
    getCourseDetail($courseName);
?>