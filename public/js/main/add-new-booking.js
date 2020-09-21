$(document).ready(function () {
    var t = $('#booking-table').DataTable();
    $('#addBooking').click(function (event) {
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var roomId = $('#listRoom').find(":selected").val();
        var roomQuantity = $('#amount-of-room').val();
        var date_from = $('#date_from').val();
        var date_to = $('#date_to').val();
        // alert(name + "<br>" + email + "<br>" + phone + "<br>" + roomId + "<br>" + roomQuantity + "<br>" + date_from + "<br>" + date_to)

        $.ajax({
            url: './index.php?controller=ajax&action=addNewBooking',
            method: 'POST',
            data: { name: name, email: email, phone: phone, roomId: roomId, roomQuantity: roomQuantity, date_from: date_from, date_to: date_to },
            dataType: "JSON",
            success: function (data) {
                if (data) {
                    // t.row.add( [
                    //     counter +'.1',
                    //     counter +'.2',
                    //     counter +'.3',
                    //     counter +'.4',
                    //     counter +'.5'
                    // ] ).draw( false );
                    alert("Thêm thành công!");
                    window.location = window.location;
                } else {
                    alert("Không để dữ liệu trống!");
                }
            }
        });
    })
    $("#listHotel").change(function () {
        let hotelid = $('#listHotel').find(":selected").val();
        $("#previewCustomerHotel").html($(this).find(":selected").html());
        $.ajax({
            url: "./index.php?controller=ajax&action=getRoomForBooking",
            method: "POST",
            data: { id: hotelid },
            dataType: "JSON",
            success: function (data) {
                oldidfaciliesroom = data;
                data.forEach(function (element, index) {
                    $('#listRoom').children().remove();
                    data.forEach(function (element, index) {
                        $('#listRoom').append("<option value='" + element.id + "'>" + element.name + "</option>");
                    });
                    $("#previewCustomerRoom").html($('#listRoom').find(":selected").html());
                });
            },
            error(error) {
                console.log(eval(error));
            }
        })
    });
    $("#name").keyup(function () {
        $("#previewCustomerName").html($(this).val());
    });
    $("#phone").keyup(function () {
        $("#previewCustomerPhone").html($(this).val());
    });
    $("#email").keyup(function () {
        $("#previewCustomerEmail").html($(this).val());
    });
    $("#date_from").change(function () {
        let date_to = $('#date_to').val();
        let date_from = $('#date_from').val();
        if ((date_to != "") && (date_from != "")) {
            var dateFrom = new Date(date_from);
            var dateTo = new Date(date_to);
            var offset = dateTo.getTime() - dateFrom.getTime();
            var totalDays = Math.round(offset / 1000 / 60 / 60 / 24);
            if (totalDays <= 0) {
                $("#previewCustomerDate").html(0);
                $('#date_to').val('');
            }
            else {
                $("#previewCustomerDate").html(totalDays);
            }
        }
        $('#date_to').attr("min", date_from)
    });
    $("#date_to").change(function () {
        let date_to = $('#date_to').val();
        let date_from = $('#date_from').val();
        if ((date_to != "") && (date_from != "")) {
            var dateFrom = new Date(date_from);
            var dateTo = new Date(date_to);
            var offset = dateTo.getTime() - dateFrom.getTime();
            var totalDays = Math.round(offset / 1000 / 60 / 60 / 24);
            $("#previewCustomerDate").html(totalDays);
        }
    });
    $("#listRoom").change(function () {
        $("#previewCustomerRoom").html($(this).find(":selected").html());
    });
})
