$(document).ready(function(){
    $('.select_task_dependency').on('change', task_selected);
    $('.list_member').on('click','li > .remove_task' ,remove_task);
});
$('#updateTaskmodal, #createTaskmodal').on('show.bs.modal', function (e) {
    $('input[name="title"]').val('');
    $('textarea').val('');
    $('.list_member *[data-id]').remove();
})

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
    $(selector).remove();
    $(this).parent().remove();
}


$(document).on("click", ".task_management", function () {
    var task = $(this).data('id');
    $('.task_selected').val( task.id );
    $('option[value="'+task.id+'"]').remove();
    if($(this).data('title').toLowerCase() === "edit" )
        fill_task_form_input(task);

});


function fill_task_form_input(task_values){
    $('#update_form__task_title').val(task_values.title);
    $('#update_form__task_description').val(task_values.description);
    if(task_values.implementer != null)
        $('#update_form__task_implementer option[value="'+task_values.implementer+'"]').prop('selected', true);
    else
        $('#update_form__task_implementer').prop('selectedIndex',0);
    $('.list_member *[data-id]').remove();
    if(task_values.dependencies != null) {
        var dependencies = task_values.dependencies.split(",");
        dependencies.forEach(function(dependency) {
          var idTask = dependency;
          var nameTask = $('.select_task_dependency option[value="'+idTask+'"]').first().text();
          var html = "<li class=\"list-group-item\" data-id=\""+idTask+"\">"+ nameTask +" <a class=\"pull-right remove_task\"><span class=\"glyphicon glyphicon-remove\"></span></a></li>"
          $(".list_member").append(html);

          var input = "<input type=\"hidden\" name=\"tasks[]\" value=\""+ idTask +"\" data-task=\""+idTask+"\"/>";
          $('form').append(input);

        });
    }
}
