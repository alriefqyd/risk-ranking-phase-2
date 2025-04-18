$(function () {
    var _graph_canvas = $("#project-stacked-bar-chart");
    var _graph_canvas_type = $("#stacked-bar-chart-investment-strategy");

    // Register plugin
    Chart.register(ChartDataLabels);

    // Chart instance registry
    let chartInstances = {};

    if($("#stacked-bar-chart-priority_risk").length > 0) {
        $.ajax({
            url: '/getDataGraphByRiskCategory',
            data: {
                'type': 'risk_level_residual'

            },
            success: function (result) {
                if (result.data) {
                    setGraphRiskCategory(result.data,"stacked-bar-chart-priority_risk" );
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    }

    if($("#stacked-bar-chart-priority_risk-forecast").length > 0) {
        $.ajax({
            url: '/getDataGraphByRiskCategory',
            data: {
                'type': 'risk_level_forecast'

            },
            success: function (result) {
                if (result.data) {
                    setGraphRiskCategory(result.data,"stacked-bar-chart-priority_risk-forecast" );
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    }

    if (_graph_canvas.length > 0) {
        $.ajax({
            url: '/getDataGraph',
            data: {
                'type': 'basket'
            },
            success: function (result) {
                if (result.data) {
                    setGraph(result.data, 'project-stacked-bar-chart');
                }
                if (result.dataType) {
                    setGraph(result.dataType, 'stacked-bar-chart-investment-strategy');
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    }

    function setGraph(result, element) {
        const labelLength = (element === 'project-stacked-bar-chart') ? 10 : 20;
        const keys = Object.keys(result);
        const fullLabels = keys.map(label => label);
        const labels = keys.map(label => label.length > labelLength ? label.substring(0, labelLength) + "…" : label);
        const projectCounts = keys.map(area => result[area].projects);
        const budgets = keys.map(area => result[area].budget);

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
                layout: {
                    padding: {
                        top: 30
                    }
                },
                scales: {
                    x: {
                        stacked: false,
                        categoryPercentage: 0.6,
                        barPercentage: 0.8,
                        ticks: {
                            maxRotation: 20,
                            minRotation: 0,
                            font: {
                                size: 10
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
                        },
                        ticks: {
                            stepSize: 1,
                            callback: function (value) {
                                return Number.isInteger(value) ? value : null;
                            }
                        }
                    },
                    yBudget: {
                        type: 'logarithmic',
                        min: 0.05,
                        max: 1500,
                        position: 'right',
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
                        display: true,
                        position: 'bottom'
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

    function setGraphRiskCategory(result, graph) {

            const ctx = document.getElementById(graph).getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Very High", "High", "Medium", "Low"],

                    datasets: [
                        {
                            label: "No of Project",
                            data: result.map(item => item.quantity), backgroundColor: 'rgb(233,183,51)',
                            borderColor: 'rgb(0,145,153)',
                            borderWidth: 1,
                            yAxisID: 'yProjects',
                            barThickness: 'flex',
                            minBarLength: 1
                        },
                        {
                            label: "Cost Estimate",
                            data: result.map(item => item.cost),
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
                    layout: {
                        padding: {
                            top: 30
                        }
                    },
                    scales: {
                        x: {
                            stacked: false,
                            categoryPercentage: 0.6,
                            barPercentage: 0.8,
                            ticks: {
                                maxRotation: 20,
                                minRotation: 0,
                                font: {
                                    size: 10
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
                            },
                            ticks: {
                                stepSize: 1,
                                callback: function (value) {
                                    return Number.isInteger(value) ? value : null;
                                }
                            }
                        },
                        yBudget: {
                            type: 'logarithmic',
                            min: 0.05,
                            max: 500,
                            position: 'right',
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
                            display: true,
                            position: 'bottom'
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
                },
                plugins: [ChartDataLabels]
            });
        }


});
