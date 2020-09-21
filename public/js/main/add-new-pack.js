$(document).ready(function () {
    $(function () {
        var files = $("#files");

        $("#sltAvatar").fileupload({
            url: './index.php?controller=ajax&action=addImage',
            dropZone: '#dropZone',
            dataType: 'json',
            autoUpload: false
        }).on('fileuploadadd', function (e, data) {
            console.log(data);
            var fileTypeAllowed = /.\.(gif|jpg|png|jpeg)$/i;
            var fileName = data.originalFiles[0]['name'];
            var fileSize = data.originalFiles[0]['size'];

            if (!fileTypeAllowed.test(fileName))
                $("#error").html('Sai định dạng hình!');
            else if (fileSize > 800000)
                $("#error").html('Dung lượng hình ảnh quá lớn! Tối đa:800KB');
            else {
                $("#error").html("");
                data.submit();
            }
        }).on('fileuploaddone', function (e, data) {
            var status = data.jqXHR.responseJSON.status;
            var msg = data.jqXHR.responseJSON.msg;

            if (Number(status)) {
                $("#form").append("<input type='hidden' id='orderid' name='orderid' value='" + status + "' />");
            }
        }).on('fileuploadprogressall', function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $("#progress").html("Completed: " + progress + "%");
        });
    });
    $('#form').submit(function (event) {
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: "./index.php?controller=ajax&action=addNewPagkage",
            method: "POST",
            data: data,
            success: function (data) {
                // alert(data);
                $('#form')[0].reset();
                window.location = window.location;
            }
        });
    });
    $('#addPack').click(function (event) {
        var orderid = $('#orderid').val();
        var selector = get_filter('comment_selecter');
        // alert(selector);
        $.ajax({
            url: './index.php?controller=ajax&action=addNewPagkageOption', // gửi đến file upload.php 
            method: 'POST',
            data: { selector: selector, orderid: orderid },
            success: function (data) {
                // alert(data);
                window.location = window.location;
            }
        });
    })
    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function () {
            filter.push($(this).val());
        });
        return filter;
    }
})
