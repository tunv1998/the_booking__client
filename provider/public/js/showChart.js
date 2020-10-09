$(document).ready(function () {
    countAllBooking();
    countAllBookingMonth();
    ajaxCountBookingYear();
    ratingLineChart(0, "chart-bar-countRating", "countRating");
    // 
    let ratingDetail = $('#rating_detail').DataTable(
        {
            
        }
    );
    // 
    $('.dataTables_length').addClass('bs-select');
    // 
    // 
    $("#bookingSelectYear").keyup(function () {
        let year = $(this).val();
        ajaxCountBookingYear(year);
    })
    // 
    $("#selectHotelRating").change(function () {
        let hotelId = $(this).val();
        $.ajax({
            url: "./?ctrl=hotel&act=countRating",
            method: "POST",
            data: {
                'id': hotelId
            },
            dataType: "JSON",
            success: function (data) {
                let cData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                if (data != -1) {
                    cData = data;
                }
                let sum = cData.reduce(function (total, value, index) {
                    return parseInt(total) + parseInt(value);
                })
                $("#sumAllRating").text(sum);
                $("#sumRating").text("Tổng lượt đánh giá: " + sum + " lượt");
                ratingLineChart(cData, "chart-bar-countRating", "countRating");
            },
            error(error) {
                console.log(eval(error));
            }
        })
        $.ajax({
            url: "./?ctrl=hotel&act=getRatingDetail",
            method: "POST",
            data: {
                'id': hotelId
            },
            dataType: "JSON",
            success: function (data) {
                if (data != -1) {
                    ratingDetail.rows().remove().draw();
                    $.each(data, function (index, value) {
                        let arr = [];
                        $.each(data[index], function (index2, value2) {
                            arr.push(value2);
                        })
                        // Thêm STT
                        arr.unshift(index + 1);
                        // 
                        ratingDetail.row.add(arr).draw();
                    })
                }

            },
            error(error) {
                console.log(eval(error));
            }
        })
        $.ajax({
            url: "./?ctrl=hotel&act=getAvgRating",
            method: "POST",
            data: {
                'id': hotelId
            },
            dataType: "JSON",
            success: function (data) {
                if (data != -1) {
                    let num = parseFloat(data[0]['rating']).toFixed(1);
                    $("#avgRating").text(num);
                }

            },
            error(error) {
                console.log(eval(error));
            }
        })
    })
    // 
    $("#ratingChooseYear").keyup(function () {
        let hotelId = $("#selectHotelRating").val();
        let year = $(this).val();
        $.ajax({
            url: "./?ctrl=hotel&act=countRating",
            method: "POST",
            data: {
                'id': hotelId,
                'year': year
            },
            dataType: "JSON",
            success: function (data) {
                let cData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                if (data != -1) {
                    cData = data;
                }
                let sum = cData.reduce(function (total, value, index) {
                    return parseInt(total) + parseInt(value);
                })
                $("#sumRating").text("Tổng lượt đánh giá: " + sum + " lượt");
                ratingLineChart(cData, "chart-bar-countRating", "countRating");
            },
            error(error) {
                console.log(eval(error));
            }
        })

    })
    // 
    // function
    // Gọi ajax lấy dữ liệu cho countAllBooking
    function countAllBooking() {
        let sData = [];
        let cLabels = [];
        $.ajax({
            url: "./?ctrl=booking&act=countAllBooking",
            method: "POST",
            data: {},
            dataType: "JSON",
            success: function (data) {
                // test

                $.each(data, function (index, value) {
                    let num = parseInt(value['countNum']);
                    sData.push(num);
                    cLabels.push(value['h_name']);
                })
                let sum = sData.reduce(function (total, value, index) {
                    return parseInt(total) + parseInt(value);
                })
                $("#sumAllBooking").text("Tổng lượt đặt phòng: " + sum + " lượt");
                let bgColor = ['#003f5c', '#2f4b7c', '#665191', '#a05195', '#d45087', '#f95d6a', '#ff7c43', '#ffa600'];
                let ctx = $("#countAllBooking");
                let chartData = {
                    labels: cLabels,
                    datasets: [{
                        fill: true,
                        data: sData,
                        backgroundColor: bgColor,
                        hoverBorderColor: ['#c9c9c9'],
                    }],
                };
                let chartOptions = {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: true,
                        position: 'right',
                        labels: {
                            fontSize: 13,
                        }
                    },
                    cutoutPercentage: 50,
                    layout: {
                        padding: {
                            left: 5,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    },
                    plugins: {
                        datalabels: {
                            color: '#fff',
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                let percentage = (value * 100 / sum).toFixed(2) + "%";
                                return percentage;
                            },
                        }
                    }
                };
                Chart.defaults.global.defaultFontFamily = 'roboto';
                // Chart.defaults.global.defaultFontSize = 14;
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: chartData,
                    options: chartOptions,
                });
            },
            error(error) {
                console.log(eval(error));
            }
        })
    }
    // 
    function ajaxCountBookingYear(year = 0) {
        if (year == 0) {
            let current = moment();
            year = current.format("Y");
        }
        $.ajax({
            url: "./?ctrl=Ajax&act=countBookingYear",
            method: "POST",
            dataType: "JSON",
            data: {
                // Chỉnh tháng
                'year': year,
            },
            success: function (data) {
                if (data != -1) {
                    countBookingYear(data, "chart-bar-totalBookingYear", "totalBookingYear");
                    let sum = data.reduce(function (total, value, index) {
                        return parseInt(total) + parseInt(value);
                    })
                    $("#sumBookingYear").text("Tổng lượt đặt phòng: " + sum + " lượt");
                }
                else {
                    let dataDefault = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                    $("#sumBookingYear").text("Tổng lượt đặt phòng: 0 lượt");
                    countBookingYear(dataDefault, "chart-bar-totalBookingYear", "totalBookingYear");
                }
            },
            error(error) {
                console.log(eval(error));
            }
        })
    }
    // 
    function countBookingYear(cData, remove, id) {
        $("." + remove).children().remove();
        $("." + remove).append("<canvas id='" + id + "'></canvas>");
        let bgColor = ['#003f5c', '#2f4b7c', '#665191', '#a05195', '#d45087', '#f95d6a', '#ff7c43', '#ffa600', '#fd6c7e', '#f7436f', '#fbd05b', '#f9a746', '#e65b2b',];
        let ctx = $("#" + id);
        let chartData = {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [{
                label: "",
                backgroundColor: bgColor,
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#47a5e1d1",
                data: cData,
                maxBarThickness: 40,
            }],
        };
        let chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: true,
                        drawBorder: true
                    },
                    ticks: {
                        maxTicksLimit: 12
                    },
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 500,
                        maxTicksLimit: 10,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return value + " lượt";
                        }
                    },
                }],
            },
            legend: {
                display: false,
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 30,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + tooltipItem.yLabel + " lượt đặt";
                    }
                },
            },
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    formatter: Math.round,
                    font: {
                        color: '#fff',
                    }
                }
            }
        };
        Chart.defaults.global.defaultFontFamily = 'roboto';
        var totalBookingYear = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: chartOptions,
        });
    }
    function countAllBookingMonth() {
        let sData = [];
        let cLabels = [];
        $.ajax({
            url: "./?ctrl=booking&act=countAllBookingMonth",
            method: "POST",
            data: {},
            dataType: "JSON",
            success: function (data) {
                $.each(data, function (index, value) {
                    let num = parseInt(value['countNum']);
                    sData.push(num);
                    cLabels.push(value['h_name']);
                })
                let sum = sData.reduce(function (total, value, index) {
                    return parseInt(total) + parseInt(value);
                })
                $("#sumAllBookingMonth").text("Tổng lượt đặt phòng: " + sum + " lượt");
                let bgColor = ['#fd6c7e', '#f7436f', '#fbd05b', '#f9a746', '#e65b2b', '#c74626', '#cd2465', '#e82966'];
                let ctx = $("#countAllBookingMonth");
                let chartData = {
                    labels: cLabels,
                    datasets: [{
                        fill: true,
                        data: sData,
                        backgroundColor: bgColor,
                        hoverBorderColor: ['#c9c9c9'],
                    }],
                };
                let chartOptions = {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: true,
                        position: 'right',
                        labels: {
                            fontSize: 13,
                        }
                    },
                    cutoutPercentage: 50,
                    layout: {
                        padding: {
                            left: 5,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    },
                    plugins: {
                        datalabels: {
                            color: '#fff',
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                let percentage = (value * 100 / sum).toFixed(2) + "%";
                                return percentage;
                            },
                        }
                    }
                };
                Chart.defaults.global.defaultFontFamily = 'roboto';
                // Chart.defaults.global.defaultFontSize = 14;
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: chartData,
                    options: chartOptions,
                });
            },
            error(error) {
                console.log(eval(error));
            }
        })
    }
    function ratingLineChart(cData, remove, id) {
        $("." + remove).children().remove();
        $("." + remove).append("<canvas id='" + id + "'></canvas>");
        if (cData == 0) {
            cData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        }
        let cLabels = [];
        for (let index = 0; index < 12; index++) {
            cLabels.push("Ngày " + (index + 1));
        }
        let ctx = $("#" + id);
        let chartData = {
            labels: cLabels,
            datasets: [{
                label: "",
                backgroundColor: ['#76abcd14'],
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#47a5e1d1",
                data: cData,
                maxBarThickness: 35,
            }],
        };
        let chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: true,
                        drawBorder: true
                    },
                    ticks: {
                        maxTicksLimit: 15
                    },
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 50,
                        maxTicksLimit: 6,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return value + " lượt";
                        }
                    },
                }],
            },
            legend: {
                display: false,
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 30,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + tooltipItem.yLabel + " lượt";
                    }
                },
            },
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    formatter: Math.round,
                    font: {
                        color: '#fff',
                    }
                }
            }
        };
        Chart.defaults.global.defaultFontFamily = 'roboto';
        var lineCountBooking = new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: chartOptions,
        });
    }
})