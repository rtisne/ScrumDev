
$( function() {
    $( "#kanban td" ).sortable({
        connectWith: ".connectedSortable",
        receive : function(event,ui) {
            //user story change state notify server
            var $curr_td = ui.item.parent();
            var $us_state = $($curr_td).closest("#kanban").find('th').eq($curr_td.index()).html();
            var $task_data = $(ui.item).find("*[data-id]").data("id");
            var $story_id = $($curr_td).closest("tr").data("id").id;
            $.extend($task_data, {submit: 'stories_change_states', state: $us_state, user_story_id: $story_id});

            send_state_change_request($task_data);

            $(this).sortable('cancel');
        }
    }).disableSelection();

    function send_state_change_request($task_data){
        $.ajax({
            url: get_current_url(),
            type: "post",
            data: $task_data,
            dataType: "json",
            success: function(data){

                var idUSDone = data;
                if(typeof idUSDone.idUS !== 'undefined')
                {
                    console.log(idUSDone.idUS);
                    $("#update_form_user_story_state").prop('checked', false);
                    $("#update_form_user_story_commit").attr( "disabled", true );
                    $("#update_form_user_story_commit").val('');
                    $(".user_story_selected").val(idUSDone.idUS);
                    $('#commit_popup').modal();
                }
            }
        });
    }

});

