$(document).on("click", ".backlog_management", function () {
    var story_id = $("p").data('id');
    var story_values = $("#backlog_story_values").data('id');
    $(".user_story_selected").val( story_id );
    $("#user_story_edit").val(story_values);
});
