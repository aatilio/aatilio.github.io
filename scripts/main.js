//codigo js para el enfoque de las imagenes
$(document).ready(function() {
  AOS.init( {
  // elimine el comentario a continuación para que las animaciones en desplazamiento se reproduzcan solo una vez
  
  }); // inicializa la animación en la biblioteca de desplazamiento
});

// Desplazamiento suave para enlaces con hash
$('a.smooth-scroll')
.click(function(event) {
  // Enlaces en la página
  if (
    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
    && 
    location.hostname == this.hostname
  ) {
    // Averiguar el elemento al que desplazarse
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
    // ¿Existe un objetivo de desplazamiento?
    if (target.length) {
      // Solo evita el valor predeterminado si la animación realmente va a suceder
      event.preventDefault();
      $('html, body').animate({
        scrollTop: target.offset().top
      }, 1000, function() {
        // Devolución de llamada después de la animación
        // ¡Debe cambiar el enfoque!
        var $target = $(target);
        $target.focus();
        if ($target.is(":focus")) { // Comprobando si el objetivo estaba enfocado
          return false;
        } else {
          $target.attr('tabindex','-1'); // Agregar tabindex para elementos no enfocables
          $target.focus(); // Poner foco de nuevo
        };
      });
    }
  }
});
/*
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
});*/

//ENVIO DE FORMUALRIO DE CONTACTO USANDO UNA WEB "formspree"
//api que devuelbe 200 ok si es que el formulario se envi correctamente
const $form = document.querySelector('#form')

$form.addEventListener('submit', handleSubmit)

async function handleSubmit(event) {
  event.preventDefault()
  const form = new FormData(this)

  const response = await fetch(this.action, {
    method: this.method,
    body: form,
    headers: {
      'Accept': 'application/json'
    }
  })
  if (response.ok) {
    this.reset()
    alert('Gracias por contactarme, te escribiré pronto')
  }
}


//BTC USD
//codigo para hacer usu de la API de coindesk para el precio de BTC
const dollarContainer = document.getElementById('dollar');
const usdAmount = document.getElementById('usd-amount');

fetch('https://api.coindesk.com/v1/bpi/currentprice.json')
    .then(response => response.json())
    .then(data => displayData(data));

const displayData = data => {
    const usd = data.bpi.USD.rate_float;
    usdAmount.textContent = `$${usd} USD`;
    const totalDollarItems = Math.trunc(usd / 1000);
    for(let i = 0; i < totalDollarItems; i++) {
        const newDollar = document.createElement('div');
        newDollar.setAttribute("style", `animation-delay:.${10 + i}s;`);
        newDollar.textContent = '$';
        newDollar.setAttribute('class', 'coin dollar-item');
        dollarContainer.appendChild(newDollar);
    } 
}


//FOOTER
/*
function mostrarFooter(name) {
      copyright = new Date();
      update = copyright.getFullYear();
      document.write(" © Sorian " + update + "   By  " + name);
}*/
