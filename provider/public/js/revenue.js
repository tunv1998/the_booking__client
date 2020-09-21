$(document).ready(function () {
    totalRevenue();
    totalRevenueMonth();
    totalRevenueYear(0);
    revenueBarChart(0, "chart-bar-hotelRevenue", "hotelRevenue");
    allHotelRevenueChart();
    $("#revenueSelectYear").keyup(function () {
        let current = $(this).val();
        totalRevenueYear(current);
    })
    $("#revenueChooseHotel").change(function () {
        let hotelId = $(this).val();
        hotelRevenue("", hotelId);
    })
    $("#revenueDetailYear").keyup(function () {
        let year = $(this).val();
        let month = $("#revenueDetailMonth").val();
        let hotelId = $("#revenueChooseHotel").val();
        if (month == "") {
            hotelRevenue(year, hotelId);
        }
        else{
            hotelRevenueMonth(month,year,hotelId);
        }
    })
    $("#revenueDetailMonth").keyup(function(){
        let month = $(this).val();
        let hotelId = $("#revenueChooseHotel").val();
        let year = $("#revenueDetailYear").val();
        if(year != "" && month != ""){
            hotelRevenueMonth(month,year,hotelId);
        }
        else if(month == ""){
            hotelRevenue(year,hotelId);
        }
    })
    function allHotelRevenueChart(){
        let cLabels = [];
        let cData = [];
        $.ajax({
            url: "./?ctrl=Ajax&act=totalRevenue",
            method: "POST",
            dataType: "JSON",
            data: {
                'filter': [],
            },
            success: function (data) {
                if (data != -1) {
                    $.each(data, function (index, value) {
                        cLabels.push(value.h_name);
                        cData.push(value.tong);
                    })
                    let sum = cData.reduce(function (total, value, index) {
                        return parseInt(total) + parseInt(value);
                    })
                    revenueBarChartLabel(cData,cLabels, "revenueAllHotel", "revenueAllHotel");
                    // $("#showTotalRevenue").text("Tổng: " + new Intl.NumberFormat().format(sum) + "đ");
                }
                else {
                    // $(".chart-pie-totalRevenue").text("Dữ liệu rỗng");
                }
            },
            error(error) {
                console.log(eval(error));
            }
        })
    }
    // Doanh thu 30 ngày của khách sạn
    function hotelRevenueMonth(month, year, hotelId) {
        $.ajax({
            url: "./?ctrl=revenue&act=hotelRevenueMonth",
            method: "POST",
            dataType: "JSON",
            data: {
                // Chỉnh tháng
                'month': month,
                'year': year,
                'hotelId': hotelId,

            },
            success: function (data) {
                if (data != -1) {
                    let sum = data.reduce(function (total, value, index) {
                        return parseInt(total) + parseInt(value);
                    })
                    $("#sumHotelRevenue").text("Tổng doanh thu: " + new Intl.NumberFormat().format(sum) + "đ");
                }
                else {
                    data = [];
                    for (let index = 0; index < 30; index++) {
                        data.push(0);
                    }
                    $("#sumHotelRevenue").text("Tổng doanh thu: 0");
                }
                revenueLineChart(data, "chart-bar-hotelRevenue", "hotelRevenue");
            },
            error(error) {
                console.log(eval(error));
            }
        })
    }
    // Tổng doanh thu một khách sạn theo năm và hotel id
    function hotelRevenue(year, hotelId) {
        $.ajax({
            url: "./?ctrl=revenue&act=totalRevenueYear",
            method: "POST",
            dataType: "JSON",
            data: {
                'year': year,
                'hotelId': hotelId
            },
            success: function (data) {
                if (data != -1) {
                    let sum = data.reduce(function (total, value, index) {
                        return parseInt(total) + parseInt(value);
                    })
                    $("#sumHotelRevenue").text("Tổng doanh thu: " + new Intl.NumberFormat().format(sum) + "đ");
                }
                else {
                    data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                    $("#sumHotelRevenue").text("Tổng doanh thu: 0");
                }
                revenueBarChart(data, "chart-bar-hotelRevenue", "hotelRevenue");
            },
            error(error) {
                console.log(eval(error));
            }
        })
    }
    function totalRevenueMonth() {
        let cLabels = [];
        let cData = [];
        let current = moment();
        let month = current.format("M");
        let year = current.format("Y");
        $.ajax({
            url: "./?ctrl=Ajax&act=totalRevenue",
            method: "POST",
            dataType: "JSON",
            data: {
                // Chỉnh tháng
                'filter': [parseInt(month), parseInt(year)],
            },
            success: function (data) {
                if (data != -1) {
                    $.each(data, function (index, value) {
                        cLabels.push(value.h_name);
                        cData.push(value.tong);
                    })
                    let sum = cData.reduce(function (total, value, index) {
                        return parseInt(total) + parseInt(value);
                    })
                    $("#showTotalRevenueMonth").text("Tổng: " + new Intl.NumberFormat().format(sum) + "đ");
                    revenuePieChart(cLabels, cData, "chart-pie-totalRevenueMonth", "totalRevenueMonth");
                }
                else {
                    $(".chart-pie-totalRevenueMonth").children().remove();
                    $(".chart-pie-totalRevenueMonth").append("<h5>Dữ liệu rỗng</h5>");
                }
            },
            error(error) {
                console.log(eval(error));
            }
        })
    }
    function totalRevenue() {
        let cLabels = [];
        let cData = [];
        $.ajax({
            url: "./?ctrl=Ajax&act=totalRevenue",
            method: "POST",
            dataType: "JSON",
            data: {
                'filter': [],
            },
            success: function (data) {
                if (data != -1) {
                    $.each(data, function (index, value) {
                        cLabels.push(value.h_name);
                        cData.push(value.tong);
                    })
                    let sum = cData.reduce(function (total, value, index) {
                        return parseInt(total) + parseInt(value);
                    })
                    revenuePieChart(cLabels, cData, "chart-pie-totalRevenue", "totalRevenue");
                    $("#showTotalRevenue").text("Tổng: " + new Intl.NumberFormat().format(sum) + "đ");
                }
                else {
                    $(".chart-pie-totalRevenue").text("Dữ liệu rỗng");
                }
            },
            error(error) {
                console.log(eval(error));
            }
        })
    }
    function totalRevenueYear(year) {
        $.ajax({
            url: "./?ctrl=revenue&act=totalRevenueYear",
            method: "POST",
            dataType: "JSON",
            data: {
                'year': year,
            },
            success: function (data) {
                if (data != -1) {
                    let sum = data.reduce(function (total, value, index) {
                        return parseInt(total) + parseInt(value);
                    })
                    $("#sumRevenueYear").text("Tổng doanh thu: " + new Intl.NumberFormat().format(sum) + "đ");
                }
                else {
                    data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                    $("#sumRevenueYear").text("Tổng doanh thu: 0");
                }
                revenueBarChart(data, "chart-bar-totalRevenueYear", "totalRevenueYear");
            },
            error(error) {
                console.log(eval(error));
            }
        })

    }
})
function revenuePieChart(cLabels, cData, remove, id) {
    $("." + remove).children().remove();
    $("." + remove).append("<canvas id='" + id + "'></canvas>");
    let bgColor = ['#003f5c', '#2f4b7c', '#665191', '#a05195', '#d45087', '#f95d6a', '#ff7c43', '#ffa600'];
    let ctx = $("#" + id);
    let chartData = {
        labels: cLabels,
        datasets: [{
            fill: true,
            data: cData,
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
                        sum += parseInt(data);
                    });
                    let percentage = (value * 100 / sum).toFixed(2) + "%";
                    return percentage;
                },
            }
        }
    };
    Chart.defaults.global.defaultFontFamily = 'roboto';
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: chartData,
        options: chartOptions,
    });
}
function revenueBarChart(cData, remove, id) {
    if(cData == 0){
        cData = [0,0,0,0,0,0,0,0,0,0,0,0];
    }
    $("." + remove).children().remove();
    $("." + remove).append("<canvas id='" + id + "'></canvas>");
    let bgColor = ['#003f5c', '#2f4b7c', '#665191', '#a05195', '#d45087', '#f95d6a', '#ff7c43', '#ffa600', '#fd6c7e', '#f7436f', '#fbd05b', '#f9a746', '#e65b2b',];
    let ctx = $("#" + id);
    let chartData = {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
        datasets: [{
            label: "",
            backgroundColor: bgColor,
            hoverBackgroundColor: "#2874A6",
            borderColor: "#4e73df",
            data: cData,
            maxBarThickness: 50,
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
                    max: 3000000000,
                    maxTicksLimit: 10,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function (value, index, values) {
                        return value + " đồng";
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
                    return datasetLabel + tooltipItem.yLabel + " đồng";
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
    var defaultChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: chartOptions,
    });
}
function revenueBarChartLabel(cData,cLabel, remove, id) {
    if(cData == 0){
        cData = [0,0,0,0,0,0,0,0,0,0,0,0];
    }
    $("." + remove).children().remove();
    $("." + remove).append("<canvas id='" + id + "'></canvas>");
    let bgColor = ['#003f5c', '#2f4b7c', '#665191', '#a05195', '#d45087', '#f95d6a', '#ff7c43', '#ffa600', '#fd6c7e', '#f7436f', '#fbd05b', '#f9a746', '#e65b2b',];
    let ctx = $("#" + id);
    let chartData = {
        labels: cLabel,
        datasets: [{
            label: "",
            backgroundColor: bgColor,
            hoverBackgroundColor: "#2874A6",
            borderColor: "#4e73df",
            data: cData,
            maxBarThickness: 50,
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
                    max: 5000000000,
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function (value, index, values) {
                        return value + " đồng";
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
                    return datasetLabel + tooltipItem.yLabel + " đồng";
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
    var defaultChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: chartOptions,
    });
}
function revenueLineChart(cData, remove, id) {
    $("." + remove).children().remove();
    $("." + remove).append("<canvas id='" + id + "'></canvas>");
    let cLabels = [];
    for (let index = 0; index < 30; index++) {
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
                    max: 600000000,
                    maxTicksLimit: 6,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function (value, index, values) {
                        return value + " đồng";
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
                    return datasetLabel + tooltipItem.yLabel + " đồng";
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