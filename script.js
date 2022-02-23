$(document).ready(function(){
		$('.singleDataDesc').click(function() {
			$(this).find('.popUp').slideToggle();
	 		$(this).find('.popUp').find('.text').text('Is '+ $(this).attr('data-name')+	' clocking in as a '+ $(this).attr('data-desc')+	'?');
		});
		$(".post").on("click",function(){
				$.ajax({
				url: "ClockIn.php",
				type: "POST",
				data: { "employeeId": $(this).attr('data-emp'), "roleId": $(this).attr('data-role') },
				success: function(response){
					console.log(response);
				     
				},
				error: function(){

				      // do action
				}
			});
		});
		$('.singleData').click(function() {
			console.log ($(this).next().slideToggle());
		});
});