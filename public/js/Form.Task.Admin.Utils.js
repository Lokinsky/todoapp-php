$(document).ready(()=>{
	$("#table-tasks").find('input[type="checkbox"]').on("change", function(e){
		if($(this).val() == 0) $(this).val(1)
		else $(this).val(0);
		
		if($(this).data('action') == "update-task"){
			$.ajax({
			  url: "http://192.168.3.11:8000/api/tasks/update",
			  method:"post",
			  data: {
			  	'id': $(this).data('id'),
			  	'status': $(this).val(),
			  	'csrf': $('meta[name=csrf-token]').prop('content')
			  }
			}).done(function(res) {
				if(res){
					var parsed = JSON.parse(res);
					if(parsed.status == 403)
						redirect("/login");
				}
				
			});
		}
		return false;
	})
	$("#table-tasks").find('input[type="text"]').on("keypress", function(e){
		if(e.which == 13) {
	        if($(this).data('action') == "update-task"){
				$.ajax({
				  url: "http://192.168.3.11:8000/api/tasks/update",
				  method:"post",
				  data: {
				  	'id': $(this).data('id'),
				  	'text': $(this).val(),
				  	'csrf': $('meta[name=csrf-token]').prop('content')
				  }
				}).done(function(res) {
					if(res){
						var parsed = JSON.parse(res);
						if(parsed.status == 403)
							redirect("/login");
					}
				});
			}
	    }
	});
});

function redirect (where){
	window.location.replace(where);
}