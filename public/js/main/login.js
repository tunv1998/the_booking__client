$(document).ready(function(){
    $('#login').click(function(){
        var username = $('#username').val();
        var password = $('#password').val();
        if(username == "" || password ==""){
            alert('Mời bạn kiểm tra thông tin đăng nhập');
        }else{
            $.ajax({
                url: "./index.php?controller=Ajax&action=login",
                method: "POST",
                dataType: 'text',
                data:{
                    login:1,
                    username : username,
                    password : password 
                },
                success: function(response){
                    if (response == "")
                    alert('Làm ơn kiểm tra lại mật khẩu và tài khoản của bạn');
                else
                    window.location = window.location;
                }
            })
        }
    })
    $('#logout').click(function(){
            $.ajax({
                url: "./index.php?controller=Ajax&action=logout",
                method: "POST",
                dataType: 'text',
                data:{
                    logout:1
                },
                success: function(response){
                    window.location = window.location;
                }
            })
    })
})