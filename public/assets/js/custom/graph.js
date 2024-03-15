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
                hsor = sumTotal(result.health_safety),
                sustainability = sumTotal(result.sustainability),
                administrative = sumTotal(result.administrative_improvements),
                acquisision = result.maintain_capacity?.acquisition_replacement_construction_of_new_assets,
                refurbishment_rebuild = result.maintain_capacity?.refurbishment_rebuild,
                geotechnical_tailings_and_waste_pile = result.maintain_capacity?.geotechnical_tailings_and_waste_pile,
                geotechnical_product_stockpile = result.maintain_capacity?.geotechnical_product_stockpile,
                geotechnical_pit_slopes = result.maintain_capacity?.geotechnical_pit_slopes,
                geotechnical_hydrogeology = result.maintain_capacity?.geotechnical_hydrogeology,
                geotechnical_tailing_dams_dykes_downstream_containment_structure = result.maintain_capacity?.geotechnical_tailing_dams_dykes_downstream_containment_structure,
                geotechnical_power_dams = result.maintain_capacity?.geotechnical_power_dams,
                quality = result.margin?.quality ,
                revenue = result.margin?.revenue,
                volume = result.margin?.volume,
                safety = result.health_safety?.safety,
                emergency_service = result.health_safety?.emergency_service,
                health = result.health_safety?.health,
                environment = result.sustainability?.environment,
                social = result.sustainability?.social,
                equipment_furniture = result.administrative_improvements?.equipment_furniture,
                it = result.administrative_improvements?.it,
                property_security = result.administrative_improvements?.property_security;

            const options =  {
                type: 'bar', // Set the chart type to horizontalBar
                data: {
                    labels: labelArray,
                    datasets: [
                        {
                            label: 'Acquisition / Replacement / Construction of New Assets',
                            data: [acquisision, 0, 0, 0, 0],
                            backgroundColor: 'rgb(255, 99, 132)', // Customize this color
                            borderColor: 'rgb(255, 99, 132)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Refurbishment / Rebuild',
                            data: [refurbishment_rebuild, margin, 0, 0, 0],
                            backgroundColor: 'rgb(54, 162, 235)', // Customize this color
                            borderColor: 'rgb(54, 162, 235)',
                            borderWidth: 1
                        },
                        {
                            label: 'Geotechnical - Tailing Dams / Dykes / Downstream Containment Structures',
                            data: [geotechnical_tailing_dams_dykes_downstream_containment_structure, 0, hsor, 0, 0],
                            backgroundColor: 'rgb(255, 205, 86)', // Customize this color
                            borderColor: 'rgb(255, 205, 86)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Geotechnical - Power Dams',
                            data: [geotechnical_power_dams, 0, 0, sustainability, 0],
                            backgroundColor: 'rgb(44,126,126)', // Customize this color
                            borderColor: 'rgb(44,126,126)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Geotechnical - Pit Slopes',
                            data: [geotechnical_pit_slopes, 0, 0, 0, administrative],
                            backgroundColor: 'rgb(31,87,94)', // Customize this color
                            borderColor: 'rgb(31,87,94)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Geotechnical - Tailings and Waste Pile',
                            data: [geotechnical_tailings_and_waste_pile, 0, 0, 0, 0],
                            backgroundColor: 'rgb(255, 159, 64)', // Customize this color
                            borderColor: 'rgb(255, 159, 64)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Geotechnical - Product Stockpile',
                            data: [geotechnical_product_stockpile, 0, 0, 0, 0],
                            backgroundColor: 'rgb(68,85,128)', // Customize this color
                            borderColor: 'rgb(68,85,128)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Geotechnical - Hydrogeology',
                            data: [geotechnical_hydrogeology, 0, 0, 0, 0],
                            backgroundColor: 'rgb(56,31,31)', // Customize this color
                            borderColor: 'rgb(56,31,31)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Volume',
                            data: [0, volume, 0, 0, 0],
                            backgroundColor: 'rgb(0, 255, 0)', // Customize this color
                            borderColor: 'rgb(0, 255, 0)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Quality',
                            data: [0, quality, 0, 0, 0],
                            backgroundColor: 'rgb(136,136,8)', // Customize this color
                            borderColor: 'rgb(136,136,8)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Revenue',
                            data: [0, revenue, 0, 0, 0],
                            backgroundColor: 'rgb(255, 69, 0)', // Customize this color
                            borderColor: 'rgb(255, 69, 0)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Emergency Services',
                            data: [0, 0, 0, emergency_service, 0],
                            backgroundColor: 'rgb(255, 140, 0)', // Customize this color
                            borderColor: 'rgb(255, 140, 0)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Health',
                            data: [0, 0, 0, health, 0],
                            backgroundColor: 'rgb(9,154,154)', // Customize this color
                            borderColor: 'rgb(9,154,154)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Safety',
                            data: [0, 0, 0, safety, 0],
                            backgroundColor: 'rgb(255, 182, 193)', // Customize this color
                            borderColor: 'rgb(255, 182, 193)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Environment',
                            data: [0, 0, 0, 0, environment],
                            backgroundColor: 'rgb(98,121,103)', // Customize this color
                            borderColor: 'rgb(98,121,103)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Social',
                            data: [0, 0, 0, 0, social],
                            backgroundColor: 'rgb(0, 128, 0)', // Customize this color
                            borderColor: 'rgb(0, 128, 0)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Equipment / Furniture',
                            data: [0, 0, 0, 0, 0, equipment_furniture],
                            backgroundColor: 'rgb(128, 128, 128)', // Customize this color
                            borderColor: 'rgb(128, 128, 128)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Information Technology',
                            data: [0, 0, 0, 0, 0, it],
                            backgroundColor: 'rgb(0, 0, 255)', // Customize this color
                            borderColor: 'rgb(0, 0, 255)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Property Security',
                            data: [0, 0, 0, 0, 0, property_security],
                            backgroundColor: 'rgb(210, 105, 30)', // Customize this color
                            borderColor: 'rgb(210, 105, 30)',
                        }
                    ]
                },
                options: {
                    type: 'bar',
                    maintainAspectRatio: false,
                    responsive:true,
                    legend: {
                        display: false,
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
                                    font: {
                                        size: 9,
                                    },
                                    formatter: function(value, context) {
                                        var label = '';
                                        if(value == 0) return '';
                                        return context.dataset.label.substring(0,13) + ": " + value;
                                    },
                                },
                            },
                        }
                    },
                    scales: {
                        yAxes: [{
                            stacked: true,
                        }],
                        xAxes: [{
                            stacked: true,
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                steps: 10,
                                stepValue: 5,
                                suggestedMin: 50,
                                suggestedMax: 70
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

    if($('#project-stacked-bar-chart').length > 0){
        $.ajax({
            url:'/getProjectByOperationSubmitted',
            success:function (result){
                setGraphsubmissionDepartmentBcAssessment(result);
            }
        });
    }

    function setGraphsubmissionDepartment(result) {
        const data = {
            label: result.label,
            submittedBC: result.submittedBC,
            remaining: result.remaining
        };

        const ctx = document.getElementById('project-stacked-bar-chart').getContext('2d');

        const stackedBarChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: data.label.map(label => label.replace('&','amp&').split('amp')),
                datasets: [
                    {
                        label: 'Submitted BC',
                        data: data.submittedBC,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderWidth: 1
                    },
                    {
                        label: 'Remaining',
                        data: data.remaining,
                        backgroundColor: 'rgba(168, 168, 168, 0.7)',
                        borderWidth: 1
                    }
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
                                align:"right",
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
                                        const submittedBC = context.chart.data.datasets[0].data[context.dataIndex];
                                        const remaining = context.chart.data.datasets[1].data[context.dataIndex];
                                        const res = submittedBC + remaining;
                                        const percentage = (submittedBC / res) * 100;
                                        return percentage.toFixed(2) + '%';
                                    }

                                    if(context.datasetIndex === datasetArray.length - 1){
                                        return datasetArray.reduce(totalSum, 0);
                                    }
                                    return '';
                                }
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
                            suggestedMax: 100
                        }
                    }]
                },
            },
            plugins:[ChartDataLabels]
        });
    }


    function setGraphsubmissionDepartmentBcAssessment(result) {
        const data = {
            label: result.label,
            submittedBC: result.submittedBC,
            submittedAssessment: result.submittedAssessment,
            totalPerDepartment: result.totalPerDepartment
        };

        const ctx = document.getElementById('project-stacked-bar-chart').getContext('2d');

        const stackedBarChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: data.label.map(label => label.replace('&','amp&').split('amp')),
                datasets: [
                    {
                        label: 'Project',
                        data: data.totalPerDepartment,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderWidth: 1
                    },
                    {
                        label: 'Assessment',
                        data: data.submittedAssessment,
                        backgroundColor: 'rgba(236,175,175,0.7)',
                        borderWidth: 1
                    },
                    {
                        label: 'Business Case',
                        data: data.submittedBC,
                        backgroundColor: 'rgba(183,236,157,0.7)',
                        borderWidth: 1
                    }
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
                                align:"right",
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
                                }
                            },
                        },
                    }
                },
                scales: {
                    xAxes: [{
                        stacked: false,
                    }],
                    yAxes: [{
                        stacked: false,
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            steps: 10,
                            stepValue: 5,
                            suggestedMin: 0,
                            suggestedMax: 100
                        }
                    }]
                },
            },
            plugins:[ChartDataLabels]
        });
    }

});
