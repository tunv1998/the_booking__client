// $(document).ready(function () {
//   $("#provider-table").DataTable();
// });

$(document).ready(function () {
  var table = $("#provider-table")
    .DataTable({
      responsive: true,
    })
    .columns.adjust()
    .responsive.recalc();
});
$(document).ready(function () {
  var table = $("#booking-table")
    .DataTable({
      responsive: true,
      "order": [[0, "desc"]]
    })
    .columns.adjust()
    .responsive.recalc();
});
