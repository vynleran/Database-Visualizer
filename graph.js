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
            text: x + " " + unitX,
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