// Add your javascript here
// Don't forget to add it into respective layouts where this js file is needed

$(document).ready(function() {
  AOS.init( {
    // uncomment below for on-scroll animations to played only once
    // once: true  
  }); // initialize animate on scroll library
});

// Smooth scroll for links with hashes
$('a.smooth-scroll')
.click(function(event) {
  // On-page links
  if (
    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
    && 
    location.hostname == this.hostname
  ) {
    // Figure out element to scroll to
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
    // Does a scroll target exist?
    if (target.length) {
      // Only prevent default if animation is actually gonna happen
      event.preventDefault();
      $('html, body').animate({
        scrollTop: target.offset().top
      }, 1000, function() {
        // Callback after animation
        // Must change focus!
        var $target = $(target);
        $target.focus();
        if ($target.is(":focus")) { // Checking if the target was focused
          return false;
        } else {
          $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
          $target.focus(); // Set focus again
        };
      });
    }
  }
});

$.ajax({
  type:'POST',
  url:'EnviarForm.php',
  data:'ContactoEnviar=1&name='+name+'&email='+email+'&message='+message,
  beforeSend: function () {
      $('.submitBtn').attr("disabled","disabled");
      $('.modal-body').css('opacity', '.5');
  },
  success:function(msg){
      if(msg == 'bien'){
          $('#inputName').val('');
          $('#inputEmail').val('');
          $('#inputMessage').val('');
          $('.statusMsg').html('<span style="color:green;">Gracias por contactarnos, nos pondremos en contacto con usted pronto.</p>');
      }else{
          $('.statusMsg').html('<span style="color:red;">Ha ocurrido algún problema, por favor intente de nuevo.</span>');
      }
      $('.submitBtn').removeAttr("disabled");
      $('.modal-body').css('opacity', '');
  }
});
