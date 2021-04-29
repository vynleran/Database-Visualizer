<?php 

$xArray = array();
$yArray = array();
$y2Array = array();

if(isset($_POST['submit'])){
    $battery = $_POST['battery']; // Battery Input element
    $cycle = 100;
    $xVar = "CycleID";    // X variable
    $yVar = $_POST['Y'];    // Y variable
    $y2Var = $_POST['Y1'];    // Y1 variable

    // In case of the first graphing graph A
    //$cycleInt = (int) $cycle;
    // MySQL Query for the X variable

    // split the cycles into an array
    // put a for loop in here
    // change $battery to an index in the array
    // store everything in associative arrays
    // send those arrays to the frontend
    // do a loop to insert the data objects into the data array
    
    $batArray = explode(",", $battery);

    for($i=0;$i<count($batArray);$i++){
        $mySqlQueryX = "SELECT $xVar
                    FROM cycle
                    WHERE batteryID = $batArray[$i];";

        // MySQL Query for the Y variable
        $mySqlQueryY = "SELECT $yVar 
                        FROM cycle 
                        WHERE batteryID = $batArray[$i];";

        // MySQL Query for the second Y variable
        $mySqlQueryY2 = "SELECT $y2Var
                        FROM cycle 
                        WHERE batteryID = $batArray[$i];";

        // Getting the X variable results from the database
        $resultX = mysqli_query($conn, $mySqlQueryX);

        // $dataX = '';
        // $dataY = '';
        // $dataY2 = '';

        $dataX = array();
        $dataY = array();
        $dataY2 = array();
        
        // Fetch the X data into an assoctiative array
        // and print all of them
        if($xVar == "CycleID"){
            while($row = mysqli_fetch_array($resultX)){
                array_push($dataX, $row['CycleID']);    
            }
        }

        // elseif($xVar == "Capacity"){
        //     while($row = mysqli_fetch_array($resultX)){
        //         $dataX = $dataX . '"'. $row['Capacity'].'",';       
        //     }
        // }
        
        // elseif($xVar == "SpeCapacity"){
        //     while($row = mysqli_fetch_array($resultX)){
        //         $dataX = $dataX . '"'. $row['SpeCapacity'].'",';        
        //     }
        // }
        
        // elseif($xVar == "Voltage"){
        //     while($row = mysqli_fetch_array($resultX)){
        //         $dataX = $dataX . '"'. $row['Voltage'].'",';        
        //     }
        // }

        // Free X result set
        mysqli_free_result($resultX);

        // Getting the Y variable results from the database
        $resultY = mysqli_query($conn, $mySqlQueryY);

        // Fetch the Y data into an assoctiative array
        // and print all of them
        // if($yVar == "Efficiency"){
        //     while($row = mysqli_fetch_array($resultY)){
        //         $dataY = $dataY . '"'. $row['Efficiency'].'",';        
        //     }
        // }
        
        if($yVar == "Capacity"){
            while($row = mysqli_fetch_array($resultY)){
                array_push($dataY, $row['Capacity']);        
            }
        }
        
        elseif($yVar == "SpeCapacity"){
            while($row = mysqli_fetch_array($resultY)){
                // $dataY = $dataY . '"'. $row['SpeCapacity'].'",';
                array_push($dataY, $row['SpeCapacity']);        
            }
        }
        
        // elseif($yVar == "Voltage"){
        //     while($row = mysqli_fetch_array($resultY)){
        //         $dataY = $dataY . '"'. $row['Voltage'].'",';        
        //     }
        // }

        // Getting the Y variable results from the database
        $resultY2 = mysqli_query($conn, $mySqlQueryY2);

        // Fetch the Y data into an assoctiative array
        // and print all of them
        if($y2Var == "Efficiency"){
            while($row = mysqli_fetch_array($resultY2)){
                // $dataY2 = $dataY2 . '"'. $row['Efficiency'].'",';    
                array_push($dataY2, $row['Efficiency']);    
            }
        }
        
        elseif($y2Var == "Capacity"){
            while($row = mysqli_fetch_array($resultY2)){
                // $dataY2 = $dataY2 . '"'. $row['Capacity'].'",'; 
                array_push($dataY2, $row['Capacity']);       
            }
        }
        
        // elseif($y2Var == "SpeCapacity"){
        //     while($row = mysqli_fetch_array($resultY2)){
        //         $dataY2 = $dataY2 . '"'. $row['SpeCapacity'].'",';        
        //     }
        // }
        
        // elseif($y2Var == "Voltage"){
        //     while($row = mysqli_fetch_array($resultY2)){
        //         $dataY2 = $dataY2 . '"'. $row['Voltage'].'",';        
        //     }
        // }

        // $dataX = trim($dataX,",");
        // $dataY = trim($dataY,",");
        // $dataY2 = trim($dataY2,",");

        array_push($xArray, $dataX);
        array_push($yArray, $dataY);
        array_push($y2Array, $dataY2);

        // Free Y result set
        mysqli_free_result($resultY);
        mysqli_free_result($resultY2);
    }
    json_encode($xArray);
    json_encode($yArray);
    json_encode($y2Array);
}
?>