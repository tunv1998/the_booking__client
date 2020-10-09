$(document).ready(function(){
    $(document).on('click','#save-info',function(){
        var dob = $('#user-dob').val();
        var phone = $('#user-phone-number').val();
        var email = $('#user-email').val();
        var id = $('#iduser').val();
        alert(id)
        $.ajax({
            url: "./index.php?controller=Ajax&action=editUser",
            method:"post",
            data: {
                dob:dob,
                phone:phone,
                email:email,
                id:id
            },
            success: function(data){
                if(data=1){
                window.location = window.location;
            }}
        })
    })
})