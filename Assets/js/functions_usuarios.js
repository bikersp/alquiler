let tableUsuarios;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

// Agregar Eventos al cargar documento
document.addEventListener(
  "DOMContentLoaded",
  function () {
    tableUsuarios = $("#tableUsuarios").DataTable({
      /*ID de la tabla*/ aProcessing: true,
      aServerside: true,
      language: {
        url:
          base_url +
          "/Assets/json/datatable_spanish.json" /*Idioma de visualizacion*/
      },
      ajax: {
        url:
          base_url +
          "/Usuarios/getUsuarios" /* Ruta a la funcion getRoles que esta en el controlador roles.php*/,
        dataSrc: ""
      },
      columns: [
        /* Campos de la base de datos*/
        // {"data":"idpersona"},
        { data: "identificacion" },
        { data: "nombres" },
        // { data: "apellidos" },
        { data: "telefono" },
        { data: "email_user" },
        { data: "nombrerol" },
        { data: "status" },
        { data: "options" }
      ],
      // dom: "lBfrtip",
      // buttons: [
      //   {
      //     extend: "copyHtml5",
      //     text: "<i class='far fa-copy'></i> Copiar",
      //     titleAttr: "Copiar",
      //     className: "btn btn-secondary"
      //   },
      //   {
      //     extend: "excelHtml5",
      //     text: "<i class='fas fa-file-excel'></i> Excel",
      //     titleAttr: "Esportar a Excel",
      //     className: "btn btn-success"
      //   },
      //   {
      //     extend: "pdfHtml5",
      //     text: "<i class='fas fa-file-pdf'></i> PDF",
      //     titleAttr: "Esportar a PDF",
      //     className: "btn btn-danger"
      //   },
      //   {
      //     extend: "csvHtml5",
      //     text: "<i class='fas fa-file-csv'></i> CSV",
      //     titleAttr: "Esportar a CSV",
      //     className: "btn btn-info"
      //   }
      // ],
      responsieve: "true",
      bDestroy: true,
      iDisplayLength: 10 /*Mostrará los primero 10 registros*/,
      order: [[0, "desc"]] /*Ordenar de forma Desendente*/
    });

    // Crear o Editar Usuario
    if (document.querySelector("#formUsuario")) {
      let formUsuario = document.querySelector("#formUsuario");
      formUsuario.onsubmit = function (e) {
        e.preventDefault();
        let strIdentificacion =
          document.querySelector("#txtIdentificacion").value;
        let strNombre = document.querySelector("#txtNombre").value;
        let strApellido = document.querySelector("#txtApellido").value;
        let strEmail = document.querySelector("#txtEmail").value;
        let intTelefono = document.querySelector("#txtTelefono").value;
        let strTipousuario = document.querySelector("#listRolid").value;
        let strPassword = document.querySelector("#txtPassword").value;
        let intStatus = document.querySelector("#listStatus").value;
        let intCuentas = document.querySelector("#txtCuentas").value;

        if (
          strIdentificacion == "" ||
          strNombre == "" ||
          strApellido == "" ||
          strEmail == "" ||
          intTelefono == ""
        ) {
          swal("Atención", "Todos los campos son obligatorios.", "error");
          return false;
        }

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) {
          if (elementsValid[i].classList.contains("is-invalid")) {
            swal(
              "Atención",
              "Por favor verifique los campos en rojo.",
              "error"
            );
            return false;
          }
        }

        divLoading.style.display = "flex";
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Usuarios/setUsuario";
        let formData = new FormData(formUsuario);
        request.open("POST", ajaxUrl, true);
        request.send(formData);

        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
              if (rowTable == "") {
                $("#tableUsuarios").DataTable().ajax.reload();
                console.log(rowTable);
              } else {
                htmlStatus =
                  intStatus == 1
                    ? '<span class="badge badge-success">Activo</span>'
                    : '<span class="badge badge-danger">Inactivo</span>';

                rowTable.cells[0].textContent = strIdentificacion;
                rowTable.cells[1].textContent = strNombre;
                // rowTable.cells[3].textContent = strApellido;
                rowTable.cells[2].textContent = intTelefono;
                rowTable.cells[3].textContent = strEmail;
                rowTable.cells[4].textContent =
                  document.querySelector("#listRolid").selectedOptions[0].text;
                rowTable.cells[5].innerHTML = htmlStatus;
                rowTable = "";
              }
              $("#modalFormUsuario").modal("hide");
              formUsuario.reset();
              swal("Usuarios", objData.msg, "success");
            } else {
              swal("Error", objData.msg, "error");
            }
          }
          divLoading.style.display = "none";
          return false;
        };
      };
    }

    // Actualizar Perfil
    if (document.querySelector("#formPerfil")) {
      let formPerfil = document.querySelector("#formPerfil");
      formPerfil.onsubmit = function (e) {
        e.preventDefault();
        let strIdentificacion =
          document.querySelector("#txtIdentificacion").value;
        let strNombre = document.querySelector("#txtNombre").value;
        let strApellido = document.querySelector("#txtApellido").value;
        let intTelefono = document.querySelector("#txtTelefono").value;
        let strPassword = document.querySelector("#txtPassword").value;
        let strCuentas = document.querySelector("#txtCuentas").value;
        let strPasswordConfirm = document.querySelector(
          "#txtPasswordConfirm"
        ).value;

        if (
          strIdentificacion == "" ||
          strNombre == "" ||
          strApellido == "" ||
          intTelefono == ""
        ) {
          swal("Atención", "Todos los campos son obligatorios.", "error");
          return false;
        }

        if (strPassword != "" || strPasswordConfirm != "") {
          if (strPassword != strPasswordConfirm) {
            swal("Atención", "Las contraseñas no son iguales", "info");
            return false;
          }
          if (strPassword.length < 5) {
            swal(
              "Atención",
              "Las contraseñas debe tener un mínimo de 5 caracteres",
              "info"
            );
            return false;
          }
        }

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) {
          if (elementsValid[i].classList.contains("is-invalid")) {
            swal(
              "Atención",
              "Por favor verifique los campos en rojo.",
              "error"
            );
            return false;
          }
        }

        divLoading.style.display = "flex";
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Usuarios/putPerfil";
        let formData = new FormData(formPerfil);
        request.open("POST", ajaxUrl, true);
        request.send(formData);

        request.onreadystatechange = function () {
          if (request.readyState != 4) return;
          if (request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
              $("#modalFormPerfil").modal("hide");
              swal(
                {
                  title: "",
                  text: objData.msg,
                  type: "success",
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false
                },
                function (isConfirm) {
                  if (isConfirm) {
                    location.reload();
                  }
                }
              );
            } else {
              swal("Error", objData.msg, "error");
            }
          }
          divLoading.style.display = "none";
          return false;
        };
      };
    }

    // Actualizar Dados Fiscales
    if (document.querySelector("#formDataFiscal")) {
      let formDataFiscal = document.querySelector("#formDataFiscal");
      formDataFiscal.onsubmit = function (e) {
        e.preventDefault();
        let strNit = document.querySelector("#txtNit").value;
        let strNomFiscal = document.querySelector("#txtNombreFiscal").value;
        let strDirFiscal = document.querySelector("#txtDirFiscal").value;

        if (strNit == "" || strNomFiscal == "" || strDirFiscal == "") {
          swal("Atención", "Todos los campos son obligatorios.", "error");
          return false;
        }

        divLoading.style.display = "flex";
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Usuarios/putDFiscal";
        let formData = new FormData(formDataFiscal);
        request.open("POST", ajaxUrl, true);
        request.send(formData);

        request.onreadystatechange = function () {
          if (request.readyState != 4) return;
          if (request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
              $("#modalFormPerfil").modal("hide");
              swal(
                {
                  title: "",
                  text: objData.msg,
                  type: "success",
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false
                },
                function (isConfirm) {
                  if (isConfirm) {
                    location.reload();
                  }
                }
              );
            } else {
              swal("Error", objData.msg, "error");
            }
          }
          divLoading.style.display = "none";
          return false;
        };
      };
    }
  },
  false
);

// Cargar Funciones
window.addEventListener(
  "load",
  function () {
    fntRolesUsuario();
    // fntViewUsuario();
    // fntEditUsuario();
    // fntDeleteUsuario();
  },
  false
);

// Cargar Select Roles
function fntRolesUsuario() {
  if (document.querySelector("#listRolid")) {
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/Roles/getSelectRoles/";
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listRolid").innerHTML = request.responseText;
        // document.querySelector('#listRolid').value = 1;
        $("#listRolid").selectpicker("render");
      }
    };
  }
}

// Modal Ver Usuario
function fntViewUsuario(idpersona) {
  // let idpersona = idpersona;
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Usuarios/getUsuario/" + idpersona;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {
        let estadoUsuario =
          objData.data.status == 1
            ? '<span class="badge badge-success">Activo</span>'
            : '<span class="badge badge-danger">Inactivo</span>';

        document.querySelector("#celIdentificacion").innerHTML =
          objData.data.identificacion;
        document.querySelector("#celNombre").innerHTML = objData.data.nombres;
        document.querySelector("#celApellido").innerHTML =
          objData.data.apellidos;
        document.querySelector("#celTelefono").innerHTML =
          objData.data.telefono;
        document.querySelector("#celEmail").innerHTML = objData.data.email_user;
        document.querySelector("#celTipoUsuario").innerHTML =
          objData.data.nombrerol;
        document.querySelector("#celEstado").innerHTML = estadoUsuario;
        document.querySelector("#celCuentas").innerHTML = objData.data.cuentas;
        $("#modalViewUser").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
    return false;
  };
}

// Modal Editar Usuario
function fntEditUsuario(element, idpersona) {
  rowTable = element.parentNode.parentNode.parentNode;
  // console.log(rowTable);
  document.querySelector("#titleModal").innerHTML = "Actualizar Usuario";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerUpdate");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  // let idpersona = idpersona;
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Usuarios/getUsuario/" + idpersona;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {
        let estadoUsuario =
          objData.data.status == 1
            ? '<span class="badge badge-success">Activo</span>'
            : '<span class="badge badge-danger">Inactivo</span>';

        document.querySelector("#idUsuario").value = objData.data.idpersona;
        document.querySelector("#txtIdentificacion").value =
          objData.data.identificacion;
        document.querySelector("#txtNombre").value = objData.data.nombres;
        document.querySelector("#txtApellido").value = objData.data.apellidos;
        document.querySelector("#txtTelefono").value = objData.data.telefono;
        document.querySelector("#txtEmail").value = objData.data.email_user;
        document.querySelector("#listRolid").value = objData.data.idrol;
        document.querySelector("#txtCuentas").value = objData.data.cuentas;
        $("#listRolid").selectpicker("render");

        if (objData.data.status == 1) {
          document.querySelector("#listStatus").value = 1;
        } else {
          document.querySelector("#listStatus").value = 2;
        }
        $("#listStatus").selectpicker("render");
      }
    }
    $("#modalFormUsuario").modal("show");
    return false;
  };
}

// Eliminar Usuario
function fntDeleteUsuario(idpersona) {
  // let idUsuario = idpersona;
  swal(
    {
      title: "Eliminar Usuario",
      text: "¿Realmente quiere eliminar el Usuario?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, eliminar",
      cancelButtonText: "No, cancelar",
      closeOnConfirm: false,
      closeOnCancel: true
    },
    function (isConfirm) {
      if (isConfirm) {
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxDeleteRol = base_url + "/Usuarios/deleteUsuario";
        let strData = "idUsuario=" + idpersona;
        request.open("POST", ajaxDeleteRol, true);
        request.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        request.send(strData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
              swal("Eliminar!", objData.msg, "success");
              $("#tableUsuarios").DataTable().ajax.reload();
            } else {
              swal("Atención!", objData.msg, "error");
            }
          }
          return false;
        };
      }
    }
  );
}

// Modal Nuevo Usuario
function openModal() {
  rowTable = "";
  document.querySelector("#idUsuario").value = "";
  document.querySelector("#titleModal").innerHTML = "Nuevo Usuario";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#formUsuario").reset();

  $("#modalFormUsuario").modal("show");
}

// Modal Perfil
function openModalPerfil() {
  $("#modalFormPerfil").modal("show");
}
