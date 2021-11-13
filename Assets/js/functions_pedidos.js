let tablePedidos;
let tableDeudores;
let tableContratos;
let rowTable;
let url;
let url2;
let def;
let def2;

// TablaPedidos
tablePedidos = $("#tablePedidos").DataTable({
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
      "/Pedidos/getPagos" /* Ruta a la funcion getRoles que esta en el controlador roles.php*/,
    dataSrc: ""
  },
  columns: [
    { data: "idpago" },
    { data: "usuario" },
    { data: "nombre" },
    { data: "categoria" },
    { data: "piso" },
    { data: "monto" },
    { data: "tipopago" },
    { data: "fecha" },
    { data: "fechapago" },
    { data: "options" }
  ],
  columnDefs: [
    { className: "text-left", targets: [0] },
    // { className: "text-right", targets: [4] },
    { className: "text-center", targets: [4] }
  ],
  responsieve: "true",
  bDestroy: true,
  iDisplayLength: 10 /*Mostrará los primero 10 registros*/,
  order: [[0, "desc"]] /*Ordenar de forma Desendente*/
});

//Deudores
function getDeudores() {
  def = new jQuery.Deferred();
  $.ajax({
    url: base_url + "/Pedidos/getDeudores",
    jsonp: "cb",
    dataType: "json",
    success: function (data) {
      $.each(data, function (index, item) {
        $("#tableDeudores").append(
          "<tr><td>" +
            item.nombre +
            "</td><td>" +
            item.categoria +
            "</td><td>" +
            item.fechainicio +
            "</td><td>" +
            item.status +
            "</td></tr>"
        );
      });
    }
  });
}

//Deudores 2
function getDeudores2() {
  def = new jQuery.Deferred();
  $.ajax({
    url: base_url + "/Pedidos/getDeudores2",
    jsonp: "cb",
    dataType: "json",
    success: function (data) {
      $.each(data, function (index, item) {
        $("#tableDeudores2").append(
          "<tr><td>" +
            item.nombre +
            "</td><td>" +
            item.categoria +
            "</td><td>" +
            item.fechainicio +
            "</td><td>" +
            item.status +
            "</td></tr>"
        );
      });
    }
  });
}

//Contratos
function getContratos() {
  def = new jQuery.Deferred();
  $.ajax({
    url: base_url + "/Pedidos/getContratos",
    jsonp: "cb",
    dataType: "json",
    success: function (data) {
      $.each(data, function (index, item) {
        $("#tableContratos").append(
          "<tr><td>" +
            item.nombre +
            "</td><td>" +
            item.categoria +
            "</td><td>" +
            item.fechafin +
            "</td><td>" +
            item.status +
            "</td></tr>"
        );
      });
      // setTimeout(function () {
      //   yourFunction();
      // }, 200000);
    }
  });
}

$(document).ready(function () {
  // getDeudores();
  setTimeout(function () {
    getDeudores();
  }, 500);
  setTimeout(function () {
    getDeudores2();
  }, 750);
  setTimeout(function () {
    getContratos();
  }, 1000);
});

document.addEventListener(
  "DOMContentLoaded",
  function () {
    if (document.querySelector("#formPago")) {
      let formPago = document.querySelector("#formPago");
      formPago.onsubmit = function (e) {
        e.preventDefault();
        let listProductos = document.querySelector("#listProductos").value;
        let listtipopago = document.querySelector("#listtipopago").value;
        let txtFechaPago = document.querySelector("#txtFechaPago").value;

        if (listProductos == "" || listtipopago == "" || txtFechaPago == "") {
          swal("Atención", "Todos los campos son obligatorios.", "error");
          return false;
        }

        divLoading.style.display = "flex";
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Pedidos/setPago";
        let formData = new FormData(formPago);
        request.open("POST", ajaxUrl, true);
        request.send(formData);

        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
              if (rowTable == "") {
                $("#tablePedidos").DataTable().ajax.reload();
                console.log(rowTable);
              } else {
                rowTable = "";
              }

              let element = document.querySelector("#tableDeudores tbody");
              while (element.firstChild) {
                element.removeChild(element.firstChild);
              }
              let element2 = document.querySelector("#tableDeudores2 tbody");
              while (element2.firstChild) {
                element2.removeChild(element2.firstChild);
              }
              setTimeout(function () {
                getDeudores();
              }, 200);
              setTimeout(function () {
                getDeudores2();
              }, 400);

              $("#modalFormPago").modal("hide");
              formPago.reset();
              swal("Exito", objData.msg, "success");
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

window.addEventListener("load", function () {
  fntProductos();
});

// Eliminar
function fntDeletePago(idpago) {
  // let idrol = idrol;

  swal(
    {
      title: "Eliminar Pago",
      text: "¿Realmente quiere eliminar el Pago?",
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
        let ajaxDeleteRol = base_url + "/Pedidos/deletePagos";
        let strData = "idpago=" + idpago;
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
              $("#tablePedidos").DataTable().ajax.reload();
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

// Modal Nuevo
function openModal() {
  rowTable = "";
  // document.querySelector("#idPago").value = "";
  document.querySelector("#formPago").reset();
  $("#modalFormPago").modal("show");
}

// Select Productos
function fntProductos() {
  if (document.querySelector("#listProductos")) {
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/Productos/getSelectProductos";
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listProductos").innerHTML =
          request.responseText;
        $("#listProductos").selectpicker("render");
      }
    };
  }
}

// $("#fechaPago").datetimepicker({
//   defaultDate: new Date(),
//   useCurrent: false,
//   format:'YYYY-MM',
//   // format: "L",
//   showTodayButton: true,
//   allowInputToggle: true,
//   locale: "es",
//   icons: {
//     next: "fa fa-chevron-right",
//     previous: "fa fa-chevron-left",
//     today: "todayText"
//   }
// });

$('.date-picker').datepicker( {
  closeText: 'Cerrar',
  prevText: '<Ant',
  nextText: 'Sig>',
  currentText: 'Hoy',
  monthNames: ['-1', '-2', '-3', '-4', '-5', '-6', '-7', '-8', '-9', '-10', '-11', '-12'],
  monthNamesShort: ['Enero','Febrero','Marzo','Abril', 'Mayo','Junio','Julio','Agosto','Septiembre', 'Octubre','Noviembre','Diciembre'],
  changeMonth: true,
  changeYear: true,
  showButtonPanel: true,
  dateFormat: 'yyMM',
  showDays: false,
  beforeShow: function(el, dp) {
    $(el).parent().append($('#ui-datepicker-div'));
    $('#ui-datepicker-div').hide();
  },
  onClose: function(dateText, inst) {
      $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
  }
});