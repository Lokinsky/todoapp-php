$(document).ready(()=>{
	$("#FormSort").find('select').on('change', function(){

		$("#FormSort").attr("action",$("#FormSort").attr("action")+'?page='+getUrlParameter('page'))
		$("#FormSort").submit();
	});
	$("#FormTask").on("submit", function(e){
		e.preventDefault();
		var data = $(this).serializeArray();
		console.log(data);
		$.ajax({
		  url: "http://192.168.3.11:8000/api/tasks/add",
		  method:"post",
		  data: data
		}).done(function(res) {
			window.location.reload(true);
		});
		return false;
	});
});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};