$(".nextquestion").click(function() {
    var url = $(this).data('url');
    var submit = $(this).data('submit');

    var datastring = $("#user_submission").serialize();

    $.post( base_url+'saveUserAnswers', {formData:datastring,submit:submit},function( data ) {
        if (show_type == "0"){
            $("#solution_div").html(data);
            change_parent_height();
            $(".nextquestion").click(function() {
                if(submit == '0'){
                    window.location = url;
                } else {
                    window.location = base_url+'reportCard/'+$("#exam_id").val();
                }
            });
        }else{
            if(submit == '0'){
                window.location = url;
            } else {
                window.location = base_url+'reportCard/'+$("#exam_id").val();
            }
        }
    });
});
