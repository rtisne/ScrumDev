$(document).ready(function(){
    $('#addUS').on('click',addUS);
    $('.popover-markup').on('click','#removeUS', removeUS);
});


function addUS(){
    var idUS = $("select[name='userstory']").find(":selected").data("id");
    var numberUS= $("select[name='userstory']").find(":selected").data("number");
    var titleUS = $("select[name='userstory']").find(":selected").text();
    var idSprint = $("h2").data("id");
    $.getJSON(get_absolute_path().concat('/ajax/addUSToSprint.php'), {
        idUS: idUS,
        idSprint: idSprint
    } ,function(data) {
        if(data != -1) {
            var html = "<tr data-id=\""+idUS+"\"><th scope=\"row\" class=\"text-center\"><div class=\"popover-markup\"><a class=\"trigger\">US#"+ numberUS +"</a><div class=\"content hide\"><div class=\"form-group\"><p>" + titleUS + "</p></div><button type=\"submit\" class=\"btn btn-primary btn-block\" id=\"removeUS\" data-id=\""+ idUS +"\">Remove</button></div></div></th><td></td><td></td><td></td><td></td></tr>";
            $(".addUSRow").before(html);
             $(".addUSRow").prev().find('.popover-markup>.trigger').popover(popOverSettings).click(function(e) {
                $('.popover-markup>.trigger').popover('hide');
                $(this).popover('toggle');
                e.stopPropagation();
            });
             $(".addUSRow").prev().find('.popover-markup').on('click','#removeUS', removeUS);
        }
        $('#addUSToKanbanmodal').modal('hide');
    });
}

function removeUS(){
    var us = $(this).data('id');
    var idUS = us.id;
    var idSprint = $('h2').data('id');
    var row = $(this).closest('tr');
    $.getJSON(get_absolute_path().concat('/ajax/removeUSToSprint.php'), {
        idUS: idUS,
        idSprint: idSprint,
    } ,function(data) {
        if(data == 1)
        {
            row.remove();
        }
    });

}






$('html').click(function(e) {
    $('.popover-markup>.trigger').popover('hide');
});
var popOverSettings = {
    trigger: 'manual',
    placement: 'left',
    html: true,
    title: function () {
        return $(this).parent().find('.head').html();
    },
    content: function () {
        return $(this).parent().find('.content').html();
    }
};

$('.popover-markup>.trigger').popover(popOverSettings).click(function(e) {
    $('.popover-markup>.trigger').popover('hide');
    $(this).popover('toggle');
    e.stopPropagation();
});
