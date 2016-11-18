$(document).on("click", ".backlog_management", function () {
    var story = $(this).data('id');

    $(".user_story_selected").val( story.id );
    if($(this).data('title').toLowerCase() === "edit" )
        fill_form_input(story);
});


function fill_form_input(story_values){

    $("#update_form__user_story_title").val(story_values.title);
    $("#update_form__user_story_description").val(story_values.description);
    $("#update_form__user_story_cost").val(story_values.cost);
    $("#update_form__user_story_priority").val(story_values.priority);
    $("#update_form_user_story_commit").val(story_values.commit);

}