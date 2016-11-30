$(document).ready(function(){

    var scripts = [
        "/js/createProject.js",
        "/js/kanbanUS.js",
        "/js/kanbanTask.js",
        "/js/logout.js",
        "/js/datepicker.js",
        "/js/backlog.js",
        "/js/basic-kanban.js"];



    $.ajaxPrefilter(function( options ) {
        options.async = true;
    });

    script_legnth = scripts.length;
    for(var i = 0; i < script_legnth; ++i){
        $("script:last").append("<script type  = 'text/javascript', src =" + get_absolute_path().concat(scripts[i])+ "><\/script>");
    }




    var $column_count , $row_count;
    $column_count= $row_count =  0;

    $("#kanban tbody tr:not('.addUSRow')").each(function(){

        var $row_columns = $(this).find("td");
        $(this).attr("id",'row'.concat($row_count));
        $($row_columns).each(function(){
            $column_count++;
            $(this).attr("id",'column'.concat($column_count));
            $(this).addClass("connectedSortable")

        });
        $row_count++;

    });







});