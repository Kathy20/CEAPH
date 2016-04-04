
/*

Instituto Tecnologico de Costa Rica
Centro Academico de San Jose
Ingenieria en Computacion

Proyecto de Ingenieria de Software
Pictogramas

Estudiantes
- Kathy Brenes
- Benjamin Lewis
- Miuyin Yong

Profesor
 - Erick Hernandez.


Mediante este archivo se pasan los valores de los inputs del form 
para agregar pictogramas.
*/


$(document).ready(function(){
        // hide messages 
        $("#error").load("../php/agregarPictograma.php");
        //$("#error").hide();
        $("#sent-form-msg").hide();

        $('#agregarPictogramaForm #submit').click(function () {

            $("#error").hide();
            $("#error").fadeIn().text('Palabra'+ $('#palabra').val());

             $.ajax({
                url: "/public_html/prototipo1/js/php/agregarPictograma.php",
                type:"POST",
                data: 'palabra=' + $("input#palabra").val() + 
                      'categoria=' + $("input#categoria").val() + 
                      'userImage=' + $("input#userImage").val(),
                beforeSend: function () {
                       alert("Procesando, espere por favor...");
                    },
                success: function(msg)
                {
                    alert('Email Sent');
                }               
            });
         return false;//to avoid page reload
        });
    });