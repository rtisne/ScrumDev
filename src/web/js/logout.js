$("#logout_link").click(function() {
	$.ajax({
		contentType: "application/x-www-form-urlencoded",
		type: "POST",
		url: get_absolute_path().concat('/signin.php'),
		success: function(){
			window.location.reload();
		}
	});
});