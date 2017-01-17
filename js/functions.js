$(function(){
  
  $('button#showPass').click(function(){   
      if( $('input#newPass').attr("type") === 'password') {
          $('input#newPass').attr('type', 'text');
      } else {
          $('input#newPass').attr('type', 'password');
      }
  });
  
  
 
});