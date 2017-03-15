$(function(){
  
  $('button#showPass').click(function(){   
      if( $('input#newPass').attr("type") === 'password') {
          $('input#newPass').attr('type', 'text');
      } else {
          $('input#newPass').attr('type', 'password');
      }
  });
  // button to edit tweet
//  $('#text-tweet').hover(function(){
//      $('.glyphicon-pencil').show('1000');
//  });
  
 
});
