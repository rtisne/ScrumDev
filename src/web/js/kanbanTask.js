$(document).ready(function(){
    $('.select_task_dependency').on('change', task_selected);
    $('.list_member').on('click','li > .remove_task' ,remove_task);
});


function task_selected() {
    var idTask = $(this).find(":selected").val();
    if(idTask != null) {
        var nameTask = $(this).find(":selected").text();

        var html = "<li class=\"list-group-item\" data-id=\""+idTask+"\">"+ nameTask +" <a class=\"pull-right remove_task\"><span class=\"glyphicon glyphicon-remove\"></span></a></li>"
        $(".list_member").append(html);

        var input = "<input type=\"hidden\" name=\"tasks[]\" value=\""+ idTask +"\" data-task=\""+idTask+"\"/>";
        $('form').append(input);
        $('.select_task_dependency').prop('selectedIndex',0);
    }
}

function remove_task() {
    var id = $(this).parent().data('id');
    var selector = '[data-task="'+ id +'"]';
    console.log(selector);
    $(selector).remove();
    $(this).parent().remove();
}
