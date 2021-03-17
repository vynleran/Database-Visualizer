<?php 

// Making sure the user has submitted the form
if(isset($_POST['submit'])){
    $battery = (int) $_POST['battery']; // Battery Input element
    $cycle = $_POST['cycle'];   // Cycle input element
    $xVar = $_POST['X'];    // X variable
    $yVar = $_POST['Y'];    // Y variable
    $discharge = (isset($_POST['discharge']) ? $_POST['discharge'] : '');  // Discharge checkbox
    $charge = (isset($_POST['charge']) ? $_POST['charge'] : '');  // Charge checkbox

    // put all of those numbers in an array after splitting them
    // loop the array and write different queries to get the data
    // put all of that data in an associative array like
        // x -> y | x1 -> y1
    // send two arrays of x and y to the frontend
    // run three nested for loops in the frontend for putting thing in the data array

    $xArray = array();
    $yArray = array();

    if(isset($charge)){
        // splitting the user input for cycle
        $cycleString = strval($cycle);
        $cycleArray = explode(",", $cycleString);

        for($i=0;$i<count($cycleArray);$i++){
            // MySQL Query for the X variable
            $mySqlQueryX = "SELECT $xVar
                            FROM record
                            WHERE cycleIndex = $cycleArray[$i] 
                            AND (stepState = 'CCC' or stepState = 'CVC') 
                            AND BatteryID = $battery;";

            // MySQL Query for the Y variable
            $mySqlQueryY = "SELECT $yVar 
                            FROM record
                            WHERE cycleIndex = $cycleArray[$i] 
                            AND (stepState = 'CCC' or stepState = 'CVC') 
                            AND BatteryID = $battery;";

            // Getting the X variable results from the database
            $resultX = mysqli_query($conn, $mySqlQueryX);

            $dataX = '';
            $dataY = '';

            // Fetch the Y data into an assoctiative array
            // and print all of them
            if($xVar == "Capacity"){
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
            if($yVar == "Capacity"){
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

            $dataX = trim($dataX,",");
            $dataY = trim($dataY,",");

            array_push($xArray, $dataX);
            array_push($yArray, $dataY);

            // Free Y result set
            mysqli_free_result($resultY);
        }
    }

    if(isset($discharge)){
        // splitting the user input for cycle
        $cycleString = strval($cycle);
        $cycleArray = explode(",", $cycleString);

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

            $dataX = '';
            $dataY = '';

            // Fetch the Y data into an assoctiative array
            // and print all of them
            if($xVar == "Capacity"){
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
            if($yVar == "Capacity"){
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

            $dataX = trim($dataX,",");
            $dataY = trim($dataY,",");

            array_push($xArray, $dataX);
            array_push($yArray, $dataY);

            // Free Y result set
            mysqli_free_result($resultY);
        }
    }
    print(json_encode($xArray, JSON_FORCE_OBJECT));
    json_encode($yArray);
}
?>