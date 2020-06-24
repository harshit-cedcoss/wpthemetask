// jQuery(document).ready(function($) {       //wrapper

//     $(".pref").on( 'change', function() {         //event
//         var this2 = this;                  //use in callback
//         $.post(my_ajax_obj.ajax_url, {     //POST request
//            _ajax_nonce: my_ajax_obj.nonce, //nonce
//             action: "my_tag_count",        //action
//             title: this.value              //data
//         }, function(data) {                //callback
//             alert(data);
//             this2.nextSibling.remove();    //remove the current title
//             $(this2).after(data);          //insert server response
//         });
//     });
// });

jQuery(document).ready(function($) {
 
    // We'll pass this variable to the PHP function example_ajax_request
    var fruit = 'Banana1';
    // This does the ajax request
    $.ajax({
        url: example_ajax_obj.ajaxurl,
        type : 'POST',
        data: {
            'action': 'example_ajax_request',
            'fruit': fruit,
            'nonce': example_ajax_obj.nonce,
        },
        success:function(data) {
            // This outputs the result of the ajax request
            console.log(data);
        },
        error: function(errorThrown){
            console.log(errorThrown);
        }
    }); 
    $('#btn_form_feedback').on( 'click', function(){
        var name = $('#form_name').val();
        var email = $('#form_email').val();
        var fb = $('#form_feedback').val();
        //alert(name+" "+email+" "+fb);
        $.ajax({
            url: example_ajax_obj.ajaxurl,
            type : 'POST',
            data: {
                'action'  : 'feedback_request',
                'name'    : name,
                'email'   : email,
                'feedback': fb,
                'nonce': example_ajax_obj.nonce,
            },
            success:function(data) {
                // This outputs the result of the ajax request
                alert(data);
                console.log(data);
            },
        });
    });
});
