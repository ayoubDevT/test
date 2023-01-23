var ctx = document.getElementById("myBarChart").getContext("2d");
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: xdata,
        datasets: [{
            label: "Registrations",
            backgroundColor: colors,
            hoverBackgroundColor: "#2e59d9",
            borderColor: colors,
            data: ydata,
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
        }

    }
});