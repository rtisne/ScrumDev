$(document).on("click", ".backlog_management", function () {
    var story_number = $("p").data('id');
    var story_values = $("#backlog_story_values").data('id');
    $(".user_story_selected").val( story_number );
    $("#user_story_edit_from_backlog").val(js);
});
