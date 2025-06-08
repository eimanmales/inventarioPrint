function dispositivos(){
    var dt = $("#tabla").DataTable({
          	"ajax": "./Controlador/controladorDispositivo.php?accion=listar",
          	"columns": [
  	            { "data": "IDdispositivo"} ,
  	            { "data": "serial" },
  	            { "data": "marca" },
                { "data": "modelo" },
                { "data": "estadoDis"} ,
  	            { "data": "nombreUsu" },
                { "data": "nombreCli"} ,
  	            { "data": "ubicacion" },
                { "data": "IDdispositivo",
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
        $("#editar").load('./Vistas/Dispositivo/nuevoDispositivo.php', function(){
            $.ajax({
                type:"POST",
                url:"Controlador/controladorUsuario.php",
                data: {accion:'listar'},
                dataType:"json"
             }).done(function( resultado ) {
                                    
                $("#IDusuario option").remove()       
                $("#IDusuario").append("<option selecte value=''>Seleccione...</option>")
                $.each(resultado.data, function (index, value) { 
                    $("#IDusuario").append("<option value='" + value.IDusuario + "'>" + value.nombreUsu + "</option>")
                 });
             });
            $.ajax({
               type:"get",
               url:"./Controlador/controladorCliente.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    
                $.each(resultado.data, function (index, value) {
                  $("#editar #IDcliente").append("<option value='" + value.IDcliente + "'>" + value.nombreCli + "</option>")
                });
            });
        }); 
    })


    $("#editar").on("click","button#grabar",function(){
         $(document).ready(function() {
            // Evento para limpiar el estado de error al escribir en los inputs
            $("#fdispositivo input, select").on("input select", function() {
            $(this).css("border", ""); // Restablecer el borde
            $(this).next(".error-message").hide(); // Ocultar mensaje de error
            });
        });
    let todosLlenos = true;

    // Recorrer los inputs del formulario
    $("#fdispositivo input, select").each(function() {
        if  ($(this).attr("name") !== "IDdispositivo" && $(this).val().trim() === '') {
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
      var datos=$("#fdispositivo").serialize();
      console.log(datos);
      $.ajax({
            type:"get",
            url:"./Controlador/controladorDispositivo.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'El dispositivo fue guardado con éxito',
                    showConfirmButton: false,
                    timer: 1200
                })     
                    $(".box-title").html("Listado de Dispositivos");
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
                    title: 'Ocurrió un erro al guardar',
                    showConfirmButton: false,
                    timer: 1500
                });
               
            }
        });
    }
    });

    $("#editar").on("click","button#actualizar",function(){
         var datos=$("#fdispositivo").serialize();
         console.log(datos);
         $.ajax({
            type:"get",
            url:"./Controlador/controladorDispositivo.php",
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
                $(".box-title").html("Listado de Dispositivo");
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
              text: "¿Realmente desea borrar el Dispositivo con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {
                    var request = $.ajax({
                        method: "get",                  
                        url: "./Controlador/controladorDispositivo.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })
                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal({
                              position: 'center',
                              type: 'success',
                              title: 'El dispositivo con codigo ' + codigo + ' fue borrado',
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
       var cliente;
       var usuario;
       $(".box-title").html("Actualizar Dispositivo")
       $("#editar").addClass('show');
       $("#editar").removeClass('hide');
       $("#listado").addClass('hide');
       $("#listado").removeClass('show');
       $("#editar").load("./Vistas/Dispositivo/editarDispositivo.php",function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladorDispositivo.php",
                data: {codigo: codigo, accion:'consultar'},
                dataType:"json"
                }).done(function( dispositivo ) {        
                    if(dispositivo.respuesta === "no existe"){
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Dispositivo no existe!'                         
                        })
                    } else {
                        $("#IDdispositivo").val(dispositivo.IDdispositivo);                   
                        $("#serial").val(dispositivo.serial);
                        $("#marca").val(dispositivo.marca);  
                        $("#modelo").val(dispositivo.modelo);                   
                        $("#estadoDis").val(dispositivo.estadoDis);
                        cliente = dispositivo.IDcliente;
                        $("#IDcliente").val(cliente); 
                        usuario = dispositivo.IDusuario; 
                        $("#IDusuario").val(usuario);                    
                        $("#ubicacion").val(dispositivo.ubicacion);
                        
                    }
            });
 
        });
        $.ajax({
                type:"get",
                url:"./Controlador/controladorCliente.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {
                $.each(resultado.data, function (index, value) {
                if(cliente === value.IDcliente){
                    $("#editar #IDcliente").append("<option selected value='" + value.IDcliente + "'>" + value.nombreCli + "</option>")
                }else {
                    $("#editar #IDcliente").append("<option value='" + value.IDcliente + "'>" + value.nombreCli + "</option>")
                }
                });
            });

            $.ajax({
                type:"POST",
                url:"./Controlador/controladorUsuario.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {
                $.each(resultado.data, function (index, value) {
                if(usuario === value.IDusuario){
                    $("#editar #IDusuario").append("<option selected value='" + value.IDusuario + "'>" + value.nombreUsu + "</option>")
                }else {
                    $("#editar #IDusuario").append("<option value='" + value.IDusuario + "'>" + value.nombreUsu + "</option>")
                }
                });
            });
    })
}
