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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="graph.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>
    <?php include "formA.php" ?>
    <!-- The entire website -->
    <div id="body">
        <!-- The input half -->
        <div id="inputs">
            <!-- The input form -->
            <form action="index.php" method="POST">
                <button><a href="graphB.php" id="graphButton">graphB</a></button>
                <div id="form">
                    <!-- Labels -->
                    <div id="label">
                        <label for="">Which Batteries?</label>
                        <label for="">What Cycles?</label>
                        <label for="">What's X?</label>
                        <label for="">What's Y1?</label>
                        <label for="">What's Y2?</label>
                    </div>
                    <!-- User Info -->
                    <div id="info">

                        <input type="text" placeholder="Batteries" requried 
                        oninvalid="this.setCustomValidity('No Batteries Were Entered')"
                        oninput="setCustomValidity('')" name="battery">

                        <input type="text" placeholder="Cycles" required 
                        oninvalid="this.setCustomValidity('No Cycles Were Entered')"
                        oninput="setCustomValidity('')" name="cycle">

                        <select name="X">
                            <option value="Capacity">Capacity</option>
                            <option value="SpeCapacity">Specific Capacity</option>
                            <option value="Voltage">Voltage</option>
                            <option value="CycleID">Cycle ID</option>
                        </select>

                        <select name="Y">
                            <option value="Capacity">Capacity</option>
                            <option value="SpeCapacity">Specific Capacity</option>
                            <option value="Voltage">Voltage</option>
                            <option value="Efficiency">Efficiency</option>
                        </select>

                        <select name="Y1">
                            <option value="Capacity">Capacity</option>
                            <option value="SpeCapacity">Specific Capacity</option>
                            <option value="Voltage">Voltage</option>
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
                var graph = document.getElementById('graph');

                var trace = {
                    x: [<?php echo $dataX; ?>],
                    y: [<?php echo $dataY; ?>], 
                    name : '<?php echo $yVar; ?>',
                    type: 'scatter',
                    line: {
                        color: 'red',
                        width: 2
                    }
                };

                var trace1 = {
                    x: [<?php echo $dataX; ?>], // the issue is coming from here since its just over laying both of them on top of each other
                    y: [<?php echo $dataY2; ?>],
                    name : '<?php echo $y2Var; ?>',
                    type: 'scatter',
                    yaxis: 'y2',
                    line: {
                        color: 'black',
                        width: 2
                    }
                };
                
                var layout = {
                    title: {
                        text:'Data from cycles under ' + '<?php echo $cycle; ?>' + ' from battery #' + '<?php echo $battery?>',
                        font: {
                            family: 'Courier New, monospace',
                            size: 24
                        },
                        xref: 'paper',
                        x: 0,
                    },
                    xaxis: {
                        title: {
                        text: '<?php echo $xVar; ?>',
                        font: {
                            family: 'Courier New, monospace',
                            size: 18,
                            color: '#7f7f7f'
                        }
                        },
                    },
                    yaxis: {
                        title: {
                        text: '<?php echo $yVar; ?>',
                        font: {
                            family: 'Courier New, monospace',
                            size: 18,
                            color: '#7f7f7f'
                        }
                        }
                    },
                    yaxis2: {
                        title: {
                        text: '<?php echo $y2Var; ?>',
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

                var data = [{
                                x: [<?php echo $dataX; ?>],
                                y: [<?php echo $dataY; ?>], 
                                name : '<?php echo $yVar; ?>',
                                type: 'scatter',
                                line: {
                                    color: 'red',
                                    width: 2
                                }
                            },

                            {
                                x: [<?php echo $dataX; ?>], // the issue is coming from here since its just over laying both of them on top of each other
                                y: [<?php echo $dataY2; ?>],
                                name : '<?php echo $y2Var; ?>',
                                type: 'scatter',
                                yaxis: 'y2',
                                line: {
                                    color: 'black',
                                    width: 2
                                }
                            }];
                Plotly.newPlot(graph, data, layout);
            </script>
        </div>
    </div>
</body>
</html>