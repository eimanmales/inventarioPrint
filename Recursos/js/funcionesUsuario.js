function usuario() {
    $("#login-form").on('submit', function(e) {
        e.preventDefault();

        var datos = $(this).serialize();
        console.log(datos);

        $.ajax({
            type: "post",
            url: "./Controlador/controladorUsuario.php",
            data: datos,
            dataType: "json"
        }).done(function(resultado) {
            if (resultado.respuesta === "existe") {
                location.href = "adminper.php";
            } else {
                swal({
                    position: 'center',
                    type: 'error', 
                    title: 'Usuario y/o Password incorrecto',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    $("#usuario").focus().select();
                });
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Error en AJAX:", textStatus, errorThrown);
        });
    });




    var dt = $("#tabla").DataTable({
          	ajax: {
                url: "./Controlador/controladorUsuario.php",
                type: "POST", // 👈 Esto indica que es POST
                data: { accion: "listar" }, // 👈 Aquí indicas los datos que enviarás por POST
                dataSrc: function(json) {
                    console.log("Respuesta del servidor:", json); // para depuración
                    if (json.error) {
                        alert("Error: " + json.error);
                        return [];
                    }
                     return json.data || [];
                    //return json.data || [];
                },
                    error: function(xhr, status, error) {
                    console.error("Error AJAX:", xhr.responseText);
                }
            },
          	"columns": [
  	            { "data": "IDusuario"} ,
  	            { "data": "nombreUsu" },
  	            { "data": "documentoUsu" },
                { "data": "emailUsu"},
                { "data": "clave"} ,
  	            { "data": "rol" },
  	            { "data": "fotoUsu" },
                { "data": "estadoUsu"}, 
                { "data": "acciones",       
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
        $(".box-title").html("Listado de Comunas");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');  
        $(".box #nuevo").show(); 
    })  

    $(".box").on("click","#nuevo", function(){
        $(this).hide();
        $(".box-title").html("Crear Comuna");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vistas/Comuna/nuevaComuna.php', function(){
            $.ajax({
               type:"get",
               url:"./Controlador/controladorMunicipio.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #muni_codi").append("<option value='" + value.muni_codi + "'>" + value.muni_nomb + "</option>")
                });
            });
        });
        
    })

    $("#editar").on("click","button#grabar",function(){
      var datos=$("#fcomuna").serialize();
      //console.log(datos);
      $.ajax({
            type:"get",
            url:"./Controlador/controladorComuna.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'La comuna fue grabada con éxito',
                    showConfirmButton: false,
                    timer: 1200
                })     
                    $(".box-title").html("Listado de Comunas");
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
    });

    $("#editar").on("click","button#actualizar",function(){
         var datos=$("#fcomuna").serialize();
         console.log(datos);
         $.ajax({
            type:"get",
            url:"./Controlador/controladorComuna.php",
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
                $(".box-title").html("Listado de Comunas");
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
                        url: "./Controlador/controladorComuna.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })
                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal({
                              position: 'center',
                              type: 'success',
                              title: 'La comuna con codigo ' + codigo + ' fue borrada',
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
       var municipio;
       $(".box-title").html("Actualizar Comuna")
       $("#editar").addClass('show');
       $("#editar").removeClass('hide');
       $("#listado").addClass('hide');
       $("#listado").removeClass('show');
       $("#editar").load("./Vistas/Comuna/editarComuna.php",function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladorComuna.php",
                data: {codigo: codigo, accion:'consultar'},
                dataType:"json"
                }).done(function( comuna ) {        
                    if(comuna.respuesta === "no existe"){
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Comuna no existe!'                         
                        })
                    } else {
                        $("#comu_codi").val(comuna.codigo);                   
                        $("#comu_nomb").val(comuna.comuna);
                        municipio = comuna.municipio;
                    }
            });
 
            $.ajax({
                type:"get",
                url:"./Controlador/controladorMunicipio.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(municipio === value.muni_codi){
                    $("#editar #muni_codi").append("<option selected value='" + value.muni_codi + "'>" + value.muni_nomb + "</option>")
                }else {
                    $("#editar #muni_codi").append("<option value='" + value.muni_codi + "'>" + value.muni_nomb + "</option>")
                }
                });
            });
        });
    })
}


function usuario1() {
    $("#login-form").on('submit', function(e) {
        e.preventDefault();
        var datos = $(this).serialize();

        $.ajax({
            type: "post",
            url: "./Controlador/controladorUsuario.php",
            data: datos,
            dataType: "text" // <- cambia a texto temporalmente
        }).done(function(respuesta) {
            console.log("Respuesta cruda:", respuesta);

            try {
                var resultado = JSON.parse(respuesta);
                console.log("Parseado:", resultado);
            } catch (e) {
                console.error("No se pudo parsear JSON:", e.message);
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error:", textStatus, errorThrown);
        });
    });
}

