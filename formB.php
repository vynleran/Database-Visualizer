<?php 

// Making sure the user has submitted the form
if(isset($_POST['submit'])){
    $graphA = (isset($_POST['A']) ? $_POST['A'] : '');  // Graph A checkbox
    $graphB = (isset($_POST['B']) ? $_POST['B'] : '');  // Graph B checkbox
    $battery = (int) $_POST['battery']; // Battery Input element
    $cycle = $_POST['cycle'];   // Cycle input element
    $xVar = $_POST['X'];    // X variable
    $yVar = $_POST['Y'];    // Y variable
    $discharge = (isset($_POST['discharge']) ? $_POST['discharge'] : '');  // Discharge checkbox
    $charge = (isset($_POST['charge']) ? $_POST['charge'] : '');  // Charge checkbox

    // In case of wanting to graph B
    if(isset($graphB)){ // this causes graph A to not work

        if(isset($charge)){
            // splitting the user input for cycle
            $cycleString = strval($cycle);
            $cycleArray = explode(",", $cycleString);
            //for($i=0;$i<count($cycleArray);$i++){
                // MySQL Query for the X variable
                $mySqlQueryX = "SELECT $xVar
                                FROM record
                                WHERE cycleIndex = $cycleArray[0] AND (stepState = 'CCC' or stepState = 'CVC');";

                // MySQL Query for the Y variable
                $mySqlQueryY = "SELECT $yVar 
                                FROM record
                                WHERE cycleIndex = $cycleArray[0] AND (stepState = 'CCC' or stepState = 'CVC');";

                // Getting the X variable results from the database
                $resultX = mysqli_query($conn, $mySqlQueryX);

                $dataX = '';
                $dataY = '';

                // Fetch the Y data into an assoctiative array
                // and print all of them
                if($xVar == "cap"){
                    while($row = mysqli_fetch_array($resultX)){
                        $dataX = $dataX . '"'. $row['cap'].'",';       
                    }   
                }

                elseif($xVar == "speCap"){
                    while($row = mysqli_fetch_array($resultX)){
                        $dataX = $dataX . '"'. $row['speCap'].'",';        
                    }
                }

                elseif($xVar == "voltage"){
                    while($row = mysqli_fetch_array($resultX)){
                        $dataX = $dataX . '"'. $row['voltage'].'",';        
                    }
                }

                // Free X result set
                mysqli_free_result($resultX);

                // Getting the Y variable results from the database
                $resultY = mysqli_query($conn, $mySqlQueryY);

                // Fetch the Y data into an assoctiative array
                // and print all of them
                if($yVar == "cap"){
                    while($row = mysqli_fetch_array($resultY)){
                        $dataY = $dataY . '"'. $row['cap'].'",';        
                    }
                }

                elseif($yVar == "speCap"){
                    while($row = mysqli_fetch_array($resultY)){
                        $dataY = $dataY . '"'. $row['speCap'].'",';        
                    }
                }

                elseif($yVar == "voltage"){
                    while($row = mysqli_fetch_array($resultY)){
                        $dataY = $dataY . '"'. $row['voltage'].'",';        
                    }
                }

                $dataX = trim($dataX,",");
                $dataY = trim($dataY,",");

                // $key = $i + 1;
                // $chargeX[$key] = $dataX;
                // $chargeY[$key] = $dataY;

                // Free Y result set
                mysqli_free_result($resultY);

                // echo $i."X is ".$dataX."<br>";
                // echo $i."Y is ".$dataY."<br>";

                $mySqlQueryX1 = "SELECT $xVar
                                FROM record
                                WHERE cycleIndex = $cycleArray[1] AND (stepState = 'CCC' or stepState = 'CVC');";

                // MySQL Query for the Y variable
                $mySqlQueryY1 = "SELECT $yVar 
                                FROM record
                                WHERE cycleIndex = $cycleArray[1] AND (stepState = 'CCC' or stepState = 'CVC');";

                // Getting the X variable results from the database
                $resultX1 = mysqli_query($conn, $mySqlQueryX1);

                $dataX1 = '';
                $dataY1 = '';

                // Fetch the Y data into an assoctiative array
                // and print all of them
                if($xVar == "cap"){
                    while($row1 = mysqli_fetch_array($resultX1)){
                        $dataX1 = $dataX1 . '"'. $row1['cap'].'",';       
                    }   
                }

                elseif($xVar == "speCap"){
                    while($row1 = mysqli_fetch_array($resultX1)){
                        $dataX1 = $dataX1 . '"'. $row1['speCap'].'",';        
                    }
                }

                elseif($xVar == "voltage"){
                    while($row1 = mysqli_fetch_array($resultX1)){
                        $dataX1 = $dataX1 . '"'. $row1['voltage'].'",';        
                    }
                }

                // Free X result set
                mysqli_free_result($resultX1);

                // Getting the Y variable results from the database
                $resultY1 = mysqli_query($conn, $mySqlQueryY1);

                // Fetch the Y data into an assoctiative array
                // and print all of them
                if($yVar == "cap"){
                    while($row1 = mysqli_fetch_array($resultY1)){
                        $dataY1 = $dataY1 . '"'. $row1['cap'].'",';        
                    }
                }

                elseif($yVar == "speCap"){
                    while($row1 = mysqli_fetch_array($resultY1)){
                        $dataY1 = $dataY1 . '"'. $row1['speCap'].'",';        
                    }
                }

                elseif($yVar == "voltage"){
                    while($row1 = mysqli_fetch_array($resultY1)){
                        $dataY1 = $dataY1 . '"'. $row1['voltage'].'",';        
                    }
                }

                $dataX1 = trim($dataX1,",");
                $dataY1 = trim($dataY1,",");

                // $key = $i + 1;
                // $chargeX[$key] = $dataX;
                // $chargeY[$key] = $dataY;

                // Free Y result set
                mysqli_free_result($resultY1);

                // echo $i."X is ".$dataX1."<br>";
                // echo $i."Y is ".$dataY1."<br>";
                
                // // Closing the connection with the database
                // mysqli_close($conn);
            //}
        }

        if(isset($discharge)){
            // splitting the user input for cycle
            $cycleString = strval($cycle);
            $cycleArray = explode(",", $cycleString);
            //for($i=0;$i<count($cycleArray);$i++){
                // MySQL Query for the X variable
                $mySqlQueryX2 = "SELECT $xVar
                                FROM record
                                WHERE cycleIndex = $cycleArray[0] AND (stepState = 'CCD');";

                // MySQL Query for the Y variable
                $mySqlQueryY2 = "SELECT $yVar 
                                FROM record
                                WHERE cycleIndex = $cycleArray[0] AND (stepState = 'CCD');";

                // Getting the X variable results from the database
                $resultX2 = mysqli_query($conn, $mySqlQueryX2);

                $dataX2 = '';
                $dataY2 = '';

                // Fetch the Y data into an assoctiative array
                // and print all of them
                if($xVar == "cap"){
                    while($row = mysqli_fetch_array($resultX2)){
                        $dataX2 = $dataX2 . '"'. $row['cap'].'",';       
                    }   
                }

                elseif($xVar == "speCap"){
                    while($row = mysqli_fetch_array($resultX2)){
                        $dataX2 = $dataX2 . '"'. $row['speCap'].'",';        
                    }
                }

                elseif($xVar == "voltage"){
                    while($row = mysqli_fetch_array($resultX2)){
                        $dataX2 = $dataX2 . '"'. $row['voltage'].'",';        
                    }
                }

                // Free X result set
                mysqli_free_result($resultX2);

                // Getting the Y variable results from the database
                $resultY2 = mysqli_query($conn, $mySqlQueryY2);

                // Fetch the Y data into an assoctiative array
                // and print all of them
                if($yVar == "cap"){
                    while($row = mysqli_fetch_array($resultY2)){
                        $dataY2 = $dataY2 . '"'. $row['cap'].'",';        
                    }
                }

                elseif($yVar == "speCap"){
                    while($row = mysqli_fetch_array($resultY2)){
                        $dataY2 = $dataY2 . '"'. $row['speCap'].'",';        
                    }
                }

                elseif($yVar == "voltage"){
                    while($row = mysqli_fetch_array($resultY2)){
                        $dataY2 = $dataY2 . '"'. $row['voltage'].'",';        
                    }
                }

                $dataX2 = trim($dataX2,",");
                $dataY2 = trim($dataY2,",");

                // $key = $i + 1;
                // $chargeX[$key] = $dataX;
                // $chargeY[$key] = $dataY;

                // Free Y result set
                mysqli_free_result($resultY2);

                // echo $i."X is ".$dataX."<br>";
                // echo $i."Y is ".$dataY."<br>";

                $mySqlQueryX3 = "SELECT $xVar
                                FROM record
                                WHERE cycleIndex = $cycleArray[1] AND (stepState = 'CCD');";

                // MySQL Query for the Y variable
                $mySqlQueryY3 = "SELECT $yVar 
                                FROM record
                                WHERE cycleIndex = $cycleArray[1] AND (stepState = 'CCD');";

                // Getting the X variable results from the database
                $resultX3 = mysqli_query($conn, $mySqlQueryX3);

                $dataX3 = '';
                $dataY3 = '';

                // Fetch the Y data into an assoctiative array
                // and print all of them
                if($xVar == "cap"){
                    while($row3 = mysqli_fetch_array($resultX3)){
                        $dataX3 = $dataX3 . '"'. $row3['cap'].'",';       
                    }   
                }

                elseif($xVar == "speCap"){
                    while($row3 = mysqli_fetch_array($resultX3)){
                        $dataX3 = $dataX3 . '"'. $row3['speCap'].'",';        
                    }
                }

                elseif($xVar == "voltage"){
                    while($row3 = mysqli_fetch_array($resultX3)){
                        $dataX3 = $dataX3 . '"'. $row3['voltage'].'",';        
                    }
                }

                // Free X result set
                mysqli_free_result($resultX3);

                // Getting the Y variable results from the database
                $resultY3 = mysqli_query($conn, $mySqlQueryY3);

                // Fetch the Y data into an assoctiative array
                // and print all of them
                if($yVar == "cap"){
                    while($row3 = mysqli_fetch_array($resultY3)){
                        $dataY3 = $dataY3 . '"'. $row3['cap'].'",';        
                    }
                }

                elseif($yVar == "speCap"){
                    while($row3 = mysqli_fetch_array($resultY3)){
                        $dataY3 = $dataY3 . '"'. $row3['speCap'].'",';        
                    }
                }

                elseif($yVar == "voltage"){
                    while($row3 = mysqli_fetch_array($resultY3)){
                        $dataY3 = $dataY3 . '"'. $row3['voltage'].'",';        
                    }
                }

                $dataX3 = trim($dataX3,",");
                $dataY3 = trim($dataY3,",");

                // $key = $i + 1;
                // $chargeX[$key] = $dataX;
                // $chargeY[$key] = $dataY;

                // Free Y result set
                mysqli_free_result($resultY3);

                // echo $i."X is ".$dataX1."<br>";
                // echo $i."Y is ".$dataY1."<br>";
                
                // // Closing the connection with the database
                // mysqli_close($conn);
            //}
        }
    }
}
?>