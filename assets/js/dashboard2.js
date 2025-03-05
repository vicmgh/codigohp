$(function () {
    'use strict'
    const action = "sales";
    $.ajax({
        url: 'chart2.php',
        type: 'POST',
        data: {
            action
        },
        async: true,
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                try {
                    var ticksStyle = {
                        fontColor: '#495057',
                        fontStyle: 'bold'
                    }
                
                    var mode = 'index'
                    var intersect = true
                
                    var $salesChart = $('#sales-chart')
                    // eslint-disable-next-line no-unused-vars
                    var salesChart = new Chart($salesChart, {
                        type: 'bar',
                        data: {
                            labels: ['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom'],
                            datasets: [
                                {
                                    backgroundColor: '#007bff',
                                    borderColor: '#007bff',
                                    //data: [10, 50, 0, 10, 60, 100, 70]
                                   data: [data.Lun, data.Mar, data.Mie, data.Jue, data.Vie, data.Sab, data.Dom]
                                }
                            ]
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                mode: mode,
                                intersect: intersect
                            },
                            hover: {
                                mode: mode,
                                intersect: intersect
                            },
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    // display: false,
                                    gridLines: {
                                        display: true,
                                        lineWidth: '4px',
                                        color: 'rgba(0, 0, 0, .2)',
                                        zeroLineColor: 'transparent'
                                    },
                                    ticks: $.extend({
                                        beginAtZero: true,
                
                                        // Include a dollar sign in the ticks
                                        callback: function (value) {
                                            if (value >= 1000) {
                                                value /= 1000
                                                value += 'k'
                                            }
                
                                            return '$' + value
                                        }
                                    }, ticksStyle)
                                }],
                                xAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: ticksStyle
                                }]
                            }
                        }
                    })
                } catch (error) {
                    console.log(error);
                }
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
    
})