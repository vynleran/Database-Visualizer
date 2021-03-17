<?php 

// Making sure the user has submitted the form
if(isset($_POST['submit'])){
    $battery = (int) $_POST['battery']; // Battery Input element
    $cycle = $_POST['cycle'];   // Cycle input element
    $xVar = $_POST['X'];    // X variable
    $yVar = $_POST['Y'];    // Y variable
    $y2Var = $_POST['Y1'];    // Y1 variable

    // put all of those numbers in an array after splitting them
    // loop the array and write different queries to get the data
    // put all of that data in an associative array like
        // x -> y | x1 -> y1
    // send the associative array to the frontend
    // run a loop there too and have multiple graphs(objects)

    // In case of the first graphing graph A
    $cycleInt = (int) $cycle;
    // MySQL Query for the X variable
    $mySqlQueryX = "SELECT $xVar
                    FROM cycle
                    WHERE CycleID <= $cycleInt AND batteryID = $battery;";

    // MySQL Query for the Y variable
    $mySqlQueryY = "SELECT $yVar 
                    FROM cycle 
                    WHERE CycleID <= $cycleInt AND batteryID = $battery;";

    // MySQL Query for the second Y variable
    $mySqlQueryY2 = "SELECT $y2Var 
                    FROM cycle 
                    WHERE CycleID <= $cycleInt AND batteryID = $battery;";

    // Getting the X variable results from the database
    $resultX = mysqli_query($conn, $mySqlQueryX);

    $dataX = '';
    $dataY = '';
    $dataY2 = '';

    // Fetch the X data into an assoctiative array
    // and print all of them
    if($xVar == "CycleID"){
        while($row = mysqli_fetch_array($resultX)){
            $dataX = $dataX . '"'. $row['CycleID'].'",';    
        }
    }

    elseif($xVar == "Capacity"){
        while($row = mysqli_fetch_array($resultX)){
            $dataX = $dataX . '"'. $row['Capacity'].'",';       
        }
    }
    
    elseif($xVar == "SpeCapacity"){
        while($row = mysqli_fetch_array($resultX)){
            $dataX = $dataX . '"'. $row['SpeCapacity'].'",';        
        }
    }
    
    elseif($xVar == "Voltage"){
        while($row = mysqli_fetch_array($resultX)){
            $dataX = $dataX . '"'. $row['Voltage'].'",';        
        }
    }

    // Free X result set
    mysqli_free_result($resultX);

    // Getting the Y variable results from the database
    $resultY = mysqli_query($conn, $mySqlQueryY);

    // Fetch the Y data into an assoctiative array
    // and print all of them
    if($yVar == "Efficiency"){
        while($row = mysqli_fetch_array($resultY)){
            $dataY = $dataY . '"'. $row['Efficiency'].'",';        
        }
    }
    
    elseif($yVar == "Capacity"){
        while($row = mysqli_fetch_array($resultY)){
            $dataY = $dataY . '"'. $row['Capacity'].'",';        
        }
    }
    
    elseif($yVar == "SpeCapacity"){
        while($row = mysqli_fetch_array($resultY)){
            $dataY = $dataY . '"'. $row['SpeCapacity'].'",';        
        }
    }
    
    elseif($yVar == "Voltage"){
        while($row = mysqli_fetch_array($resultY)){
            $dataY = $dataY . '"'. $row['Voltage'].'",';        
        }
    }

    // Getting the Y variable results from the database
    $resultY2 = mysqli_query($conn, $mySqlQueryY2);

    // Fetch the Y data into an assoctiative array
    // and print all of them
    if($y2Var == "Efficiency"){
        while($row = mysqli_fetch_array($resultY2)){
            $dataY2 = $dataY2 . '"'. $row['Efficiency'].'",';        
        }
    }
    
    elseif($y2Var == "Capacity"){
        while($row = mysqli_fetch_array($resultY2)){
            $dataY2 = $dataY2 . '"'. $row['Capacity'].'",';        
        }
    }
    
    elseif($y2Var == "SpeCapacity"){
        while($row = mysqli_fetch_array($resultY2)){
            $dataY2 = $dataY2 . '"'. $row['SpeCapacity'].'",';        
        }
    }
    
    elseif($y2Var == "Voltage"){
        while($row = mysqli_fetch_array($resultY2)){
            $dataY2 = $dataY2 . '"'. $row['Voltage'].'",';        
        }
    }

    $dataX = trim($dataX,",");
    $dataY = trim($dataY,",");
    $dataY2 = trim($dataY2,",");

    // Free Y result set
    mysqli_free_result($resultY);
    mysqli_free_result($resultY2);

}
?>