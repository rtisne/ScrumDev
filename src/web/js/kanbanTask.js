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


$(document).on("click", ".task_management", function () {
    var task = $(this).data('id');
    if($(this).data('title').toLowerCase() === "edit" )
        fill_form_input(task);
});


function fill_form_input(task_values){

    $("#update_form__user_story_title").val(story_values.title);
    $("#update_form__user_story_description").val(story_values.description);
    $("#update_form__user_story_cost").val(story_values.cost);
    $("#update_form__user_story_priority").val(story_values.priority);
    $("#update_form_user_story_commit").val(story_values.commit);

}
