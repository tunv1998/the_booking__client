    // $('#roomCount').text('');
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('45b71145f0bd5981bebb', {
    cluster: 'ap1',
    encrypted: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        // alert(JSON.stringify(data.roomChild));
        var check_in = $('#check-in').val();
        var check_out = $('#check-out').val();  
        var id = $('#room-id-'+data.roomId+'').val();
        if(data.formday<=check_in<=data.today || data.formday<=check_out<=data.today){
        if(data.roomId==id){
        var total_room = document.querySelectorAll('#roomCount-'+data.roomId+'');
        // alert(total_room[0].innerHTML)
        // var total_room = $('#roomCount-'+data.roomChildId+'').html();
        // console.log(total_room.length);
        $('#process-form-'+data.roomId+'').append("<input type='hidden' id='total-row' name='total-row' value='" + data.roomCount + "' />");
        var roombooked = $('#total-row').val();
        for(var i = 0; i<=total_room.length; i++){
            totalRoom = total_room[i].innerText - roombooked;
            if(totalRoom<=0){
                $('#process-form-'+data.roomId).hide();
            }else{
                total_room[i].innerText = totalRoom;
            }
        }
        
    }
    }
    });