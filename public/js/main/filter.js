
$(document).ready(function(){
	filter_data(1);
    function filter_data(page,review_hotel='',price='',star='')
    {
        //store data in variable
        // $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'filterHotel';
        var hid = $('#hname').val();
        var totalPeople = $('#total-people').val();
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        $.ajax({
            url:"./index.php?controller=Ajax&action=filterHotel",
            method:"POST",
            data:{
            page:page,
            action:action,hid:hid,
            totalPeople:totalPeople,
            minimum_price:minimum_price, 
            maximum_price:maximum_price, 
            price:price, 
            review_hotel:review_hotel,
            star:star
            },
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }
    $(document).on('click','.page-link',function(){
        var page = $(this).data('page_number');
        var review_hotel = get_filter('review');
        var price = get_filter('price');
        var star = get_filter('stars');
        filter_data(page,review_hotel,price,star)
    });
    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        
        return filter;
    }

    $('.common_selector').click(function(){
        var review_hotel = get_filter('review');
        var price = get_filter('price');
        var star = get_filter('stars');
        filter_data(1,review_hotel,price,star)
    });
	$('#price_range').slider({
		range:true,
		min:10000,
		max:10000000,
		values:[10000, 10000000],
		step:500,
		stop:function(event, ui)
		{
			$('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
			$('#hidden_minimum_price').val(ui.values[0]);
			$('#hidden_maximum_price').val(ui.values[1]);
			filter_data(1);
		}
	});
});


