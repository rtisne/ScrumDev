

function get_absolute_path(){
	var loc = window.location.pathname;
	var abs_path = loc.substring(0, loc.lastIndexOf('/'))
	return abs_path
}