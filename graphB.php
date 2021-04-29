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
    <title>Voltage Profile</title>
</head>
<body>
    <?php include "formB.php" ?>
    <!-- The entire website -->
    <div id="body">
        <!-- The input half -->
        <div id="inputs">
            <!-- The input form -->
            <form action="graphB.php" method="POST">
            <button><a href="index.php" id="graphButton">Cycle Life</a></button>
                <div id="form">
                    <!-- Labels -->
                    <div id="label">
                        <label for="">Battery:</label>
                        <label for="">Cycles:</label>
                        <label for="">X:</label>
                        <!-- <label for="">What's Y?</label> -->
                        <label for="">Discharge:</label>
                        <label for="">Charge:</label>
                    </div>
                    <!-- User Info -->
                    <div id="info">

                        <input type="text" placeholder="Batteries"
                        oninvalid="this.setCustomValidity('No Batteries Were Entered')"
                        oninput="setCustomValidity('')" name="battery">

                        <input type="text" placeholder="Cycles" 
                        oninvalid="this.setCustomValidity('No Cycles Were Entered')"
                        oninput="setCustomValidity('')" name="cycle">

                        <select name="X">
                            <option value="Capacity">Capacity</option>
                            <option value="SpeCapacity">Specific Capacity</option>
                            <!-- <option value="Voltage">Voltage</option> -->
                        </select>

                        <!-- <select name="Y">
                            <option value="Capacity">Capacity</option>
                            <option value="SpeCapacity">Specific Capacity</option>
                            <option value="Voltage">Voltage</option>
                        </select> -->

                        <input type="checkbox" name="discharge" value="1">
                        <input type="checkbox" name="charge" value="1">
                    </div>
                </div>
                <!-- Submit Button -->
                <div>
                    <button type="submit" name="submit">Submit</button>
                </div>
            </form>
            <!-- Upload File Button -->
            <form action="DBCycle.php" method="POST" enctype="multipart/form-data">
                <div>
                    <input type="file" name="file" id="file">
                    <input type="submit" value="Upload" name="submit">
                </div>
            </form>
            <p id="demo"></p>
        </div>
        <div id="graph">
            <script type="text/javascript">
                var xArray = <?php echo json_encode($xArray); ?>;
                var yArray = <?php echo json_encode($yArray); ?>;
                var input = <?php echo json_encode($cycle); ?>;
                var cycle = <?php echo json_encode($cycle); ?>;
                var battery = <?php echo json_encode($battery); ?>;
                var x = <?php echo json_encode($xVar); ?>;
                var y = <?php echo json_encode($yVar); ?>;
                var data = [];
                var color = ["black", "red", "green", "blue", "purple", "yellow"];
                var cycles = input.split(",");
                var k = 0;
                var unitX = "";
                var unitY = "V";

                if(x == "Capacity"){
                unitX += "mAh";
                }
                if(x == "SpeCapacity"){
                unitX += "mAh/g";
                }

                // charges
                for(i=0;i<xArray.length/2;i++){
                data[i] = {
                x: xArray[i],
                y: yArray[i], 
                name : "Cycle " + cycles[i],
                line: {
                color: color[i],
                width: 2
                }
                };
                }

                // discharges
                for(j=xArray.length/2;j<xArray.length;j++){
                data[j] = {
                x: xArray[j],
                y: yArray[j],
                showlegend: false,
                line: {
                color: color[k],
                width: 2
                }
                };
                k++;
                }

                var graph = document.getElementById('graph');

                var layout = {
                hovermode : false,
                title: {
                text:'States from Cycles ' + cycle + ' from battery ' + battery,
                font: {
                family: 'Courier New, monospace',
                size: 24
                },
                xref: 'paper',
                x: 0.05,
                },
                xaxis: {
                title: {
                text: x + "(" + unitX + ")",
                font: {
                    family: 'Courier New, monospace',
                    size: 18,
                    color: '#7f7f7f'
                }
                },
                },
                yaxis: {
                title: {
                text: y + "(V)",
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
            <!-- <script src="graph.js"></script> -->
        </div>
    </div>
</body>
</html>