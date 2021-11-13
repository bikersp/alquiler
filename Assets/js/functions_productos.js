// Importar Script BarCode
// document.write(`<script src="${base_url}/Assets/js/plugins/JsBarcode.all.min.js"></script>`);

// Arreglar conflicto modal y tinymce con bootstrap modal
$(document).on("focusin", function (e) {
  if ($(e.target).closest(".tox-dialog").length) {
    e.stopImmediatePropagation();
  }
});

let tableProductos;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

// Tabla Productos
tableProductos = $("#tableProductos").DataTable({
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
      "/Productos/getProductos" /* Ruta a la funcion getRoles que esta en el controlador roles.php*/,
    dataSrc: ""
  },
  columns: [
    // { data: "idproducto" },
    // { data: "codigo" },
    { data: "nombre" },
    { data: "categoria" },
    { data: "piso" },
    { data: "precio" },
    { data: "telefono" },
    { data: "fechainicio" },
    // { data: "status" },
    { data: "options" }
  ],
  // createdRow: function (row, data, dataIndex) {
  //   if (data["stock"] <= 10) {
      // $(row).addClass("text-danger");
      // $(row).css("color", "#7B00AC");
  //   }
  // },
  columnDefs: [
    { className: "text-center", targets: [2] },
    { className: "text-center", targets: [3] },
    { className: "text-center", targets: [4] },
    { className: "text-right", targets: [5] },
    { className: "text-center", targets: [6] }
  ],
  // dom: "lBfrtip",
  // buttons: [
  //   {
  //     extend: "copyHtml5",
  //     text: "<i class='far fa-copy'></i> Copiar",
  //     titleAttr: "Copiar",
  //     className: "btn btn-secondary",
  //     exportOptions: {
  //       columns: [0, 1, 2, 3]
  //     }
  //   },
  //   {
  //     extend: "excelHtml5",
  //     text: "<i class='fas fa-file-excel'></i> Excel",
  //     titleAttr: "Esportar a Excel",
  //     className: "btn btn-success",
  //     exportOptions: {
  //       columns: [0, 1, 2, 3]
  //     }
  //   },
  //   {
  //     extend: "pdfHtml5",
  //     text: "<i class='fas fa-file-pdf'></i> PDF",
  //     titleAttr: "Esportar a PDF",
  //     className: "btn btn-danger",
  //     exportOptions: {
  //       columns: [0, 1, 2, 3]
  //     }
  //   },
  //   {
  //     extend: "csvHtml5",
  //     text: "<i class='fas fa-file-csv'></i> CSV",
  //     titleAttr: "Esportar a CSV",
  //     className: "btn btn-info",
  //     exportOptions: {
  //       columns: [0, 1, 2, 3]
  //     }
  //   }
  // ],
  responsieve: "true",
  bDestroy: true,
  ordering: false,
  iDisplayLength: 30 /*Mostrará los primero 10 registros*/,
  order: [[0, "desc"]] /*Ordenar de forma Desendente*/
});

// Ingresar Producto
window.addEventListener(
  "load",
  function () {
    // Ingresar Producto
    if (document.querySelector("#formProductos")) {
      let formProductos = document.querySelector("#formProductos");
      formProductos.onsubmit = function (e) {
        e.preventDefault();
        let strNombre = document.querySelector("#txtNombre").value;
        let intTelefono = document.querySelector("#txtTelefono").value;
        let intCodigo = document.querySelector("#txtCodigo").value;
        let strPrecio = document.querySelector("#txtPrecio").value;
        let intStock = document.querySelector("#txtStock").value;
        let txtFechaI = document.querySelector("#txtFechaI").value;
        let txtFechaF = document.querySelector("#txtFechaF").value;
        let intStatus = document.querySelector("#listStatus").value;

        if (
          strNombre == "" ||
          intCodigo == "" ||
          strPrecio == "" ||
          txtFechaI == "" ||
          txtFechaF == "" ||
          intStock == ""
        ) {
          swal("Atención", "Todos los campos son obligatorios.", "error");
          return false;
        }
        if (intCodigo.length < 7) {
          swal(
            "Atención",
            "El Documento debe ser mayor que 5 dígitos.",
            "error"
          );
          return false;
        }

        divLoading.style.display = "flex";
        tinyMCE.triggerSave();
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Productos/setProducto";
        let formData = new FormData(formProductos);
        request.open("POST", ajaxUrl, true);
        request.send(formData);

        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
              swal("", objData.msg, "success");
              document.querySelector("#idProducto").value = objData.idproducto;
              document
                .querySelector("#containerGallery")
                .classList.remove("notblock");

              if (rowTable == "") {
                $("#tableProductos").DataTable().ajax.reload();
              } else {
                htmlStatus =
                  intStatus == 1
                    ? '<span class="badge badge-success">Activo</span>'
                    : '<span class="badge badge-danger">Inactivo</span>';

                rowTable.cells[0].textContent = strNombre;
                rowTable.cells[4].textContent = intTelefono;
                // rowTable.cells[5].innerHTML = htmlStatus;
                rowTable = "";
              }
            } else {
              swal("Error", objData.msg, "error");
            }
          }
          divLoading.style.display = "none";
          return false;
        };
      };
    }

    // AddImage
    if (document.querySelector(".btnAddImage")) {
      let btnAddImage = document.querySelector(".btnAddImage");
      btnAddImage.onclick = function (e) {
        let key = Date.now();
        let newElement = document.createElement("div");
        newElement.id = "div" + key;
        newElement.innerHTML = `
            <div class="prevImage"></div>
            <input type="file" name="foto" id="img${key}" class="inputUploadfile">
            <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload "></i></label>
            <button class="btnDeleteImage notblock" type="button" onclick="fntDeleteItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
        document.querySelector("#containerImages").appendChild(newElement);
        document.querySelector("#div" + key + " .btnUploadfile").click();
        fntInputFile();
      };
    }

    fntCategorias();
    fntInputFile();
  },
  false
);

// Carga de Imagenes
function fntInputFile() {
  let inputUploadfile = document.querySelectorAll(".inputUploadfile");
  inputUploadfile.forEach(function (inputUploadfile) {
    inputUploadfile.addEventListener("change", function () {
      let idProducto = document.querySelector("#idProducto").value;
      let parentId = this.parentNode.getAttribute("id");
      let idFile = this.getAttribute("id");
      let uploadFoto = document.querySelector("#" + idFile).value;
      let fileimg = document.querySelector("#" + idFile).files;
      let prevImg = document.querySelector("#" + parentId + " .prevImage");
      let nav = window.URL || window.webkitURL;
      if (uploadFoto != "") {
        let type = fileimg[0].type;
        let name = fileimg[0].name;
        if (
          type != "image/jpeg" &&
          type != "image/jpg" &&
          type != "image/png"
        ) {
          prevImg.innerHTML = "Archivo no válido";
          uploadFoto.value = "";
          return false;
        } else {
          let objeto_url = nav.createObjectURL(this.files[0]);
          prevImg.innerHTML = `<img class="loading" src="${base_url}/Assets/img/icon/loading.svg" >`;

          let request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP");
          let ajaxUrl = base_url + "/Productos/setImage";
          let formData = new FormData();
          formData.append("idProducto", idProducto);
          formData.append("foto", this.files[0]);
          request.open("POST", ajaxUrl, true);
          request.send(formData);

          request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
              let objData = JSON.parse(request.responseText);
              if (objData.status) {
                prevImg.innerHTML = `<img src="${objeto_url}">`;
                document
                  .querySelector("#" + parentId + " .btnDeleteImage")
                  .setAttribute("imgname", objData.imgname);
                document
                  .querySelector("#" + parentId + " .btnUploadfile")
                  .classList.add("notblock");
                document
                  .querySelector("#" + parentId + " .btnDeleteImage")
                  .classList.remove("notblock");
              } else {
                swal("Error", objData.msg, "error");
              }
            }
          };
        }
      }
    });
  });
}

// Eliminar Imagenes
function fntDeleteItem(element) {
  let nameImg = document
    .querySelector(element + " .btnDeleteImage")
    .getAttribute("imgname");
  let idProducto = document.querySelector("#idProducto").value;
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Productos/deleteFile";

  let formData = new FormData();
  formData.append("idproducto", idProducto);
  formData.append("file", nameImg);
  request.open("POST", ajaxUrl, true);
  request.send(formData);

  request.onreadystatechange = function () {
    if (request.readyState != 4) return;
    if (request.status == 200) {
      let objData = JSON.parse(request.responseText);
      if (objData.status) {
        let itemRemove = document.querySelector(element);
        itemRemove.parentNode.removeChild(itemRemove);
      } else {
        swal("", objData.msg, "error");
      }
    }
  };
}

// Libreria de Editor de texto tinymce
tinymce.init({
  selector: "#txtDescripcion",
  width: "100%",
  height: 400,
  statubar: true,
  plugins: [
    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    "save table contextmenu directionality emoticons template paste textcolor"
  ],
  toolbar:
    "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons"
});

// Select Categorias
function fntCategorias() {
  if (document.querySelector("#listCategoria")) {
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/Categorias/getSelectCategorias";
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listCategoria").innerHTML =
          request.responseText;
        $("#listCategoria").selectpicker("render");
      }
    };
  }
}

// Ver Producto
function fntViewProducto(idProducto) {
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Productos/getProducto/" + idProducto;
  request.open("GET", ajaxUrl, true);
  request.send();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);
      if (objData.status) {
        let htmlImage = "";
        let objProducto = objData.data;
        let estadoProducto =
          objProducto.status == 1
            ? '<span class="badge badge-success">Activo</span>'
            : '<span class="badge badge-danger">Inactivo</span>';

        document.querySelector("#celCodigo").innerHTML = objProducto.codigo;
        document.querySelector("#celNombre").innerHTML = objProducto.nombre;
        document.querySelector("#celPrecio").innerHTML = smoney + parseInt(objProducto.precio);
        document.querySelector("#celStock").innerHTML = objProducto.stock;
        document.querySelector("#celTelefono").innerHTML = objProducto.telefono;
        document.querySelector("#celFechaI").innerHTML = objProducto.fechainicio;
        document.querySelector("#celFechaF").innerHTML = objProducto.fechafin;
        document.querySelector("#celCategoria").innerHTML = objProducto.categoria;
        document.querySelector("#celPiso").innerHTML = objProducto.piso;
        // document.querySelector("#celStatus").innerHTML = estadoProducto;
        document.querySelector("#celDescripcion").innerHTML =
          objProducto.descripcion;

        if (objProducto.images.length > 0) {
          let objProductos = objProducto.images;
          for (let p = 0; p < objProductos.length; p++) {
            htmlImage += `<img src="${objProductos[p].url_image}"></img>`;
          }
        }
        document.querySelector("#celFotos").innerHTML = htmlImage;
        $("#modalViewProducto").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}

// Editar Producto
function fntEditProducto(element, idProducto) {
  rowTable = element.parentNode.parentNode.parentNode;
  document.querySelector("#titleModal").innerHTML = "Actualizar Inquilino";
  document.querySelector(".modal-header").classList.replace("headerRegister", "headerUpdate");
  document.querySelector("#btnActionForm").classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Productos/getProducto/" + idProducto;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);
      if (objData.status) {
        let htmlImage = "";
        let objProducto = objData.data;
        document.querySelector("#idProducto").value = objProducto.idproducto;
        document.querySelector("#txtNombre").value = objProducto.nombre;
        document.querySelector("#txtDescripcion").value = objProducto.descripcion;
        document.querySelector("#txtTelefono").value = objProducto.telefono;
        document.querySelector("#txtCodigo").value = objProducto.codigo;
        document.querySelector("#txtPrecio").value = parseInt(objProducto.precio);
        document.querySelector("#txtStock").value = objProducto.stock;
        document.querySelector("#txtFechaI").value = objProducto.fechainicio;
        document.querySelector("#txtFechaF").value = objProducto.fechafin;
        document.querySelector("#listCategoria").value =
          objProducto.categoriaid;
        document.querySelector("#listStatus").value = objProducto.status;
        tinymce.activeEditor.setContent(objProducto.descripcion);
        $("#listCategoria").selectpicker("render");
        $("#listStatus").selectpicker("render");
        // fntBarcode();

        if (objProducto.images.length > 0) {
          let objProductos = objProducto.images;
          for (let p = 0; p < objProductos.length; p++) {
            let key = Date.now() + p;
            htmlImage += `<div id="div${key}">
                            <div class="prevImage">
                            <img src="${objProductos[p].url_image}"></img>
                            </div>
                            <button type="button" class="btnDeleteImage" onclick="fntDeleteItem('#div${key}')" imgname="${objProductos[p].img}">
                            <i class="fas fa-trash-alt"></i></button></div>`;
          }
        }
        document.querySelector("#containerImages").innerHTML = htmlImage;
        // document.querySelector("#divBarCode").classList.remove("notblock");
        document
          .querySelector("#containerGallery")
          .classList.remove("notblock");
        $("#modalFormProductos").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}

// Eliminar Producto
function fntDeleteProducto(idProducto) {
  swal(
    {
      title: "Eliminar Producto",
      text: "¿Realmente quiere eliminar el producto?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true
    },
    function (isConfirm) {
      if (isConfirm) {
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Productos/deleteProducto";
        let strData = "idProducto=" + idProducto;
        request.open("POST", ajaxUrl, true);
        request.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        request.send(strData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
              swal("Eliminar!", objData.msg, "success");
              $("#tableProductos").DataTable().ajax.reload();
              // $("#listCategoria").selectpicker("render");
              // fntCategorias();
            } else {
              swal("Atención!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}

// Modal Nuevo
function openModal() {
  rowTable = "";
  document.querySelector("#idProducto").value = "";
  document.querySelector("#titleModal").innerHTML = "Nuevo Inquilino";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#formProductos").reset();

  document.querySelector("#containerGallery").classList.add("notblock");
  document.querySelector("#containerImages").innerHTML = "";

  $("#modalFormProductos").modal("show");
}

// $("#dialog-form").dialog({
//   modal: true,
//   width: 500,
//   height: 500
// });

$('.date-picker').datepicker({
  closeText: 'Cerrar',
  prevText: '<Ant',
  nextText: 'Sig>',
  currentText: 'Hoy',
  changeMonth: true,
  changeYear: true,
  showButtonPanel: true,
  dateFormat: "dd/mm/yy",
  dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
  dayNamesMin: [ "Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab" ],
  // firstDay: 1,
  gotoCurrent: true,
  monthNamesShort: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre" ],

  beforeShow: function(el, dp) {
    $(el).parent().append($('#ui-datepicker-div'));
    $('#ui-datepicker-div').hide();
  },
  // onClose: function(dateText, inst) {
  //     $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth,1));
  // }
});

// $("#fechainicio").datetimepicker({
//   minDate: new Date(),
//   defaultDate: new Date(),
//   useCurrent: false,
//   format: "L",
//   showTodayButton: true,
//   allowInputToggle: true,
//   locale: "es",
//   icons: {
//     next: "fa fa-chevron-right",
//     previous: "fa fa-chevron-left",
//     today: "todayText"
//   }
// });

// $("#fechafin").datetimepicker({
//   minDate: new Date(),
//   defaultDate: new Date(),
//   useCurrent: false,
//   format: "L",
//   showTodayButton: true,
//   allowInputToggle: true,
//   locale: "es",
//   icons: {
//     next: "fa fa-chevron-right",
//     previous: "fa fa-chevron-left",
//     today: "todayText"
//   }
// });
