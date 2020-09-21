$(document).ready(function(){
    var id;
    var a;
    var b;
    percentage('getPercenRating5',$('#rating5').val(),$('#tottalRatting').val())
    percentage('getPercenRating4',$('#rating4').val(),$('#tottalRatting').val())
    percentage('getPercenRating3',$('#rating3').val(),$('#tottalRatting').val())
    percentage('getPercenRating2',$('#rating2').val(),$('#tottalRatting').val())
    percentage('getPercenRating1',$('#rating1').val(),$('#tottalRatting').val())

function percentage(id,a,b)
{
    percent = (a/b)*100;
    if(percent<=0){
        $('#'+id+'').html('<div class=" w-0/12 rounded-lg h-2"></div>')
    }else if(percent<=10){
        $('#'+id+'').html('<div class=" w-1/12 bg-blue-600 rounded-lg h-2"></div>')
    }else if(percent<=20){
        $('#'+id+'').html('<div class=" w-2/12 bg-blue-600 rounded-lg h-2"></div>')
    }else if(percent<=30){
        $('#'+id+'').html('<div class=" w-3/12 bg-blue-600 rounded-lg h-2"></div>')
    }else if(percent<=40){
        $('#'+id+'').html('<div class=" w-4/12 bg-blue-600 rounded-lg h-2"></div>')
    }else if(percent<=50){
        $('#'+id+'').html('<div class=" w-6/12 bg-blue-600 rounded-lg h-2"></div>')
    }else if(percent<=60){
        $('#'+id+'').html('<div class=" w-7/12 bg-blue-600 rounded-lg h-2"></div>')
    }else if(percent<=70){
        $('#'+id+'').html('<div class=" w-8/12 bg-blue-600 rounded-lg h-2"></div>')
    }else if(percent<=80){
        $('#'+id+'').html('<div class=" w-9/12 bg-blue-600 rounded-lg h-2"></div>')
    }else if(percent<=90){
        $('#'+id+'').html('<div class=" w-11/12 bg-blue-600 rounded-lg h-2"></div>')
    }else if(percent<=100){
        $('#'+id+'').html('<div class=" w-12/12 bg-blue-600 rounded-lg h-2"></div>')
    }
}})
