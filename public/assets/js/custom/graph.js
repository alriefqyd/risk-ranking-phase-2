$(function () {
    var _graph_canvas = $("#project-stacked-bar-chart");
    var _graph_canvas_type = $("#stacked-bar-chart-investment-strategy");

    if (_graph_canvas.length > 0) {
        Chart.register(ChartDataLabels);

        $.ajax({
            url: '/getDataGraph',
            data: {
                'type': 'basket'
            },
            success: function (result) {
                if (result.data) {
                    setGraph(result.data, 'project-stacked-bar-chart'); // First chart
                }
                if (result.dataType) {
                    setGraph(result.dataType, 'stacked-bar-chart-investment-strategy'); // Second chart
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    }

    // Store multiple charts in an object
    let chartInstances = {};

    function setGraph(result, element) {
        var labelLength = 20;
        if(element == 'project-stacked-bar-chart') {
            labelLength = 10;
        }
        const keys = Object.keys(result);
        const fullLabels = keys.map(label => label); // Keep full labels for tooltips
        const labels = keys.map(label =>
            label.length > labelLength ? label.substring(0, labelLength) + "…" : label // Truncate only for x-axis
        );

        const projectCounts = keys.map(area => result[area].projects);
        const budgets = keys.map(area => result[area].budget);

        // Destroy the existing chart if it already exists
        if (chartInstances[element]) {
            chartInstances[element].destroy();
        }

        const ctx = document.getElementById(element).getContext('2d');

        chartInstances[element] = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'BC Submitted',
                        data: projectCounts,
                        backgroundColor: 'rgb(233,183,51)',
                        borderColor: 'rgb(0,145,153)',
                        borderWidth: 1,
                        yAxisID: 'yProjects',
                        barThickness: 'flex',
                        minBarLength: 1
                    },
                    {
                        label: 'BC Cost Estimate',
                        data: budgets,
                        backgroundColor: 'rgb(0,145,153)',
                        borderColor: 'rgb(233,183,51)',
                        borderWidth: 1,
                        yAxisID: 'yBudget',
                        barThickness: 'flex',
                        minBarLength: 3
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
                        barPercentage: 0.8,
                        ticks: {
                            maxRotation: 20, // Prevents diagonal rotation
                            minRotation: 0,   // Ensures labels stay horizontal
                            font: {
                                size: 10 // Reduce font size (adjust as needed)
                            }
                        }
                    },
                    yProjects: {
                        type: 'linear',
                        position: 'left',
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Projects'
                        }
                    },
                    yBudget: {
                        type: 'logarithmic',
                        position: 'right',
                        beginAtZero: false,
                        title: {
                            display: true,
                            text: 'Cost Estimate Budget (in million $)'
                        },
                        ticks: {
                            callback: function (value) {
                                return value.toLocaleString();
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
                            title: function (tooltipItems) {
                                let index = tooltipItems[0].dataIndex;
                                return fullLabels[index];
                            }
                        }
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: (value) => value.toLocaleString(),
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            }
        });
    }
});
