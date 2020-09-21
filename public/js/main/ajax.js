function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
}
$(document).ready(function () {
    var tableUserAccount = $('#provider-table').DataTable();
    $('#provider-table tbody').on('click', 'a.changeUserAcount', function () {
        let uid = $(this).attr("uid");
        let tk = $(this).attr("tk");
        let parent = $(this).parents('tr');
        event.preventDefault();
        let confirm = prompt("Nhập YES để xác nhận xóa:");
        var tableUserAccount = $('#provider-table').DataTable();
        if (confirm === "YES") {
            $.ajax({
                url: "./index.php?controller=ajax&action=changeStatusUserAccount",
                method: "POST",
                data: { id: uid },
                dataType: "JSON",
                success: function (data) {
                    if (data) {
                        alert('Đã xóa tài khoản: ' + tk);
                        tableUserAccount
                            .row(parent)
                            .remove()
                            .draw();
                        $('#totalAccount').html(data[0]);
                        $('#totalAccountThisMonth').html(data[1]);
                    } else {
                        alert('Lỗi!');
                    }
                },
                error(error) {
                    console.log(eval(error));
                }
            })
        }
        else {
            alert("Hủy bỏ yêu cầu");
        }

    });
    $('#booking-table tbody').on('click', 'a.changeBooking', function () {
        let uid = $(this).attr("uid");
        let parent = $(this).parents('tr');
        event.preventDefault();
        let confirm = prompt("Nhập YES để xác nhận xóa:");
        var tableUserAccount = $('#booking-table').DataTable();
        if (confirm === "YES") {
            $.ajax({
                url: "./index.php?controller=ajax&action=changeStatusBooking",
                method: "POST",
                data: { id: uid },
                dataType: "JSON",
                success: function (data) {
                    if (data) {
                        alert('Đã xóa đơn hàng: ' + uid);
                        tableUserAccount
                            .row(parent)
                            .remove()
                            .draw();
                        $('#totalFee').html(data[0]);
                        $('#totalFeeThisMonth').html(data[1]);
                        $('#countFee').html(data[2]);
                        $('#countFeeThisMonth').html(data[3]);
                    } else {
                        alert('Lỗi!');
                    }
                },
                error(error) {
                    console.log(eval(error));
                }
            })
        }
        else {
            alert("Hủy bỏ yêu cầu");
        }

    });

    $(".changeYearTotalFee").click(function () {
        let year = $(this).attr("year");
        if (isNaN(year)) {
            year = 2020;
        }
        $.ajax({
            url: "./index.php?controller=ajax&action=getDoanhThuDichVuTheoThang",
            method: "POST",
            data: { year: year },
            dataType: "JSON",
            success: function (data) {
                $('#chooseYearTotalFee').html('Năm ' + year);
                var thang = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12',];
                var tong = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                for (var i in data) {
                    strThang = 'Tháng ' + data[i].thang;
                    if (thang.indexOf(strThang) > -1) {
                        tong[thang.indexOf(strThang)] = data[i].tong;
                    }
                }
                var commAndPackCtx = document.getElementById("commAndPack");
                var commAndPackChart = new Chart(commAndPackCtx, {
                    type: "line",
                    data: {
                        labels: thang,
                        datasets: [
                            {
                                label: "Phí dịch vụ",
                                data: tong,
                                borderColor: "tomato",
                                backgroundColor: "rgba(0,0,0,0)",
                            },
                            // {
                            //   label: "Pack Revenue",
                            //   data: packWeek,
                            //   borderColor: "lightBlue",
                            //   backgroundColor: "rgba(0,0,0,0)",
                            // },
                        ],
                    },
                    options: {
                        scales: {
                            xAxes: [
                                {
                                    time: {
                                        unit: "date",
                                    },
                                    gridLines: {
                                        display: false,
                                        drawBorder: false,
                                    },
                                    ticks: {
                                        maxTicksLimit: 7,
                                    },
                                },
                            ],
                            yAxes: [
                                {
                                    ticks: {
                                        maxTicksLimit: 7,
                                        padding: 10,
                                        // Include a dollar sign in the ticks
                                        callback: function (value, index, values) {
                                            return number_format(value) + " vnd";
                                        },
                                    },
                                    gridLines: {
                                        color: "rgb(234, 236, 244)",
                                        zeroLineColor: "rgb(234, 236, 244)",
                                        drawBorder: false,
                                        borderDash: [2],
                                        zeroLineBorderDash: [2],
                                    },
                                },
                            ],
                        },
                        tooltips: {
                            mode: "index",
                            caretPadding: 10,
                            callbacks: {
                                label: function (tooltipItem, chart) {
                                    var datasetLabel =
                                        chart.datasets[tooltipItem.datasetIndex].label || "";
                                    return (
                                        datasetLabel + " : " + number_format(tooltipItem.yLabel) + " vnd"
                                    );
                                },
                            },
                        },
                    },
                });
            },
            error(error) {
                console.log(eval(error));
            }
        })
    });

    $(".changeYearCountFee").click(function () {
        let year = $(this).attr("year");
        if (isNaN(year)) {
            year = 2020;
        }
        $.ajax({
            url: "./index.php?controller=ajax&action=getLuotDatHangTheoThang",
            method: "POST",
            data: { year: year },
            dataType: "JSON",
            success: function (data) {
                $('#chooseYearCountFee').html('Năm ' + year);
                var thang = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12',];
                var tong = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                for (var i in data) {
                    strThang = 'Tháng ' + data[i].thang;
                    if (thang.indexOf(strThang) > -1) {
                        tong[thang.indexOf(strThang)] = data[i].tong;
                    }
                }
                var countBookingCtx = document.getElementById("countBooking");
                var countBookingChart = new Chart(countBookingCtx, {
                    type: "line",
                    data: {
                        labels: thang,
                        datasets: [
                            {
                                label: "Lượt",
                                data: tong,
                                borderColor: "lightBlue",
                                backgroundColor: "rgba(0,0,0,0)",
                            },
                            // {
                            //   label: "Pack Revenue",
                            //   data: packWeek,
                            //   borderColor: "lightBlue",
                            //   backgroundColor: "rgba(0,0,0,0)",
                            // },
                        ],
                    },
                    options: {
                        scales: {
                            xAxes: [
                                {
                                    time: {
                                        unit: "date",
                                    },
                                    gridLines: {
                                        display: false,
                                        drawBorder: false,
                                    },
                                    ticks: {
                                        maxTicksLimit: 7,
                                    },
                                },
                            ],
                            yAxes: [
                                {
                                    ticks: {
                                        maxTicksLimit: 7,
                                        padding: 10,
                                        // Include a dollar sign in the ticks
                                        callback: function (value, index, values) {
                                            return number_format(value) + " lượt";
                                        },
                                    },
                                    gridLines: {
                                        color: "rgb(234, 236, 244)",
                                        zeroLineColor: "rgb(234, 236, 244)",
                                        drawBorder: false,
                                        borderDash: [2],
                                        zeroLineBorderDash: [2],
                                    },
                                },
                            ],
                        },
                        tooltips: {
                            mode: "index",
                            caretPadding: 10,
                            callbacks: {
                                label: function (tooltipItem, chart) {
                                    var datasetLabel =
                                        chart.datasets[tooltipItem.datasetIndex].label || "";
                                    return (
                                        datasetLabel + " : " + number_format(tooltipItem.yLabel) + " lượt"
                                    );
                                },
                            },
                        },
                    },
                });
            },
            error(error) {
                console.log(eval(error));
            }
        })
    });

    $('#provider-table tbody').on('click', 'a.changeReview', function () {
        let uid = $(this).attr("uid");
        let parent = $(this).parents('tr');
        event.preventDefault();
        let confirm = prompt("Nhập YES để xác nhận xóa:");
        var tableUserAccount = $('#provider-table').DataTable();
        if (confirm === "YES") {
            $.ajax({
                url: "./index.php?controller=ajax&action=changeStatusReview",
                method: "POST",
                data: { id: uid },
                dataType: "JSON",
                success: function (data) {
                    if (data) {
                        alert('Đã xóa id: ' + uid);
                        tableUserAccount
                            .row(parent)
                            .remove()
                            .draw();
                        $('#totalReview').html(data[0]);
                        $('#totalReviewThisMonth').html(data[1]);
                    } else {
                        alert('Lỗi!');
                    }
                },
                error(error) {
                    console.log(eval(error));
                }
            })
        }
        else {
            alert("Hủy bỏ yêu cầu");
        }
    });

});