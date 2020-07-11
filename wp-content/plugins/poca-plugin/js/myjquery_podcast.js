jQuery(document).ready(function($){
    var number_of_posts = 2;
    var current_tax = '';
    
    $('.portfolio-menu button').on( 'click', function(){
        current_tax = $(this).data('filter');
        number_of_posts = 2;
    //    alert(current_tax);
        call_ajax();
    });
    
    $('.text-center').on('click', '.poca-btn', function(e){
        e.preventDefault();
       // alert($(this).text());
        number_of_posts += 2;
        current_tax = $('.portfolio-menu .active').data('filter');
        call_ajax();
    });
    call_ajax();
    function call_ajax(){
        $.ajax({
            url: podcast_ajax_obj.ajaxurl,
            type : 'POST',
        //    dataType : 'json',
            data: {
                'action' : 'podcast_request',
                'tax'    : current_tax,
                'num_of_posts' : number_of_posts, 
                'nonce'  : podcast_ajax_obj.nonce,
            },
            success:function(data) {
                // This outputs the result of the ajax request
                //  console.log(1);
                 $('#ajax_poca_podcast').html(data);
            },
        });
    }

});