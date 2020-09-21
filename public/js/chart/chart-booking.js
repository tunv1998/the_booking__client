$.ajax({
  url: "./index.php?controller=ajax&action=getLuotDatHangTheoThang",
  method: "POST",
  data: {},
  dataType: "JSON",
  success: function (data) {
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