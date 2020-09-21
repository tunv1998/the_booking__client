$(document).ready(function () {
    var myTable = $('#booking-table').DataTable();
    $('#booking-table').on('dblclick', 'tbody td:not(:first-child)', function (e) {
        let stt = $(this).attr("stt");
        if (stt == 0) {
            $(this).attr("stt", 1)
            let uid = $(this).attr("uid");
            let datavalue = $(this).attr("datavalue");
            $(this).children().remove();
            $(this).append("<input type=number id=roomEdit uid=" + uid + " value=" + datavalue + ">");
            $("#roomEdit").focus();
        }
    });
    $('#booking-table').on('blur', '#roomEdit', function (e) {
        let parent = $(this).parent();
        $(parent).attr("stt", 0)
        $(parent).attr("datavalue", $(this).val());
        let uid = $(parent).attr("uid");
        let datavalue = $(parent).attr("datavalue");
        $(this).remove();
        $(parent).append(' <div class="text-sm leading-5 text-gray-900">' + datavalue + '</div>');
        $.ajax({
            url: "./index.php?controller=ajax&action=changeRoomQuantityBooking",
            method: "POST",
            data: { id: uid, room: datavalue },
            dataType: "JSON",
            success: function (data) {
                if (data) {
                    alert('Cập nhật thành công!');
                } else {
                    alert('Lỗi!');
                }
            },
            error(error) {
                console.log(eval(error));
            }
        })
    });


});