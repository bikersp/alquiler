let tableCategorias;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener(
  "DOMContentLoaded",
  function () {
    tableCategorias = $("#tableCategorias").DataTable({
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
          "/Categorias/getCategorias" /* Ruta a la funcion getRoles que esta en el controlador roles.php*/,
        dataSrc: ""
      },
      columns: [
        /* Campos de la base de datos*/
        // { data:"idcategoria"},
        { data: "descripcion" },
        { data: "nombre" },
        { data: "precio" },
        { data: "categoriaid" },
        { data: "options" }
      ],
      // createdRow: function (row, data, dataIndex) {
      //   if (data["idcategoria"] > 0) {
      //     $(row).addClass("text-danger");
      //     // $(row).css("color", "#7B00AC");
      //   }
      // },
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
      iDisplayLength: 30 /*Mostrará los primero 10 registros*/,
      order: [[0, "desc"]] /*Ordenar de forma Desendente*/
    });

    if (document.querySelector("#foto")) {
      var foto = document.querySelector("#foto");
      foto.onchange = function (e) {
        var uploadFoto = document.querySelector("#foto").value;
        var fileimg = document.querySelector("#foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.querySelector("#form_alert");
        if (uploadFoto != "") {
          var type = fileimg[0].type;
          var name = fileimg[0].name;
          if (
            type != "image/jpeg" &&
            type != "image/jpg" &&
            type != "image/png"
          ) {
            contactAlert.innerHTML =
              '<p class="errorArchivo">El archivo no es válido.</p>';
            if (document.querySelector("#img")) {
              document.querySelector("#img").remove();
            }
            document.querySelector(".delPhoto").classList.add("notBlock");
            foto.value = "";
            return false;
          } else {
            contactAlert.innerHTML = "";
            if (document.querySelector("#img")) {
              document.querySelector("#img").remove();
            }
            document.querySelector(".delPhoto").classList.remove("notBlock");
            var objeto_url = nav.createObjectURL(this.files[0]);
            document.querySelector(".prevPhoto div").innerHTML =
              "<img id='img' src=" + objeto_url + ">";
          }
        } else {
          alert("No selecciono foto");
          if (document.querySelector("#img")) {
            document.querySelector("#img").remove();
          }
        }
      };
    }

    if (document.querySelector(".delPhoto")) {
      var delPhoto = document.querySelector(".delPhoto");
      delPhoto.onclick = function (e) {
        document.querySelector("#foto_remove").value = 1;
        removePhoto();
      };
    }

    // Nueva Categoria
    var formCategorias = document.querySelector("#formCategorias");
    formCategorias.onsubmit = function (e) {
      e.preventDefault(); // Evita que se recargue la pag

      // var intIdCategoria = document.querySelector('#idCategoria').value;
      var strNombre = document.querySelector("#txtNombre").value;
      var strPrecio = document.querySelector("#txtPrecio").value;
      var strDescripcion = document.querySelector("#txtDescripcion").value;
      var intStatus = document.querySelector("#listStatus").value;
      if (strNombre == "" || strDescripcion == "") {
        swal("Atención", "Todos los campos son obligatorios.", "error");
        return false;
      }

      divLoading.style.display = "flex";
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajaxUrl = base_url + "/Categorias/setCategoria";
      var formData = new FormData(formCategorias);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          var objData = JSON.parse(request.responseText);

          if (objData.status) {
            if (rowTable == "") {
              $("#tableCategorias").DataTable().ajax.reload();
            } else {
              htmlStatus =
                intStatus == 1
                  ? '<span class="badge badge-success">Habitado</span>'
                  : '<span class="badge badge-danger">No Habitado</span>';

              rowTable.cells[1].textContent = strDescripcion;
              rowTable.cells[2].textContent = strNombre;
              rowTable.cells[3].textContent = smoney + " " + strPrecio;
              // rowTable.cells[4].innerHTML = htmlStatus;
              rowTable = "";
            }
            $("#modalFormCategorias").modal("hide");
            formCategorias.reset();
            swal("Cuarto", objData.msg, "success");
            removePhoto();
          } else {
            swal("Error", objData.msg, "error");
          }
        }
        divLoading.style.display = "none";
        return false;
      };
    };
  },
  false
);

// Modal Ver Categoria
function fntViewCategoria(idcategoria) {
  // let idpersona = idpersona;
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Categorias/getCategoria/" + idcategoria;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.msg.status) {
        let estado =
          objData.msg.status == 1
            ? '<span class="badge badge-success">Activo</span>'
            : '<span class="badge badge-danger">Inactivo</span>';

        // document.querySelector("#celId").innerHTML = objData.msg.idcategoria;
        document.querySelector("#celNombre").innerHTML = objData.msg.nombre;
        document.querySelector("#celPrecio").innerHTML =
          smoney + " " + parseInt(objData.msg.precio);
        document.querySelector("#celDescripcion").innerHTML =
          objData.msg.descripcion;
        // document.querySelector("#celStatus").innerHTML = objData.msg.status;
        document.querySelector("#imgCategoria").innerHTML =
          '<img src="' + objData.msg.url_portada + '"></img>';
        $("#modalViewCategoria").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
    return false;
  };
}

// Modal Actualizar Categoria
function fntEditCategoria(element, idcategoria) {
  rowTable = element.parentNode.parentNode.parentNode;
  document.querySelector("#titleModal").innerHTML = "Actualizar Piso / Cuarto";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerUpdate");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Categorias/getCategoria/" + idcategoria;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#idCategoria").value = objData.msg.idcategoria;
        document.querySelector("#txtNombre").value = objData.msg.nombre;
        document.querySelector("#txtPrecio").value = parseInt(
          objData.msg.precio
        );
        document.querySelector("#txtDescripcion").value =
          objData.msg.descripcion;
        document.querySelector("#foto_actual").value = objData.msg.portada;
        document.querySelector("#foto_remove").value = 0;

        if (objData.msg.status == 1) {
          document.querySelector("#listStatus").value = 1;
        } else {
          document.querySelector("#listStatus").value = 2;
        }
        $("#listStatus").selectpicker("render");

        if (document.querySelector("#img")) {
          document.querySelector("#img").src = objData.msg.url_portada;
        } else {
          document.querySelector(".prevPhoto div").innerHTML =
            '<img id="img" src="' + objData.msg.url_portada + '"></img>';
        }

        if (objData.msg.portada == "portada.png") {
          document.querySelector(".delPhoto").classList.add("notBlock");
        } else {
          document.querySelector(".delPhoto").classList.remove("notBlock");
        }
        $("#modalFormCategorias").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
    return false;
  };
}

// Eliminar Categoria
function fntDeleteCategoria(idcategoria) {
  // let idUsuario = idpersona;
  swal(
    {
      title: "Eliminar Categoria",
      text: "¿Realmente quiere eliminar la Categoria?",
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
        let ajaxDeleteRol = base_url + "/Categorias/deleteCategoria";
        let strData = "idCategoria=" + idcategoria;
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
              $("#tableCategorias").DataTable().ajax.reload();
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

function removePhoto() {
  document.querySelector("#foto").value = "";
  document.querySelector(".delPhoto").classList.add("notBlock");
  if (document.querySelector("#img")) {
    document.querySelector("#img").remove();
  }
}

// Modal Nuevo
function openModal() {
  rowTable = "";
  document.querySelector("#idCategoria").value = "";
  document.querySelector("#titleModal").innerHTML = "Nuevo Piso / Cuarto";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#formCategorias").reset();
  removePhoto();

  $("#modalFormCategorias").modal("show");
}
