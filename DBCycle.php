<?php

if(isset($_POST['submit'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileTmpName = $_FILES['file']['tmp_name'];

    $fileExt = explode('.', $fileName);
    $fileExtLower = strtolower(end($fileExt)); 

    $allowed = array('csv');

    if(in_array($fileExtLower, $allowed)){
        if($fileError === 0){
            if($fileSize < 500000){
                // $fileNameNew = uniqid('', true).".".$fileExtLower;
                // $fileDestination = 'uploads/'.$fileNameNew;
                // move_uploaded_file($fileTmpName, $fileDestination);
                // echo "upload succesful";
                // open the file here using fopen
                // assign each csv row with an associative array
                // get each one of those values in the array
                // insert them into the database
                header("Location: index.php?uploadsuccess");
            } else{
                echo "File size is too big.";
            }
        } else{
            echo "There was an error with your file.";
        }
    } else{
        echo "This file type is not allowed.";
    }
}
?>