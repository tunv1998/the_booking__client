
$(document).ready(function(){
    $("#suggesstion-box").hide();
    $("#suggestion-box-search").hide();
	$("#location").keyup(function(){
		$.ajax({
		type: "POST",	
		url: "./index.php?controller=Ajax&action=show",
		data:'keyword='+$(this).val(),
		success: function(data){
		    if(data == ""){
		    $("#suggesstion-box").hide();
            $("#suggestion-box-search").hide();
		    }else{
		    $("#suggesstion-box").show();
			$("#suggestion-box-search").show();
			$("#suggestion-box-search").html(data);
		}
		    
		}
		});
	});
});

function selectCountry(val,id) {
$("#location").val(val);
$("#hid").val(id);
$("#suggesstion-box").hide();
}

