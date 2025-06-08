function usuario() {
  $("#login-form").on("submit", function (e) {
    e.preventDefault();

    var datos = $(this).serialize();
    console.log(datos);

    $.ajax({
      type: "post",
      url: "./Controlador/controladorUsuario.php",
      data: datos,
      dataType: "json",
    })
      .done(function (resultado) {
        if (resultado.respuesta === "existe") {
          location.href = "adminper.php";
        } else {
          swal({
            position: "center",
            type: "error",
            title: "Usuario y/o Password incorrecto",
            showConfirmButton: false,
            timer: 1500,
          }).then(() => {
            $("#usuario").focus().select();
          });
        }
      })
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.error("Error en AJAX:", textStatus, errorThrown);
      });
  });

  var dt = $("#tabla").DataTable({
    ajax: {
      url: "./Controlador/controladorUsuario.php",
      type: "POST",
      data: { accion: "listar" },
      dataSrc: function (json) {
        //console.log("Respuesta del servidor:", json); // para depuración
        if (json.error) {
          alert("Error: " + json.error);
          return [];
        }
        return json.data || [];
      },
      error: function (xhr, status, error) {
        console.error("Error AJAX:", xhr.responseText);
      },
    },
    columns: [
      { data: "IDusuario" },
      { data: "nombreUsu" },
      { data: "documentoUsu" },
      { data: "emailUsu" },
      { data: "clave" },
      { data: "rol" },
      { data: "fotoUsu" },
      { data: "estadoUsu" },
      {
        data: "IDusuario",
        render: function (data) {
          return (
            '<a href="#" data-codigo="' +
            data +
            '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>' +
            '<a href="#" data-codigo="' +
            data +
            '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>'
          );
        },
      },
    ],
  });

  $("#editar").on("click", ".btncerrar", function () {
    $(".box-title").html("Listado de Usuarios");
    $("#editar").addClass("hide");
    $("#editar").removeClass("show");
    $("#listado").addClass("show");
    $("#listado").removeClass("hide");
    $(".box #nuevo").show();
  });

  $(".box").on("click", "#nuevo", function () {
    $(this).hide();
    $(".box-title").html("Crear Usuario");
    $("#editar").addClass("show");
    $("#editar").removeClass("hide");
    $("#listado").addClass("hide");
    $("#listado").removeClass("show");
    $("#editar").load("./Vistas/Usuario/nuevoUsuario.php");
  });


  $("#editar").on("click", "button#grabar", function () {
    $(document).ready(function() {
    // Evento para limpiar el estado de error al escribir en los inputs
    $("#fusuario input, select").on("input", function() {
        $(this).css("border", ""); // Restablecer el borde
        $(this).next(".error-message").hide(); // Ocultar mensaje de error
    });
})
    let todosLlenos = true;

    // Recorrer los inputs del formulario
    $("#fusuario input, select").each(function() {
        if  ($(this).attr("name") !== "IDusuario" && $(this).val().trim() === '') {
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
    var datos = $("#fusuario").serialize();
    //console.log(datos);
    $.ajax({
      url: "./Controlador/controladorUsuario.php",
      type: "POST",
      data: datos,
      dataType: "json",
    })
      .done(function (resultado) {
        if (resultado.respuesta) {
          swal({
            position: "center",
            type: "success",
            title: "La Usuario fue grabada con éxito",
            showConfirmButton: false,
            timer: 1200,
          });
          $(".box-title").html("Listado de Usuario");
          $(".box #nuevo").show();
          $("#editar").html("");
          $("#editar").addClass("hide");
          $("#editar").removeClass("show");
          $("#listado").addClass("show");
          $("#listado").removeClass("hide");
          dt.page("last").draw("page");
          dt.ajax.reload(null, false);
        } else {
          swal({
            position: "center",
            type: "error",
            title: "Ocurrió un erro al grabar",
            showConfirmButton: false,
            timer: 1500,
          });
        }
      })
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.error("Error en AJAX:", textStatus, errorThrown);
        console.error("Respuesta recibida:", jqXHR.responseText); // <--- aquí ves el error completo
      });
    }
  });

  $("#editar").on("click", "button#actualizar", function () {
    var datos = $("#fusuario").serialize();
    //console.log(datos);
    $.ajax({
      type: "POST",
      url: "./Controlador/controladorUsuario.php",
      data: datos,
      dataType: "json",
    }).done(function (resultado) {
      if (resultado.respuesta) {
        swal({
          position: "center",
          type: "success",
          title: "Se actaulizaron los datos correctamente",
          showConfirmButton: false,
          timer: 1500,
        });
        $(".box-title").html("Listado de Usuarios");
        $("#editar").html("");
        $("#editar").addClass("hide");
        $("#editar").removeClass("show");
        $("#listado").addClass("show");
        $("#listado").removeClass("hide");
        dt.ajax.reload(null, false);
      } else {
        swal({
          type: "error",
          title: "Oops...",
          text: "Something went wrong!",
        });
      }
    });
  });

  $(".box-body").on("click", "a.borrar", function () {
    //Recupera datos del formulario
    var codigo = $(this).data("codigo");

    swal({
      title: "¿Está seguro?",
      text: "¿Realmente desea borrar el usuario con codigo : " + codigo + " ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Borrarlo!",
    }).then((decision) => {
      if (decision.value) {
        var request = $.ajax({
          method: "post",
          url: "./Controlador/controladorUsuario.php",
          data: { codigo: codigo, accion: "borrar" },
          dataType: "json",
        });
        request.done(function (resultado) {
          if (resultado.respuesta == "correcto") {
            swal({
              position: "center",
              type: "success",
              title: "El usuario con codigo " + codigo + " fue borrada",
              showConfirmButton: false,
              timer: 1500,
            });
            var info = dt.page.info();
            if (info.end - 1 == info.length)
              dt.page(info.page - 1).draw("page");
            dt.ajax.reload(null, false);
          } else {
            swal({
              type: "error",
              title: "Oops...",
              text: "Something went wrong!",
            });
          }
        });

        request.fail(function (jqXHR, textStatus) {
          swal({
            type: "error",
            title: "Oops...",
            text: "Something went wrong!" + textStatus,
          });
        });
      }
    });
  });


  $(".box-body").on("click", "a.editar", function () {
    //Recupera datos del fromulario
    var codigo = $(this).data("codigo");
    
    $(".box-title").html("Actualizar Usuario");
    $("#editar").addClass("show");
    $("#editar").removeClass("hide");
    $("#listado").addClass("hide");
    $("#listado").removeClass("show");
    $("#editar").load("./Vistas/Usuario/editarUsuario.php", function () {
      $.ajax({
        type: "POST",
        url: "./Controlador/controladorUsuario.php",
        data: { codigo: codigo, accion: "consultar" },
        dataType: "json",
      }).done(function (usuario) {
        if (usuario.respuesta === "no existe") {
          swal({
            type: "error",
            title: "Oops...",
            text: "Usuario no existe!",
          });
        } else {
          $("#IDusuario").val(usuario.IDusuario);
          $("#nombreUsu").val(usuario.nombreUsu);
          $("#documentoUsu").val(usuario.documentoUsu);
          $("#emailUsu").val(usuario.emailUsu);
          $("#clave").val(usuario.clave);
          $("#rol").val(usuario.rol);
          $("#fotoUsu").val(usuario.fotoUsu);
          $("#estadoUsu").val(usuario.estadoUsu);
        }
      });

    });
  });
}
