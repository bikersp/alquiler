let rowTable = "";
let tableGastos;
tableGastos = $("#tableGastos").dataTable({
  aProcessing: true,
  aServerSide: true,
  language: {
    url:
      base_url +
      "/Assets/json/datatable_spanish.json" /*Idioma de visualizacion*/
  },
  ajax: {
    url: " " + base_url + "/gastos/getGastos",
    dataSrc: ""
  },
  columns: [
    { data: "idgasto" },
    { data: "nombre" },
    { data: "descripcion" },
    { data: "monto" },
    { data: "fecha" },
    { data: "fechapago" },
    { data: "options" }
  ],
  resonsieve: "true",
  bDestroy: true,
  iDisplayLength: 10,
  order: [[0, "desc"]]
});

// Modal Nuevo Gastos
function openModal() {
  rowTable = "";
  document.querySelector("#frmGasto").reset();
  $("#modalFormGasto").modal("show");
}

// Eliminar
function fntDeleteGasto(idgasto) {
  // let idrol = idrol;

  swal(
    {
      title: "Eliminar Gasto",
      text: "¿Realmente quiere eliminar el Gasto?",
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
        let ajaxDeleteRol = base_url + "/Gastos/deleteGasto";
        let strData = "idgasto=" + idgasto;
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
              $("#tableGastos").DataTable().ajax.reload();
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

//Gastos
if (document.querySelector("#frmGasto")) {
  let frmGasto = document.querySelector("#frmGasto");
  frmGasto.addEventListener(
    "submit",
    function (e) {
      e.preventDefault();

      let idservicio = document.querySelector("#txtServicio").value;
      let mensaje = document.querySelector("#mensaje").value;
      let monto = document.querySelector("#monto").value;
      let fecha = document.querySelector("#txtFechaPago").value;

      if (idservicio == "") {
        swal("", "El Servicio es obligatorio", "error");
        return false;
      }

      if (monto == "") {
        swal("", "Ingresar un monto", "error");
        return false;
      }

      if (fecha == "") {
        swal("", "Selecciona una fecha", "error");
        return false;
      }

      divLoading.style.display = "flex";
      let request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      let ajaxUrl = base_url + "/gastos/setGasto";
      let formData = new FormData(frmGasto);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
      request.onreadystatechange = function () {
        if (request.readyState != 4) return;
        if (request.status == 200) {
          let objData = JSON.parse(request.responseText);
          if (objData.status) {
            swal("", objData.msg, "success");
            $("#modalFormGasto").modal("hide");
            document.querySelector("#frmGasto").reset();
            $("#tableGastos").DataTable().ajax.reload();
          } else {
            swal("", objData.msg, "error");
          }
        }
        divLoading.style.display = "none";
        return false;
      };
    },
    false
  );
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