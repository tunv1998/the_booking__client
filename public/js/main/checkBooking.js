$(document).ready(function(){
        $('#showDetail').show();
        $('#showBooking').hide();
        var name_expression = /^[a-z ,.'-]+$/i;
        var email_expression = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/;
        var phone = /^0[0-9]{9,10}$/;
    $('#submitCheckout').on('click',function(){
        valse = "";
        var action = "insert";
        var username = $('#fullname').val();
        if(username=="" && name_expression.test(username)==false){
            $('#message').text('Invalid Name');
            valse=false;
        }else{
            valse=true;
        }
        var email = $('#email').val();
        if(email=="" && email_expression.test(email)==false){
            $('#message').text('Invalid Email');
            valse=false
        }else{
            valse=true;
        }
        var check_in = $('#check-in').val();
        var check_out = $('#check-out').val();
        // alert(check_in);
        var room_child_id = $('#rcId').val();
        var rooms_id = $('#rId').val();
        var re_email = $('#re-email').val();
        if(re_email=="" && email_expression.test(re_email)==false){
            $('#message').text('Email Not Verify');
            valse=false;
        }else{
            valse=true;
        }
        if(re_email!=email){
            $('#message').text('Email Not Verify');
            valse=false;
        }else{
            valse=true;
        }
        var phone_num = $('#phone-num').val();
        if(phone_num=="" && phone.test(phone_num)==false){
            $('#message').text('Invalid Phone');
            valse=false
        }else{
            valse=true;
        }
        var whoBook = get_filter('guestCheck');
        var guestName = "";
        if(whoBook == 'soElse'){
            guestName = $('#guest-name').val();
        }else{
            guestName = $('#fullname').val();
        }
        var token = $('#token').val();
        var total_people = $('#total-people').val();
        var total_date = $('#total_date').val();
        var user_account = $('#user_acount').val();
        var roomCount = $('#total-room').val();
        var total_price = $('#total-price').val();
        if(valse==true){
            $('#submitCheckout').attr('disabled');
            $.ajax({
                method:"POST",
                dataType:"JSON",
                url: "./index.php?controller=Ajax&action=checkBooking",
                data: 
                {
                    action:action,
                    token:token,
                    rooms_id:rooms_id,
                    total_price:total_price,
                    check_in:check_in,
                    check_out:check_out,
                    room_child_id:room_child_id,
                    username:username,
                    email:email,
                    re_email:re_email,
                    phone_num:phone_num,
                    guestName:guestName,
                    total_date:total_date,
                    total_people:total_people,
                    roomCount:roomCount,
                    user_account:user_account
                },
                success:function(data){
                    if(data.data!=false && data.error == ""){
                    $('#order_process_form').append("<input type='hidden' id='orderid' name='orderid' value='" + data.data + "' />");
                    $('#showDetail').hide();
                    $('#showBooking').show();
                }else{
                   alert('Vui lòng đặt phòng khác hoặc chuyển khoảng thời gian khác vì phòng của bạn đã được đặt hết');
                }
            }
            })
        }else{
            alert("Vui Lòng Kiểm Tra Thông Tin Nhập Vào");
        }
    })
    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        
        return filter;
    }
})