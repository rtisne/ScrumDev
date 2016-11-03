$(document).ready(function(){
   $('#add_member_input').on('keyup paste',username_search);
   $('.dropdown-menu').on('click', '.member_proposal',user_selected);
   $('.list_member').on('click','li > .remove_user' ,user_remove);

});

function username_search(){
    if($('#add_member_input').val().length >= 3) {
        $.getJSON(get_absolute_path().concat('/ajax/getUserNames.php'), {
            name: $('#add_member_input').val()
        } ,function(data) {
            $('#dropdown_proposal').empty();
            $('.dropdown').addClass('open');
            if(!data) {
                var li = "<li>"+$('#add_member_input').val()+" is not a member</li>"
                $('#dropdown_proposal').append(li);
            }else{
                data.forEach(function(element) {
                    var li = "<li class=\"member_proposal\" data-id=\""+element.id +"\" data-name=\""+element.name +"\" data-first_name=\""+element.first_name +"\" data-email=\""+element.email +"\"><a id=\"member_proposal\">" +element.first_name +" " + element.name +" ( "+ element.email +" )</a></li>"
                    $('#dropdown_proposal').append(li);
                 });
            }
         });
    }
    else {
        $('.dropdown').removeClass('open');
    }
}
function user_selected(){
    var id_selected = $(this).data("id");
    var name_selected = $(this).data("name");
    var first_name_selected = $(this).data("first_name");
    var email_selected = $(this).data("email");
    var html = "<li class=\"list-group-item\" data-id=\""+id_selected+"\">" +first_name_selected +" " + name_selected +" <a  class=\"pull-right remove_user\"><span class=\"glyphicon glyphicon-remove\"></span></a></li>"
    $(".list_member").append(html);

    html = "<option value=\""+ id_selected +"\">" +first_name_selected +" " + name_selected +"</option>";
    $('.form-control').append(html);

    var input = "<input type=\"hidden\" name=\"member[]\" value=\""+ id_selected +"\" />";
    $('.form-horizontal').append(input);

    $('.dropdown').removeClass('open');
    $('#add_member_input').val('');
}
function user_remove(){
    var id = $(this).parent().data('id');
    $("[value='" + id + "']").remove();
    $(this).parent().remove();
}
