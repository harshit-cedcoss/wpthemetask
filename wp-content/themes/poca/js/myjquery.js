jQuery(document).ready(function($){

  $('.cat-item a').prepend('<i class="fa fa-angle-double-right" aria-hidden="true"></i> ');

  $('.comment-meta a').map(function(){
    if($(this).text() == 'Reply'){
      $(this).addClass("reply");
    }
  });

  $('blockquote div:first').append('<i class="fa fa-quote-left" aria-hidden="true"></i>');

});
