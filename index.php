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
    <title>Cycle Life</title>
</head>
<body>
    <?php include "formA.php" ?>
    <!-- The entire website -->
    <div id="body">
        <!-- The input half -->
        <div id="inputs">
            <!-- The input form -->
            <form action="index.php" method="POST">
                <button><a href="graphB.php" id="graphButton">Voltage Profile</a></button>
                <div id="form">
                    <!-- Labels -->
                    <div id="label">
                        <label for="">Battery:</label>
                        <!-- <label for="">What Cycles?</label> -->
                        <!-- <label for="">What's X?</label> -->
                        <label for="">Y1:</label>
                        <label for="">Y2:</label>
                    </div>
                    <!-- User Info -->
                    <div id="info">

                        <input type="text" placeholder="Batteries" requried 
                        oninvalid="this.setCustomValidity('No Batteries Were Entered')"
                        oninput="setCustomValidity('')" name="battery">

                        <!-- <input type="text" placeholder="Cycles" required 
                        oninvalid="this.setCustomValidity('No Cycles Were Entered')"
                        oninput="setCustomValidity('')" name="cycle"> -->

                        <!-- <select name="X">
                            <option value="Capacity">Capacity</option>
                            <option value="SpeCapacity">Specific Capacity</option>
                            <option value="Voltage">Voltage</option>
                            <option value="CycleID">Cycle ID</option>
                        </select> -->

                        <select name="Y">
                            <option value="Capacity">Capacity</option>
                            <option value="SpeCapacity">Specific Capacity</option>
                            <!-- <option value="Voltage">Voltage</option>
                            <option value="Efficiency">Efficiency</option> -->
                        </select>

                        <select name="Y1">
                            <option value="Capacity">Capacity</option>
                            <!-- <option value="SpeCapacity">Specific Capacity</option>
                            <option value="Voltage">Voltage</option> -->
                            <option value="Efficiency">Efficiency</option>
                        </select>

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
        </div>
        <div id="graph">
            <script>
                var xArray = <?php echo json_encode($xArray); ?>;
                var yArray = <?php echo json_encode($yArray); ?>;
                var y2Array = <?php echo json_encode($y2Array); ?>;
                var data = [];
                var input = <?php echo json_encode($battery); ?>;
                var color = ["black", "red", "green", "blue", "purple", "yellow"];
                var batArray = input.split(",");
                var y = <?php echo json_encode($yVar); ?>;
                var y2 = <?php echo json_encode($y2Var); ?>;
                var unitY = "";
                var unitY2 = "";
                var graph = document.getElementById('graph');
                var size = xArray.length;

                for(i=0;i<xArray.length;i++){
                    data[i] = {
                        x: xArray[i],
                        y: yArray[i], 
                        name : "Battery " + batArray[i],
                        mode: 'markers',
                        marker: {
                            color: color[i],
                            size: 2,
                            line: {
                            color: color[i],
                            width: 2
                            }
                        }
                    };
                }

                for(j=0;j<xArray.length;j++){
                    var index = j+size;
                    data[index] = {
                        x: xArray[j],
                        y: y2Array[j], 
                        showlegend: false,
                        // name : "Battery " + batArray[j] + "-" + y2,
                        yaxis : 'y2',
                        mode: 'markers',
                        marker: {
                            color: color[j],
                            size: 2,
                            line: {
                            color: color[j],
                            width: 2
                            }
                        }
                    };
                }
                

                // var trace = {
                //     x: xArray[0],
                //     y: y2Array[0],
                //     name: 'yaxis2 data',
                //     yaxis: 'y2',
                //     mode: 'markers',
                //     marker: {
                //         color: color[2],
                //         size: 2,
                //         line: {
                //         color: color[2],
                //         width: 2
                //         }
                //     }
                // };
                // var trace2 = {
                //     x: xArray[1],
                //     y: y2Array[1],
                //     name: 'yaxis2 data1',
                //     yaxis: 'y2',
                //     mode: 'markers',
                //     marker: {
                //         color: color[3],
                //         size: 2,
                //         line: {
                //         color: color[3],
                //         width: 2
                //         }
                //     }
                // };

                // data.push(trace);
                // data.push(trace2);

                if(y == "Capacity"){unitY += "mAh";}
                if(y == "SpeCapacity"){unitY += "mAh/g";}

                if(y2 == "Capacity"){unitY2 += "mAh";}
                if(y2 == "Efficiency"){unitY2 += "%";}
                
                var layout = {
                    havermode: false,
                    title: {
                        text:'Data from battery #' + '<?php echo $battery?>',
                        font: {
                            family: 'Courier New, monospace',
                            size: 24
                        },
                        xref: 'paper',
                        x: 0,
                    },
                    xaxis: {
                        title: {
                        text: "Cycle ID",
                        font: {
                            family: 'Courier New, monospace',
                            size: 18,
                            color: '#7f7f7f'
                        }
                        },
                    },
                    yaxis: {
                        title: {
                        text: y + "(" + unitY + ")",
                        font: {
                            family: 'Courier New, monospace',
                            size: 18,
                            color: '#7f7f7f'
                        }
                        }
                    },
                    yaxis2: {
                        title: {
                        text: y2 + "(" + unitY2 + ")",
                        font: {
                            family: 'Courier New, monospace',
                            size: 18,
                            color: '#7f7f7f'
                        }
                        },
                        overlaying: 'y',
                        side: 'right'
                    }
                };
                Plotly.newPlot(graph, data, layout);
            </script>
        </div>
    </div>
</body>
</html>