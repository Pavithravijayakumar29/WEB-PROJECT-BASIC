"use strict";
document.addEventListener('DOMContentLoaded', function () {
    var chartContainer = document.getElementById('chart1');
    var monthlyDataJson = chartContainer.getAttribute('data-monthly-data');
    var monthlyData = JSON.parse(monthlyDataJson);

function createChart(data) {
    console.log(data);
    var options = {
        chart: {
            height: 230,
            type: "line",
            shadow: {
                enabled: true,
                color: "#000",
                top: 18,
                left: 7,
                blur: 10,
                opacity: 1
            },
            toolbar: {
                show: false
            }
        },
        colors: ["#5567ff", "#999b9c", "#FF5733"],
        dataLabels: {
            enabled: true
        },
        stroke: {
            curve: "smooth"
        },
        series: [

            {
                name: "Monthly Total",
                data: monthlyData
            },

        ],
        grid: {
            borderColor: "#e7e7e7",
            row: {
                colors: ["#f3f3f3", "transparent"],
                opacity: 0.0
            }
        },
        markers: {
            size: 6
        },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            labels: {
                style: {
                    colors: "#9aa0ac"
                }
            }
        },
        yaxis: {
            title: {
                text: "Income"
            },
            labels: {
                style: {
                    color: "#9aa0ac"
                }
            },
            min: 25000,
            max: 5000000
        },
        legend: {
            position: "top",
            horizontalAlign: "right",
            floating: true,
            offsetY: -25,
            offsetX: -5
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();
}
createChart(monthlyData);
});
function myFunction() {
    var input, filter, table, tr, tds, i, j, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        tds = tr[i].getElementsByTagName("td");
        var rowMatchesFilter = false;

        for (j = 0; j < tds.length; j++) {
            txtValue = tds[j].textContent || tds[j].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                rowMatchesFilter = true;
                break;
            }
        }

        if (rowMatchesFilter) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}
// Donut Chart//
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
const data = google.visualization.arrayToDataTable([
  ['Contry', 'Mhl'],
  ['Italy',54.8],
  ['France',48.6],
  ['Spain',44.4],
  ['USA',23.9],
  ['Argentina',14.5]
]);
const options = {
  is3D:true
};
const chart = new google.visualization.PieChart(document.getElementById('donutchart'));
chart.draw(data, options);

}

      //Bar Charts//
      document.addEventListener('DOMContentLoaded', function () {
        var chartContainer = document.getElementById('myChart');
        var monthlyExpenseJson = chartContainer.getAttribute('expense-data');
        var expenseData = JSON.parse(monthlyExpenseJson);


        function expenseChart(data) {
            console.log(data);
            const xValues = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            const barColors = ["red", "green", "blue", "orange", "brown", "black", "violet", "turquoise", "pink", "gray", "skyblue", "yellow"];

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: data // Use the parsed JSON data here
                    }]
                },
                options: {
                    legend: { display: false },
                    scales: {
                        yAxes: [{ticks: {min: 1000, max:15000}}],
                        },
                    title: {
                        display: true,
                        text: "Expense " + currentYear
                    }
                }
            });
        }

        expenseChart(expenseData);
    });
// Sales Return //
document.addEventListener('DOMContentLoaded', function () {
    var chartContainer = document.getElementById('myChart_1');
    var returnJson = chartContainer.getAttribute('return-data');
    var returnData = JSON.parse(returnJson);
    console.log(returnData);
    const xValues_1 = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    const yValues_1 =returnData; //[100,123,211,159,429,100,111,221,118,129,555,543];

    new Chart("myChart_1", {
    type: "line",
    data: {
        labels: xValues_1,
        datasets: [{
        fill: false,
        lineTension: 0,
        backgroundColor: "rgba(0,0,255,1.0)",
        borderColor: "#40e0d0",
        data: yValues_1
        }]
    },
    options: {
        legend: {display: false},
        scales: {
        yAxes: [{ticks: {min: 1000, max:50000}}],
        },
        title: {
            display: true,
            text: "Sales Return " + currentYear
        }
    }
    });


});
