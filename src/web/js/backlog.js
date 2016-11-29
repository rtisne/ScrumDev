$(document).on("click", ".backlog_management", function () {
    var story = $(this).data('id');
    console.log(story);

    $(".user_story_selected").val( story.id );
    if($(this).data('title').toLowerCase() === "edit" )
        fill_form_input(story);
});

$('#update_form_user_story_state').on("change", function () {
    if(this.checked) {
        $("#update_form_user_story_commit").removeAttr( "disabled" );
    } else {
        $("#update_form_user_story_commit").attr( "disabled", true );
        $("#update_form_user_story_commit").val('');
    }
});






function fill_form_input(story_values){

    $("#update_form__user_story_title").val(story_values.title);
    $("#update_form__user_story_description").val(story_values.description);
    $("#update_form__user_story_cost").val(story_values.cost);
    $("#update_form__user_story_priority").val(story_values.priority);
    if(story_values.state === "1") {
        $("#update_form_user_story_state").prop('checked', true);
        $("#update_form_user_story_commit").removeAttr( "disabled" );
        $("#update_form_user_story_commit").val(story_values.commit);
    }
    else {
        $("#update_form_user_story_state").prop('checked', false);
        $("#update_form_user_story_commit").attr( "disabled", true );
        $("#update_form_user_story_commit").val('');
    }




}