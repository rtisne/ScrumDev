
$( function() {

    $( "#kanban td" ).sortable({
        connectWith: ".connectedSortable",
        receive : function(event,ui){
            //user story change state notify server
            var $curr_td = ui.item.parent();
            var $us_state = $($curr_td).closest("#kanban").find('th').eq($curr_td.index()).html();
            var $task_data = $($curr_td).find("*[data-id]").data("id");
            var $story_id = $($curr_td).closest("tr").attr("data-id");
            $.extend($task_data,{submit :'stories_change_states', state : $us_state , user_story_id : $story_id });

            $.ajax({
                url: get_current_url(),
                type: "post",
                data: $task_data,
                dataType: "json",

                success: function(){} //Change to this
            });
        }
    }).disableSelection();

});
