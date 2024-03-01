$(function (){
    var _graph_canvas = $("#stacked-bar-chart");
    if(_graph_canvas.length > 0){
        $.ajax({
            url:'/getDataGraph',
            data : {
                'type' : 'basket'
            },
            success:function (result){
                setGraph(result);
            }
        });

        function sumTotal(data){
            var count = 0;
            $.each(data, function (index, value) {
                count += value;
            });

            return count;
        }
        function setGraph(result){
            var labelArray = ['Maintain Capacity','Margin','Health and Safety','Sustainability','Administrative'],
                margin = sumTotal(result.margin),
                maintain = sumTotal(result.maintain_capacity),
                hsor = sumTotal(result.health_safety),
                sustainability = sumTotal(result.sustainability),
                administrative = sumTotal(result.administrative_improvements);


            const options =  {
                type: 'bar',
                data: {
                    labels: labelArray,
                    datasets: [
                        {
                            label: 'Maintain Capacity',
                            data: [maintain,0,0,0,0],
                            backgroundColor: 'rgb(229,117,31)',
                            borderColor: 'rgb(229,117,31)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Margin',
                            data: [0,margin,0,0,0],
                            backgroundColor: 'rgb(0,166,149)',
                            borderColor: 'rgb(0,166,149)',
                            borderWidth: 1
                        },
                        {
                            label: 'Health & Safety',
                            data: [0,0,hsor,0,0],
                            backgroundColor: 'rgb(179,179,179)',
                            borderColor: 'rgb(179,179,179)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Sustainability',
                            data: [0,0,0,sustainability,0],
                            backgroundColor: 'rgb(83,219,240)',
                            borderColor: 'rgb(83,219,240)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Administrative',
                            data: [0,0,0,0,administrative],
                            backgroundColor: 'rgb(255,204,153)',
                            borderColor: 'rgb(255,204,153)',
                            borderWidth: 1,
                        },

                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive:true,
                    legend: {
                        display: true,
                        position: 'bottom',
                    },
                    plugins:{
                        datalabels:{
                            labels:{
                                index:{
                                    align:"top",
                                    color : "black",
                                    font: {
                                        weight: 'bold',
                                        size: 13,
                                    },
                                    formatter: (value, context) => {
                                        const datasetArray = [];
                                        context.chart.data.datasets.forEach((dataset) => {
                                            if(dataset.data[context.dataIndex] != undefined){
                                                datasetArray.push(dataset.data[context.dataIndex]);
                                            }
                                        });
                                        function totalSum(total, dataPoint){
                                            return total + dataPoint;
                                        }

                                        if(context.datasetIndex === datasetArray.length - 1){
                                            return datasetArray.reduce(totalSum, 0);
                                        }
                                        return '';
                                    }
                                },
                                name:{
                                    align:"center",
                                    color:"white",
                                    padding:20,
                                    padding:4,
                                    font: {
                                        size: 11,
                                    },
                                    formatter: function(value, context) {
                                        var label = '';
                                        if(value == 0) return '';
                                        return context.dataset.label + ": " + value;
                                    },
                                },
                            },
                        }
                    },
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true,
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                steps: 10,
                                stepValue: 5,
                                suggestedMin: 50,
                                suggestedMax: 110
                            }
                        }]
                    },
                },
                plugins:[ChartDataLabels]
            };

            var ctx = document.getElementById('stacked-bar-chart').getContext('2d');
            var chart = new Chart(ctx, options);
        }

    }

    if($('#stacked-bar-chart-investment-strategy').length > 0){
        $.ajax({
            url:'/getDataGraph',
            data : {
                'type' : 'investment_strategy'
            },
            success: function (result){
                setInvestmentStrategyChart(result)
            }
        })
    }

    function setInvestmentStrategyChart(result){
        var labelArray = ['R & D / Growth', 'Sustaining'],
            totalData = Object.values(result.level1).reduce(function (acc, curr) {
                return acc + curr;
            }, 0);

            r_and_d = [result.level2.r_and_d,0],
            growth = [result.level2.growth,0],
            volume = [0,result.level2.volume],
            cost_reduction = [0,result.level2.cost_reduction],
            replacement = [0,result.level2.replacement],
            others = [0,result.level2.others]

        const options =  {
            type: 'bar',
            data: {
                labels: labelArray,
                datasets: [
                    {
                        label: 'R & D',
                        data: r_and_d,
                        backgroundColor: 'rgb(0,166,149)',
                        borderColor: 'rgb(0,166,149)',
                        borderWidth: 1
                    },
                    {
                        label: 'Growth',
                        data: growth,
                        backgroundColor: 'rgb(229,117,31)',
                        borderColor: 'rgb(229,117,31)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Volume',
                        data: volume,
                        backgroundColor: 'rgb(179,179,179)',
                        borderColor: 'rgb(179,179,179)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Cost Reduction',
                        data: cost_reduction,
                        backgroundColor: 'rgb(83,219,240)',
                        borderColor: 'rgb(83,219,240)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Replacement',
                        data: replacement,
                        backgroundColor: 'rgb(255,204,153)',
                        borderColor: 'rgb(255,204,153)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Others',
                        data: others,
                        backgroundColor: 'rgb(145,81,81)',
                        borderColor: 'rgb(145,81,81)',
                        borderWidth: 1,
                    },

                ]
            },
            options: {
                maintainAspectRatio: false,
                responsive:true,
                legend: {
                    display: true,
                    position: 'bottom',
                },
                plugins:{
                    datalabels:{
                        labels:{
                            index:{
                                align:"top",
                                color : "black",
                                font: {
                                    weight: 'bold',
                                    size: 13,
                                },
                                formatter: (value, context) => {
                                    const datasetArray = [];
                                    context.chart.data.datasets.forEach((dataset) => {
                                        if(dataset.data[context.dataIndex] != undefined){
                                            datasetArray.push(dataset.data[context.dataIndex]);
                                        }
                                    });
                                    function totalSum(total, dataPoint){
                                        return total + dataPoint;
                                    }

                                    if(context.datasetIndex === datasetArray.length - 1){
                                        return datasetArray.reduce(totalSum, 0);
                                    }
                                    return '';
                                }
                            },
                            name:{
                                align:"center",
                                color:"white",
                                padding:20,
                                padding:4,
                                font: {
                                    size: 11,
                                },
                                formatter: function(value, context) {
                                    var label = '';
                                    if(value == 0) return '';
                                    return context.dataset.label + ": " + value;
                                },
                            },
                        },
                    }
                },
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true,
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            steps: 10,
                            stepValue: 5,
                            suggestedMin: 0,
                            suggestedMax: totalData
                        }
                    }]
                },
            },
            plugins:[ChartDataLabels]
        };

        var ctx = document.getElementById('stacked-bar-chart-investment-strategy').getContext('2d');
        var chart = new Chart(ctx, options);
    }
});
