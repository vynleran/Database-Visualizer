<?php 

$xArray = array();
$yArray = array();

// Making sure the user has submitted the form
if(isset($_POST['submit'])){
    $battery = (int) $_POST['battery']; // Battery Input element
    $cycle = $_POST['cycle'];   // Cycle input element
    $xVar = $_POST['X'];    // X variable
    $yVar = "voltage";    // Y variable
    $discharge = isset($_POST['discharge']) && $_POST['discharge']  ? "1" : "0";  // Discharge checkbox
    $charge = isset($_POST['charge']) && $_POST['charge']  ? "1" : "0";  // Charge checkbox

    // put all of those numbers in an array after splitting them
    // loop the array and write different queries to get the data
    // put all of that data in an associative array like
        // x -> y | x1 -> y1
    // send two arrays of x and y to the frontend
    // run three nested for loops in the frontend for putting thing in the data array

    if(isset($charge)){
        // splitting the user input for cycle
        // $cycleString = strval($cycle);
        $cycleArray = explode(",", $cycle);

        for($i=0;$i<count($cycleArray);$i++){
            // MySQL Query for the X variable
            $mySqlQueryX = "SELECT $xVar
                            FROM record
                            WHERE cycleIndex = $cycleArray[$i] 
                            AND (stepState = 'CCC' or stepState = 'CVC') 
                            AND BatteryID = $battery;";

            // MySQL Query for the Y variable
            $mySqlQueryY = "SELECT voltage
                            FROM record
                            WHERE cycleIndex = $cycleArray[$i] 
                            AND (stepState = 'CCC' or stepState = 'CVC') 
                            AND BatteryID = $battery;";

            // Getting the X variable results from the database
            $resultX = mysqli_query($conn, $mySqlQueryX);

            $dataX = array();
            $dataY = array();

            // Fetch the Y data into an assoctiative array
            // and print all of them
            while($row = mysqli_fetch_array($resultX)){
                array_push($dataX, $row[$xVar]);        
            }

            // Free X result set
            mysqli_free_result($resultX);

            // Getting the Y variable results from the database
            $resultY = mysqli_query($conn, $mySqlQueryY);

            // Fetch the Y data into an assoctiative array
            // and print all of them
            while($row = mysqli_fetch_array($resultY)){
                array_push($dataY, $row[$yVar]);        
            }

            array_push($xArray, $dataX);
            array_push($yArray, $dataY);

            // Free Y result set
            mysqli_free_result($resultY);
        }
    }

    if(isset($discharge)){
        // splitting the user input for cycle
        // $cycleString = strval($cycle);
        $cycleArray = explode(",", $cycle);

        for($i=0;$i<count($cycleArray);$i++){
            // MySQL Query for the X variable
            $mySqlQueryX = "SELECT $xVar
                            FROM record
                            WHERE cycleIndex = $cycleArray[$i] 
                            AND (stepState = 'CCD') 
                            AND BatteryID = $battery;";

            // MySQL Query for the Y variable
            $mySqlQueryY = "SELECT $yVar 
                            FROM record
                            WHERE cycleIndex = $cycleArray[$i] 
                            AND (stepState = 'CCD') 
                            AND BatteryID = $battery;";

            // Getting the X variable results from the database
            $resultX = mysqli_query($conn, $mySqlQueryX);

            $dataX = array();
            $dataY = array();

            // Fetch the Y data into an assoctiative array
            // and print all of them
            while($row = mysqli_fetch_array($resultX)){
                array_push($dataX, $row[$xVar]);        
            }

            // Free X result set
            mysqli_free_result($resultX);

            // Getting the Y variable results from the database
            $resultY = mysqli_query($conn, $mySqlQueryY);

            // Fetch the Y data into an assoctiative array
            // and print all of them
            while($row = mysqli_fetch_array($resultY)){
                array_push($dataY, $row[$yVar]);        
            }

            array_push($xArray, $dataX);
            array_push($yArray, $dataY);

            // Free Y result set
            mysqli_free_result($resultY);
        }
    }
    json_encode($xArray);
    json_encode($yArray);
}
?>