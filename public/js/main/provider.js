$(document).ready(function(){
    fetchAllProvider();
    function fetchAllProvider(){
        var data = "fetchAll";
        $.ajax({
            url:"./index.php?controller=ajax&action=fetchAllProvider",
            method:"POST",
            data : {data:data},
            success: function(data){
                $('#data-results').html(data);
            }
        });
    }
})