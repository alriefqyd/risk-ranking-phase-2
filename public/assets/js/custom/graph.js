$(function (){
    var _graph_canvas = $("#stacked-bar-chart");
    if(_graph_canvas.length > 0){
        $.ajax({
            url:'/getDataGraph',
            success:function (result){
                setGraph(result)
            }
        });

        function setGraph(result){
            var labelArray = ['Sustaining','R & D','Growth'],
                margin = result.margin,
                maintain = result.maintain,
                hsor = result.hsor,
                sustainability = result.sustainability,
                administrative = result.administrative,
                engineering = result.engineering,
                exploration = result.exploration,
                innovation_technology = result.innovation_technology;
                volume_growth = result.volume_growth;
                volume_replacement = result.volume_replacement;

            var ctx = document.getElementById('stacked-bar-chart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labelArray,
                    datasets: [
                        {
                            label: 'Margin',
                            data: margin,
                            backgroundColor: 'rgb(0,166,149)',
                            borderColor: 'rgb(0,166,149)',
                            borderWidth: 1
                        },
                        {
                            label: 'Maintain Capacity',
                            data: maintain,
                            backgroundColor: 'rgb(229,117,31)',
                            borderColor: 'rgb(229,117,31)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Health & Safety',
                            data: hsor,
                            backgroundColor: 'rgb(179,179,179)',
                            borderColor: 'rgb(179,179,179)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Sustainability',
                            data: sustainability,
                            backgroundColor: 'rgb(83,219,240)',
                            borderColor: 'rgb(83,219,240)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Administrative',
                            data: administrative,
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
                            label: 'Exploration',
                            data: exploration,
                            backgroundColor: 'rgb(179,182,103)',
                            borderColor: 'rgb(179,182,103)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Innovation Technology',
                            data: innovation_technology,
                            backgroundColor: 'rgb(250,70,57)',
                            borderColor: 'rgb(250,70,57)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Volume Growth',
                            data: volume_growth,
                            backgroundColor: 'rgb(255,204,153)',
                            borderColor: 'rgb(255,204,153)',
                            borderWidth: 1,
                        },
                        {
                            label: 'Volume Replacement',
                            data: volume_replacement,
                            backgroundColor: 'rgb(83,219,240)',
                            borderColor: 'rgb(83,219,240)',
                            borderWidth: 1,
                        },

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
