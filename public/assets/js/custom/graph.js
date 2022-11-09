$(function (){
    var _graph_canvas = $("#stacked-bar-chart");
    if(_graph_canvas.length > 0){
        $.ajax({
            url:'/getDataGraph',
            success:function (result){
                setGraph(result)
            }
        })

        function setGraph(result){
            var labelArray = ['Betterment','Sustainability and Development','Replacement','R&D'],
                productive = result.productive,
                administrative = result.administrative,
                environment = result.environment,
                health_and_safety = result.occupational_health_and_safety,
                technology = result.technology_and_process_development,
                engineering = result.engineering,
                geological = result.geological_research,
                social = result.social;

            var ctx = document.getElementById('stacked-bar-chart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labelArray,
                    datasets: [
                        {
                            label: 'Productive',
                            data: productive,
                            backgroundColor: 'rgb(0,166,149)',
                            borderColor: 'rgb(0,166,149)',
                            borderWidth: 1
                        },
                        {
                            label: 'Administrative',
                            data: administrative,
                            backgroundColor: 'rgb(229,117,31)',
                            borderColor: 'rgb(229,117,31)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Environment',
                            data: environment,
                            backgroundColor: 'rgb(179,179,179)',
                            borderColor: 'rgb(179,179,179)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Occupational Health and Safety',
                            data: health_and_safety,
                            backgroundColor: 'rgb(83,219,240)',
                            borderColor: 'rgb(83,219,240)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Technology and Process Development',
                            data: technology,
                            backgroundColor: 'rgb(255,204,153)',
                            borderColor: 'rgb(255,204,153)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Engineering',
                            data: engineering,
                            backgroundColor: 'rgb(145,81,81)',
                            borderColor: 'rgb(145,81,81)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Geological Research',
                            data: geological,
                            backgroundColor: 'rgb(179,182,103)',
                            borderColor: 'rgb(179,182,103)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Social / Community / Reputation',
                            data: social,
                            backgroundColor: 'rgb(250,70,57)',
                            borderColor: 'rgb(250,70,57)',
                            borderWidth: 1,
                        }
                    ]
                },
                options: {
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    },
                }
            });
        }
    }
});
