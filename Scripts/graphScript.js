
var carTrace={};
var wheelTrace={}
var carActual={};
var wheelActual= {};
var graphData=[];


function setTraces(){
        carTrace = {
            x: t,
            y: carData,
            mode: 'lines',
            name: 'X3',
            line: {
                color: 'rgb(163,183,255)',
                width: 2
            }

        };
        wheelTrace = {
            x: t,
            y: x1,
            mode: 'lines',
            name: 'X1',
            line: {
                color: 'rgb(129,218,91)',
                width: 2
            }
        };

    }

function setMarkers(time){

     wheelActual = {
        x:[t[time]],
        y:[x1[time]],
        mode:'markers',
        name: 'X1_Current',
        marker:{
            color: 'rgb(54,94,36)',
            size: 10,
            line: {
                color: 'rgb(125,210,90)',
                width: 2
            }
        }
    };
     carActual = {
        x:[t[time]],
        y:[carData[time]],
        mode:'markers',
        name: 'X3_Current',
        marker:{
            color: 'rgb(67,80,115)',
            size: 10,
            line: {
                color: 'rgb(132,147,205)',
                width: 2
            }
        }
    };

}

function drawGraph(){
    graphData=[];
    graphData.push(wheelTrace);
    graphData.push(wheelActual);
    graphData.push(carTrace);
    graphData.push(carActual);

    var layout = {
        showlegend: true,
        paper_bgcolor: 'rgb(42,45,59)',
        plot_bgcolor:'rgb(42,45,58)',

        xaxis : {
            gridcolor: "rgba(204,204,204,0.5)",
            tickfont : {
                size : 14,
                color : 'rgb(225,225,225)'
            }
        },
        yaxis : {
            gridcolor : 'rgba(204,204,204,0.5)',
            tickfont : {
                size : 14,
                color : 'rgba(255,225,225,0)'
            }
        },

        legend:{
            font:{
                color:'rgb(225,225,225)'
            }
        }

    };

    Plotly.newPlot('graph', graphData,layout);
    Plotly.newPlot('graph', graphData,layout);
}