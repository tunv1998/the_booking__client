$('#update_button').click(function () {
    var to_day = $('#to_day').val();
    var from_day = $('#from_day').val();
    var id = $('#packlog_id').val();
    var selector = get_filter('reason_provider');
    var action = "Update";
    // alert(selector);
    $.ajax({
        url: './index.php?controller=ajax&action=updateProvider', // gửi đến file upload.php 
        method: 'POST',
        data: {
            action: action,
            selector: selector,
            id: id,
            to_day: to_day,
            from_day: from_day
        },
        success: function (data) {
            // alert(data);
            if(data==""){
                alert("Cập nhật thành công!");
                window.location = window.location;
            }else{
                alert("Cập nhật thất bại!");
                return false;
            }            
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