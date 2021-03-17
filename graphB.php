<!-- Connecting to the database -->
<?php
include 'dbConn.php';
?>

<!-- The Styling of the website -->
<style>
    <?php include 'main.css'; ?>
</style>

<!-- The Skeleton of the website -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="graph.js"></script>
    <title>Document</title>
</head>
<body>
    <?php include "formB.php" ?>
    <!-- The entire website -->
    <div id="body">
        <!-- The input half -->
        <div id="inputs">
            <!-- The input form -->
            <form action="graphB.php" method="POST">
            <button><a href="index.php" id="graphButton">graphA</a></button>
                <div id="form">
                    <!-- Labels -->
                    <div id="label">
                        <label for="">Which Batteries?</label>
                        <label for="">What Cycles?</label>
                        <label for="">What's X?</label>
                        <label for="">What's Y?</label>
                        <label for="">Discharge?</label>
                        <label for="">Charge?</label>
                    </div>
                    <!-- User Info -->
                    <div id="info">

                        <input type="text" placeholder="Batteries"
                        oninvalid="this.setCustomValidity('No Batteries Were Entered')"
                        oninput="setCustomValidity('')" name="battery">

                        <input type="text" placeholder="Cycles" required 
                        oninvalid="this.setCustomValidity('No Cycles Were Entered')"
                        oninput="setCustomValidity('')" name="cycle">

                        <select name="X">
                            <option value="Capacity">Capacity</option>
                            <option value="SpeCapacity">Specific Capacity</option>
                            <option value="Voltage">Voltage</option>
                        </select>

                        <select name="Y">
                            <option value="Capacity">Capacity</option>
                            <option value="SpeCapacity">Specific Capacity</option>
                            <option value="Voltage">Voltage</option>
                        </select>

                        <input type="checkbox" name="discharge">
                        <input type="checkbox" name="charge">
                    </div>
                </div>
                <!-- Submit Button -->
                <div>
                    <button type="submit" name="submit">Submit</button>
                </div>
                <!-- Upload File Button -->
                <div>
                    <input type="file" name="file">
                    <input type="submit">
                </div>
            </form>
            <p id="demo"></p>
        </div>
        <div id="graph">
        <?php
            $json = json_encode ($xArray, JSON_FORCE_OBJECT );
        ?>
            <script>
                var json_obj = jQuery.parseJSON ( ' + <?php echo $json; ?> + ' );
                var data = [];
                var xAxis = [];
                var yAxis = [];
                $(document).ready(function(){
                    $.ajax({
                        url: "http://localhost/graphB.php",
                        method: "POST",
                        success: function(xArray) {
                            console.log(xArray);

                            for(var i in xArray){
                                xAxis.push(xArray[i]);
                            }
                        },
                        error: function(xArray){
                            console.log(xArray);
                        }
                    });
                });

                $(document).ready(function(){
                    $.ajax({
                        url: "http://localhost/graphB.php",
                        method: "POST",
                        success: function(yArray) {
                            console.log(yArray);

                            for(var i in yArray){
                                yAxis.push(yArray[i]);
                            }
                        },
                        error: function(yArray){
                            console.log(yArray);
                        }
                    });
                });
                
                for(i=0;i<data.length;i++){
                    for(j=0;j<xAxis.length;j++){
                        for(k=0;k<yAxis.length;k++){
                            data[i].push({
                                x: xAxis[j],
                                y: yAxis[k]
                            });
                        }
                    }
                }

                //var body = document.getElementById('body');
                var graph = document.getElementById('graph');
                
                var layout = {
                    title: {
                        text:'Plot Title',
                        font: {
                            family: 'Courier New, monospace',
                            size: 24
                        },
                        xref: 'paper',
                        x: 0.05,
                    },
                    xaxis: {
                        title: {
                        text: 'x Axis',
                        font: {
                            family: 'Courier New, monospace',
                            size: 18,
                            color: '#7f7f7f'
                        }
                        },
                    },
                    yaxis: {
                        title: {
                        text: 'y Axis',
                        font: {
                            family: 'Courier New, monospace',
                            size: 18,
                            color: '#7f7f7f'
                        }
                        }
                    }
                    };

                Plotly.newPlot(graph, data, layout);
            </script>
        </div>
    </div>
</body>
</html>