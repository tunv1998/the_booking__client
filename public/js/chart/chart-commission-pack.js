$.ajax({
  url: "./index.php?controller=ajax&action=getDoanhThuDichVuTheoThang",
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


//Chart 4
var commissionByYearCtx = document.getElementById("commissionByYear");
var commissionByYearChart = new Chart(commissionByYearCtx, {
  type: "bar",
  data: {
    labels: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
    datasets: [
      {
        label: "Compare Revenue",
        // lineTension: 0.3,
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        // pointRadius: 3,
        // pointBackgroundColor: "rgba(78, 115, 223, 1)",
        // pointBorderColor: "rgba(78, 115, 223, 1)",
        // pointHoverRadius: 3,
        // pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        // pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        // pointHitRadius: 10,
        // pointBorderWidth: 2,
        data: commissionYear,
      },
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
            maxTicksLimit: 5,
            padding: 10,
          },
        },
      ],
    },
  },
});
