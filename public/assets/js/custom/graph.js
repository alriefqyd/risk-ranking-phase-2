$(function (){
    var _graph_canvas = $("#project-stacked-bar-chart");
    if (_graph_canvas.length > 0) {
        Chart.register(ChartDataLabels);
        $.ajax({
            url: '/getDataGraph',
            data: {
                'type': 'basket'
            },
            success: function (result) {
                setGraph(result.data);
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });

        function setGraph(result) {
            const keys = Object.keys(result);
            const labels = keys.map(label =>
                label.length > 16 ? label.substring(0, 15) + "..." : label
            );

            const projectCounts = keys.map(area => result[area].projects);
            const budgets = keys.map(area => result[area].budget);

            // Destroy previous chart if it exists
            if (window.myChart) {
                window.myChart.destroy();
            }

            const options =  {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'BC Submitted',
                            data: projectCounts,
                            backgroundColor: 'rgba(248,201,113,0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            yAxisID: 'yProjects', // Ensure this ID exists in scales
                            barThickness: 'flex',
                            minBarLength: 1  // Set minimum bar height
                        },
                        {
                            label: 'BC Cost Estimate',
                            data: budgets,
                            backgroundColor: 'rgba(137,214,197,0.5)',
                            borderColor: 'rgb(42,55,55)',
                            borderWidth: 1,
                            yAxisID: 'yBudget', // Ensure this ID exists in scales
                            barThickness: 'flex',
                            minBarLength: 3  // Set minimum bar height
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: false,
                            categoryPercentage: 0.6,
                            barPercentage: 0.8
                        },
                        yProjects: {  // This must match the yAxisID in dataset
                            type: 'linear',
                            position: 'left',
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Projects'
                            }
                        },
                        yBudget: {  // This must match the yAxisID in dataset
                            type: 'logarithmic',
                            position: 'right',
                            beginAtZero: false,
                            title: {
                                display: true,
                                text: 'Budget (in $)'
                            },
                            ticks: {
                                callback: function (value) {
                                    return value.toLocaleString(); // Format ticks as readable numbers
                                }
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        tooltip: {
                            callbacks: {
                                title: function(tooltipItems) {
                                    let label = tooltipItems[0].label;
                                    return label.match(/.{1,20}/g).join("\n");
                                }
                            }
                        },
                        datalabels: { // Plugin for bar labels
                            anchor: 'end',  // Position label at the top of the bar
                            align: 'top',    // Align text above the bar
                            formatter: (value) => value.toLocaleString(), // Format numbers
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                }
            };


            var ctx = document.getElementById('project-stacked-bar-chart').getContext('2d');
            window.myChart = new Chart(ctx, options);
        }
    }
});
