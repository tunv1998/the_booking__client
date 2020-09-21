$('document').ready(function(){
    var id = $('#idHotel').val();
    var limit = 3;
    $('#comment_form').on('submit',function(event){
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: "./index.php?controller=Ajax&action=comment",
            method:"POST",
            data: data,
            dataType:"JSON",
            success:function(data){ 
                if(data.error!=""){
                    $('#comment_form')[0].reset();
                    $('#comment_message').html(data.error);
                    load_comment(id);
                    loadCountReview(id)
                }
            }
        })
    });
    load_comment(id);
    loadCountReview(id);
function load_comment(id){
    $.ajax({
		url: "./index.php?controller=Ajax&action=showComment",
        method:"POST",
        data: {id:id,limit:limit},
        success:function(data){
            $('#display_comment').html(data);
        }
    })
}
function loadCountReview(id){
    $.ajax({
		url: "./index.php?controller=Ajax&action=countReview",
        method:"POST",
        data: {id:id},
        success:function(data){
            $('#countReview').html(data);
            $('#countUserReview').html(data);
        }
    })
}
$(document).on('mouseenter', '.rating', function(){
    var index = $(this).data("index");
    var business_id = $(this).data('business_id');
    remove_background();
    for(var count = 1; count<=index; count++)
    {
     $('#'+count).css('color', '#ffcc00');
    }
   });
$(document).on('click', '#loadMore', function(){
    limit = limit +3;
    $.ajax({
        url: "./index.php?controller=Ajax&action=loadMore",
         method:"POST",
         data:{id:id,limit:limit},
         success:function(data)
         {
        if(data!=""){
        load_comment(id)
        }else{
            $('#loadMore').html('');
        }
    }
    });  
})
   $(document).on('mouseleave', '.rating', function(){
    var index = $(this).data("index");
    var business_id = $(this).data('business_id');
    var rating = $(this).data("rating");
    //alert(rating);
    for(var count = 1; count<=rating; count++)
    {
     $('#'+count).css('color', '#ffcc00');
    }
   });
   
   function remove_background()
   {
    for(var count = 1; count <= 5; count++)
    {
     $('#'+count).css('color', '#ccc');
    }
   }
   $(document).on('click', '.rating', function(){
    var index = $(this).data("index");
    $.ajax({
	url: "./index.php?controller=Ajax&action=rating",
     method:"POST",
     data:{index:index,id:id},
     success:function(data)
     {
        for(var count = 1; count<=rating; count++)
        {
         $('#'+count).css('color', '#ffcc00');
        }
        $('#comment_form').append("<input type='hidden' id='userrating' name='userrating' value='" + data + "' />");
    }
    });
    
   });
   $(document).on('click', '.like_button', function(){
    var content_id = $(this).data('content_id');
    $.ajax({
    url: "./index.php?controller=Ajax&action=like",
    method:"POST",
    data:{content_id:content_id,id:id},
    success:function(data)
    {
    if(data == 'done')
    {
        load_comment(id);
    }
    }
    })
   });
   $(document).on('click', '.dislike_button', function(){
    var content_id = $(this).data('content_id');
    $.ajax({
    url: "./index.php?controller=Ajax&action=dislike",
    method:"POST",
    data:{content_id:content_id,id:id},
    success:function(data)
    {
    if(data == 'done')
    {
        load_comment(id);
    }
    }
    })
   });
});