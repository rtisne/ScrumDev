function get_absolute_path(){
	var loc = window.location.pathname;
	var abs_path = loc.substring(0, loc.lastIndexOf('/'))
	return abs_path
}

function get_current_url(){
	return window.location.toString();
}