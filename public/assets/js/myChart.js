var myBarChartRegistered = document.getElementById("myBarChartRegistered").getContext("2d");
var myBarChartTurnover = document.getElementById("myBarChartTurnover").getContext("2d");

//code for turnover chart
var myBarChartR = new Chart(myBarChartRegistered, {
    type: 'bar',
    data: {
        labels: xdataRegistered,
        datasets: [{
            label: "By registrations",
            backgroundColor: colorsRegistered,
            hoverBackgroundColor: "#2e59d9",
            borderColor: colorsRegistered,
            data: ydataRegistered,
        }],
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    callback: function (value) { if (value % 1 === 0) { return value; } }
                }

            }]
        },
        title:{
            display:true,
            text:'Registrations Chart',
            fontSize:25
        }

    }
});
//end

//code for turnover chart
var myBarChartT = new Chart(myBarChartTurnover, {
    type: 'bar',
    data: {
        labels: xdataTurnover,
        datasets: [{
            label: "By turnover",
            backgroundColor: colorsTurnover,
            hoverBackgroundColor: "#2e59d9",
            borderColor: colorsTurnover,
            data: ydataTurnover,
        }],
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    callback: function (value) { if (value % 1 === 0) { return value + ' $'; } }
                }

            }]
        },
        title:{
            display:true,
            text:'Turnover Chart',
            fontSize:25
        }

    }
});
//end