$(document).ready(function(){
	$(".username").keyup(function(){
        // var a = $('.username').val();
        // alert(a);
		$.ajax({
		type: "POST",	
		url: "./index.php?controller=Ajax&action=checkUsername",
		data:'username='+$(this).val(),
		success: function(data){
			$(".messegeUser").html(data);
		}
		});
    });
    $(".email").keyup(function(){
        // var a = $('.username').val();
        // alert(a);
		$.ajax({
		type: "POST",	
		url: "./index.php?controller=Ajax&action=checkEmail",
		data:'email='+$(this).val(),
		success: function(data){
			$(".messegeEmail").html(data);
		}
		});
    });
    $(".phone").keyup(function(){
        // var a = $('.username').val();
        // alert(a);
		$.ajax({
		type: "POST",	
		url: "./index.php?controller=Ajax&action=checkPhone",
		data:'phone='+$(this).val(),
		success: function(data){
			$(".messegePhone").html(data);
		}
		});
	});
});

