$.fn.inlineEdit = function(replaceWith, connectWith) {
    
    $(this).dblclick(function() {

        var elem = $(this);

        elem.hide();
        elem.after(replaceWith);
        replaceWith.focus();

        replaceWith.blur(function() {

            if ($(this).val() != "") {
                connectWith.val($(this).val()).change();
                elem.text($(this).val());
            }

            $(this).remove();
            elem.show();
        });
    });

};



$(document).ready(function(){
    $('ol.quiz li').hover(function() {
        $(this).find('.showme').removeClass('hide');
        $(this).find('.showme').addClass('show');
    }, function() {
        $(this).find('.showme').removeClass('show');
        $(this).find('.showme').addClass('hide');
    });

    
});
