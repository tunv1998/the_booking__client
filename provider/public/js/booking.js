$(document).ready(function () {
    // 
    // Gọi mặc định
    countHotelBooking(0);
    countRoomTypeBooked(0, 0);
    // 
    let bookingDetail = $('#booking_detail').DataTable({});
    // 
    $('.dataTables_length').addClass('bs-select');
    // 
    $("#selectHotel").change(function () {
        $("#dateFrom").val("")
        $("#dateTo").val("")
        let hotelId = $(this).val();
        $.ajax({
            url: "./?ctrl=Ajax&act=getBooking",
            method: "POST",
            dataType: "JSON",
            data: {
                'hotelId': hotelId,
            },
            success: function (data) {
                totalBookingDetail(hotelId);
                countHotelBooking(hotelId);
                bookingDetail.rows().remove().draw();
                $.each(data, function (index, value) {
                    let arr = [];
                    $.each(data[index], function (index2, value2) {
                        arr.push(value2);
                    })
                    // Thêm STT
                    arr.unshift(index + 1);
                    // 
                    bookingDetail.row.add(arr).draw();
                })
                let hideCol = bookingDetail.column($(".hidenCol"));
                hideCol.visible(!hideCol.visible());
                // 
                $.ajax({
                    url: "./?ctrl=Ajax&act=countRoomTypeBooked",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        'id': hotelId,
                    },
                    success: function (data) {
                        let cLabel = [];
                        let cData = [];
                        $.each(data, function (index, value) {
                            cLabel.push(value.name);
                            cData.push(value.count);
                        })
                        countRoomTypeBooked(cLabel, cData);
                    },
                    error(error) {
                        console.log(eval(error));
                    }
                })
            },
            error(error) {
                console.log(eval(error));
            }
        })

    })
    // Lọc datatable
    $("#dateFrom, #dateTo").on("change", function () {
        let dateFrom = moment($(this).val());
        let dateTo = moment($("#dateTo").val());
        if (dateFrom.isValid() && dateTo.isValid()) {
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    let dateFrom = moment($("#dateFrom").val());
                    let dateTo = moment($("#dateTo").val());
                    var dateBooked = data[10] || 0; // use data for the age column
                    if (dateFrom.isBefore(dateBooked) && dateTo.isAfter(dateBooked)) {
                        return true;
                    }
                    return false;
                }
            );
            bookingDetail.draw();
        }
    })
    // Reset filter
    $("#resetFilter").on("click", function () {
        $("#dateFrom").val("");
        $("#dateTo").val("");
        $.fn.dataTableExt.afnFiltering.length = 0
        bookingDetail.draw();
    })
    // Lọc bookingDetail
    $("#chooseMonthRt").change(function () {
        let hotelId = $("#selectHotel").val();
        let getVal = moment($(this).val(), "YYYY/MM");
        let month = getVal.format("M");
        let year = getVal.format("Y");
        $.ajax({
            url: "./?ctrl=Ajax&act=countRoomTypeBooked",
            method: "POST",
            dataType: "JSON",
            data: {
                'id': hotelId,
                'filter': [month, year]
            },
            success: function (data) {
                let cLabel = [];
                let cData = [];
                $.each(data, function (index, value) {
                    cLabel.push(value.name);
                    cData.push(value.count);
                })
                countRoomTypeBooked(cLabel, cData);
            },
            error(error) {
                console.log(eval(error));
            }
        })
    })
});
// Function
function totalBookingDetail(id) {
    $.ajax({
        url: "./?ctrl=Ajax&act=totalBookingDetail",
        method: "POST",
        dataType: "JSON",
        data: {
            'id': id,
        },
        success: function (data) {
            $("#allBookingHotel").text(data[0]['countBooked']);
            $("#avgStayed").text(data[0]['avg_stayed']);
            $("#countGuest").text(data[0]['total_guest']);
        },
        error(error) {
            console.log(eval(error));
        }
    })
}
function countHotelBooking(id) {
    $.ajax({
        url: "./?ctrl=booking&act=countBookingHotel",
        method: "POST",
        data: {
            'id': id,
        },
        dataType: 'JSON',
        success: function (data) {
            let cData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            if (data != -1) {
                cData = data;
            }
            let ctx = $("#countHotelBooking");
            let sum = cData.reduce(function (total, value, index) {
                return parseInt(total) + parseInt(value);
            })
            $("#sumBookingHotel").text("Tổng lượt đặt phòng là: " + sum + " lượt");
            let chartData = {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
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
                            maxTicksLimit: 12
                        },
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 100,
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
            var lineCountBooking = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: chartOptions,
            });
        },
        error(error) {
            console.log(eval(error));
        }
    })

}
function countRoomTypeBooked(cLabels, cData) {
    if (cLabels == 0 && cData == 0) {
        cLabels = ['Không có dữ liệu']
        cData = [100];
    }
    $(".chart-pie-countRt").children().remove();
    $(".chart-pie-countRt").append("<canvas id='countRoomType'></canvas>");
    let bgColor = ['#003f5c', '#2f4b7c', '#665191', '#a05195', '#d45087', '#f95d6a', '#ff7c43', '#ffa600'];
    let ctx = $("#countRoomType");
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
    // Chart.defaults.global.defaultFontSize = 14;
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: chartData,
        options: chartOptions,
    });
}