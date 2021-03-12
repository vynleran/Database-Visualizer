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
                            <option value="cap">Capacity</option>
                            <option value="speCap">Specific Capacity</option>
                            <option value="voltage">Voltage</option>
                        </select>

                        <select name="Y">
                            <option value="cap">Capacity</option>
                            <option value="speCap">Specific Capacity</option>
                            <option value="voltage">Voltage</option>
                        </select>

                        <input type="checkbox" name="discharge">
                        <input type="checkbox" name="charge">
                    </div>
                </div>
                <!-- Submit Button -->
                <div>
                    <button type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>
        <div id="graph">
            <script>
                var graph = document.getElementById('graph');

                var charge0 = {
                    x: [<?php echo $dataX; ?>],
                    y: [<?php echo $dataY; ?>]
                };
                var discharge0 = {
                    x: [<?php echo $dataX2; ?>],
                    y: [<?php echo $dataY2; ?>]
                };
                var charge1 = {
                    x: [<?php echo $dataX1; ?>],
                    y: [<?php echo $dataY1; ?>]
                };
                var discharge1 = {
                    x: [<?php echo $dataX3; ?>],
                    y: [<?php echo $dataY3; ?>]
                };
                
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

                var data = [charge0, discharge0, charge1. discharge1];
                Plotly.newPlot(graph, data, layout);
                                // [
                                //     {
                                //         x: [<?php echo $dataX; ?>],
                                //         y: [<?php echo $dataY; ?>] 
                                //     }
                                // ], 
                                // {
                                //     margin: {t: 0} 
                                // }
                            
            </script>
        </div>
        <!-- The graph half -->
        <!-- <div id="graph">
            <canvas id="chart"></canvas>
            <script>var ctx = document.getElementById("chart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [<?php echo $dataX; ?>],
                            // [<?php echo $dataX; ?>]
                            datasets: 
                            [{
                                label: 'cycle(charge) ' + [<?php echo $cycleArray[0]; ?>],
                                data: [<?php echo $dataY; ?>],
                                backgroundColor: 'transparent',
                                borderColor:'green',
                                borderWidth: 1,
                            },
                            {
                                label: 'cycle(discharge) ' + [<?php echo $cycleArray[0]; ?>],
                                data: [<?php echo $dataY2; ?>],
                                backgroundColor: 'transparent',
                                borderColor:'green',
                                borderWidth: 1,
                            },
                            {
                                label: 'cycle(charge) ' + [<?php echo $cycleArray[1]; ?>],
                                data: [<?php echo $dataY1; ?>],
                                backgroundColor: 'transparent',
                                borderColor:'red',
                                borderWidth: 1,
                            },
                            {
                                label: 'cycle(discharge) ' + [<?php echo $cycleArray[1]; ?>],
                                data: [<?php echo $dataY3; ?>],
                                backgroundColor: 'transparent',
                                borderColor:'red',
                                borderWidth: 1,
                            }]
                        },
                        
                        options: {
                            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                            tooltips:{mode: 'index'},
                            legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
                        }
                    });
            </script>
        </div> -->
    </div>
</body>
</html>