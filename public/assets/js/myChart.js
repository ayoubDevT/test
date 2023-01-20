var ctx = document.getElementById("myBarChart").getContext("2d");
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: xdata,
        datasets: [{
            label: "Registrations",
            backgroundColor: "#4e73df",
            hoverBackgroundColor: "#2e59d9",
            borderColor: "#4e73df",
            data: ydata,
        }],
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    callback: function(value) {if (value % 1 === 0) {return value;}}
                }

            }]
        }

    }
});