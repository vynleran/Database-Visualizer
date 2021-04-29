<?php

include 'dbConn.php';

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
            if($fileSize < 5000000){
                $userFile = fopen($fileTmpName, "r");
                $header = fgetcsv($userFile);
                $destDB = $header[0];
                // record needs to be looked at
                // record does not work and I think its
                // because of how large the file is
                // also it would be very risky to upload 
                // a file that big since it takes so much time
                if($destDB == "RecordID"){
                    while(($row = fgetcsv($userFile)) !== FALSE){
                        $query = array(0,1,2,3,4,5,6,7);

                        for($i=0;$i<count($header);$i++){
                            if($header[$i] == "RecordID"){
                                $query[0] = $row[$i];
                            }
                            else if($header[$i] == "CycleIndex"){
                                $query[1] = $row[$i];
                            }
                            else if($header[$i] == "Voltage"){
                                $query[2] = $row[$i];
                            }
                            else if($header[$i] == "SpeCapacity"){
                                $query[3] = $row[$i];
                            }
                            else if($header[$i] == "Capacity"){
                                $query[4] = $row[$i];
                            }
                            else if($header[$i] == "StepID"){
                                $query[5] = $row[$i];
                            }
                            else if($header[$i] == "StepState"){
                                $query[6] = $row[$i];
                            }
                            else if($header[$i] == "BatteryID"){
                                $query[7] = $row[$i];
                            }
                        }

                        // // should work with different testers
                        // $recordID = $row[0];
                        // $cycleIndex = $row[1];
                        // $voltage = $row[2];
                        // $specapacity = $row[3];
                        // $capacity = $row[4];
                        // $stepID = $row[5];
                        // $stepState = $row[6];
                        // $batteryID = $row[7];

                        $sql = "INSERT INTO record (recordID, cycleIndex, voltage, speCapacity, capacity, stepID, stepState, batteryID)
                                VALUES ($query[0], $query[1], $query[2], $query[3], $query[4], $query[5], $query[6], $query[7])";

                        mysqli_query($conn, $sql);
                    }
                }
                // cycle works but dont forget to add capacity to sql
                elseif($destDB == "CycleID"){
                    while(($row = fgetcsv($userFile)) !== FALSE){
                        // row is just the data in each row like
                        // [1,2,3,4,5]
                        $query = array(0,1,2,3,4,5);

                        for($i=0;$i<count($header);$i++){
                            if($header[$i] == "CycleID"){
                                $query[0] = $row[$i];
                            }
                            else if($header[$i] == "Voltage"){
                                $query[1] = $row[$i];
                            }
                            else if($header[$i] == "SpeCapacity"){
                                $query[2] = $row[$i];
                            }
                            else if($header[$i] == "Capacity"){
                                $query[3] = $row[$i];
                            }
                            else if($header[$i] == "Efficiency"){
                                $query[4] = $row[$i];
                            }
                            else if($header[$i] == "BatteryID"){
                                $query[5] = $row[$i];
                            }
                        }
                        
                        // $cycleID = $row[0];
                        // $voltage = $row[1];
                        // $specapacity = $row[2];
                        // $capacity = $row[3];
                        // $efficiency = $row[4];
                        // $batteryID = $row[5];

                        $sql = "INSERT INTO cycle (cycleID, voltage, speCapacity, efficiency, batteryID)
                                VALUES ($query[0], $query[1], $query[2], $query[4], $query[5])";

                        mysqli_query($conn, $sql);
                    }
                }
                fclose($userFile);
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