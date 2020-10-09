Stripe.setPublishableKey('pk_test_51H05WIHUnhuR2nRIMcngk714spLcDraFceqjA9vGNFkDWLGwwjhsoJW9FbeeP15f9S9bdnh6EXAl9i8QMQ1CraGs00X8GzqPni');

function stripeResponseHandler(status, response)
{
 if(response.error)
 {
  $('#button_action').attr('disabled', false);
  $('#error_card').html(response.error.message);
 }
 else
 {
  var token = response['id'];
  $('#order_process_form').append("<input type='hidden' id='token' name='token' value='" + token + "' />");

  $('#order_process_form').submit();
 }
}
function validate_form(){
    var valid = false;
    var valid_card = 0;
    var customer_name = $('#usernameCard').val();
    var name_expression = /^[a-z ,.'-]+$/i;
    var month_expression = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
    var year_expression = /^2005|2006|2007|2008|2009|2010|2011|2012|2013|2014|2015|2016|2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
    var cvv_expression = /^[0-9]{3,3}$/;
    $('#card_holder_number').validateCreditCard(function(result){
        if(result.valid)
        {
         valid_card = 1;
        }
        else
        {
          $('#error_card').text('Invalid Card Number');
          valid_card = 0;
        }
       });
       if(valid_card == 1)
       {
        if(!month_expression.test(card_expiry_month))
        {
          $('#error_card').text('Invalid Card Month');
         valid = false;
        }
        else
        { 
         valid = true;
        }
      
        if(!year_expression.test(card_expiry_year))
        {
          $('#error_card').text('Invalid Card Year');
         valid = false;
        }
        else
        {
         valid = true;
        }
      
        if(!cvv_expression.test(card_cvc))
        {
          $('#error_card').text('Invalid Card CVV');
         valid = false;
        }
        else
        {
         valid = true;
        }
        if(!name_expression.test(customer_name))
        {
          $('#error_card').text('Invalid Card Name');
         valid = false;
        }
        else
        {
         valid = true;
        }
      return valid;
}
}
function stripePay(event)
{
 event.preventDefault();
 
 if(validate_form() == true)
 {
  $('#button_action').attr('disabled');
  $('#button_action').val('Payment Processing....');
  Stripe.createToken({
   number:$('#card_holder_number').val(),
   cvc:$('#card_cvc').val(),
   exp_month : $('#card_expiry_month').val(),
   exp_year : $('#card_expiry_year').val()
  }, stripeResponseHandler);
  return false;
 }
}


function only_number(event)
{
 var charCode = (event.which) ? event.which : event.keyCode;
 if (charCode != 32 && charCode > 31 && (charCode < 48 || charCode > 57))
 {
  return false;
 }
 return true;
}