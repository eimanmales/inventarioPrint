function clientes(){

      var dt = $("#tabla").DataTable({
          	"ajax": "./Controlador/controladorCliente.php?accion=listar",
          	"columns": [
  	            { "data": "IDcliente"} ,
  	            { "data": "nombreCli" },
  	            { "data": "nit" },
                { "data": "telefonoCli"} ,
  	            { "data": "emailCli" },
                { "data": "IDcliente",
                    render: function (data) {
                              return '<a href="#" data-codigo="'+ data + 
                                     '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                              +      '<a href="#" data-codigo="'+ data + 
                                     '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>'
                    }
                }
          	]
      });

    $("#editar").on("click",".btncerrar", function(){
        $(".box-title").html("Listado de Clientes");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');  
        $(".box #nuevo").show(); 
    })  

    $(".box").on("click","#nuevo", function(){
        $(this).hide();
        $(".box-title").html("Crear Cliente");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vistas/Cliente/nuevoCliente.php') 
    })


    $("#editar").on("click","button#grabar",function(){
        $(document).ready(function() {
            // Evento para limpiar el estado de error al escribir en los inputs
            $("#fcliente input").on("input", function() {
            $(this).css("border", ""); // Restablecer el borde
            $(this).next(".error-message").hide(); // Ocultar mensaje de error
            });
        });
    let todosLlenos = true;

    // Recorrer los inputs del formulario
    $("#fcliente input").each(function() {
        if  ($(this).attr("name") !== "IDcliente" && $(this).val().trim() === '') {
            // Si el campo está vacío
            $(this).css("border", "1px solid red"); // Cambiar el borde a rojo
            $(this).next(".error-message").show(); // Mostrar mensaje de error
            
            todosLlenos = false;  
        } else {
            // Si el campo no está vacío
            $(this).css("border", ""); // Restablecer el borde
            $(this).next(".error-message").hide(); // Ocultar mensaje de error
        }
    });
     if (todosLlenos) {
      var datos=$("#fcliente").serialize();
      //console.log(datos);
      $.ajax({
            type:"get",
            url:"./Controlador/controladorCliente.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'El cliente fue grabada con éxito',
                    showConfirmButton: false,
                    timer: 1200
                })     
                    $(".box-title").html("Listado de Clientes");
                    $(".box #nuevo").show();
                    $("#editar").html('');
                    $("#editar").addClass('hide');
                    $("#editar").removeClass('show');
                    $("#listado").addClass('show');
                    $("#listado").removeClass('hide');
                    dt.page( 'last' ).draw( 'page' );
                    dt.ajax.reload(null, false);                   
             } else {
                swal({
                    position: 'center',
                    type: 'error',
                    title: 'Ocurrió un erro al grabar',
                    showConfirmButton: false,
                    timer: 1500
                });
               
            }
        });
    }
    });

    $("#editar").on("click","button#actualizar",function(){
         var datos=$("#fcliente").serialize();
         //console.log(datos);
         $.ajax({
            type:"get",
            url:"./Controlador/controladorCliente.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
   
              if(resultado.respuesta){    
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'Se actaulizaron los datos correctamente',
                    showConfirmButton: false,
                    timer: 1500
                }) 
                $(".box-title").html("Listado de Clientes");
                $("#editar").html('');
                $("#editar").addClass('hide');
                $("#editar").removeClass('show');
                $("#listado").addClass('show');
                $("#listado").removeClass('hide');
                dt.ajax.reload(null, false);       
             } else {
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!'                         
                })
            }
        });
    })

    $(".box-body").on("click","a.borrar",function(){
        //Recupera datos del formulario
        var codigo = $(this).data("codigo");
        
        swal({
              title: '¿Está seguro?',
              text: "¿Realmente desea borrar la comuna con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {
                    var request = $.ajax({
                        method: "get",                  
                        url: "./Controlador/controladorCliente.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })
                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal({
                              position: 'center',
                              type: 'success',
                              title: 'El cliente con codigo ' + codigo + ' fue borrado',
                              showConfirmButton: false,
                              timer: 1500
                            })       
                            var info = dt.page.info();   
                            if((info.end-1) == info.length)
                                dt.page( info.page-1 ).draw( 'page' );
                            dt.ajax.reload(null, false);
                            
                        } else {
                            swal({
                              type: 'error',
                              title: 'Oops...',
                              text: 'Something went wrong!'                         
                            })
                        }
                    });
                     
                    request.fail(function( jqXHR, textStatus ) {
                        swal({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!' + textStatus                          
                        })
                    });
                }
        })

    });
    
    $(".box-body").on("click","a.editar",function(){
       //$("#titulo").html("Editar Comuna");
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
       
       $(".box-title").html("Actualizar Cliente")
       $("#editar").addClass('show');
       $("#editar").removeClass('hide');
       $("#listado").addClass('hide');
       $("#listado").removeClass('show');
       $("#editar").load("./Vistas/Cliente/editarCliente.php",function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladorCliente.php",
                data: {codigo: codigo, accion:'consultar'},
                dataType:"json"
                }).done(function( cliente ) {        
                    if(cliente.respuesta === "no existe"){
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Cliente no existe!'                         
                        })
                    } else {
                        $("#IDcliente").val(cliente.IDcliente);                   
                        $("#nombreCli").val(cliente.nombreCli);
                        $("#nit").val(cliente.nit);  
                        $("#telefonoCli").val(cliente.telefonoCli);                   
                        $("#emailCli").val(cliente.emailCli);
                        
                    }
            });
 
        });
    })
}
