<?php
  require_once("Models/TTipoPago.php");

  class Pedidos extends Controllers{
    use TTipoPago;

    public function __construct(){
      parent::__construct();
      session_start();
      if (empty($_SESSION['login'])) {
        header('Location: '.base_url().'/login');
        die();
      }
      getPermisos(MPEDIDOS);
    }

    public function pedidos(){
      if (empty($_SESSION['permisosMod']['r'])) {
        header("Location:".base_url()."/dashboard");
      }
      $data['page_tag'] = "Pagos - ".NOMBRE_EMPRESA;
      $data['page_title'] = "PAGOS";
      $data['page_name'] = "Pagos";
      $data['page_functions_js'] = "functions_pedidos.js";
			$data['menu'] = "pedidos";
      $data['tiposPago'] = $this->getTiposPagoT();
      $this->views->getView($this,"pedidos",$data);
    }

    public function getPagos(){
      if($_SESSION['permisosMod']['r']){
        $idpersona = "";
        if($_SESSION['userData']['idrol'] == RCLIENTES){
          $idpersona = $_SESSION['userData']['idpersona'];
        }
        $arrData = $this->model->selectPagos();
        $meses = Meses();

        for ($i=0; $i < count($arrData); $i++) {
          $btnView = '';
          $btnEdit = '';
          $btnDelete = '';

          $arrData[$i]['monto'] = SMONEY.' '.intval($arrData[$i]['monto']);
          
          if ($_SESSION['permisosMod']['d']) {
            $btnDelete = '<button class="btn btn-danger btn-sm btnDeletePago" onClick="fntDeletePago('.$arrData[$i]['idpago'].')" title="Eliminar Pago"><i class="fas fa-trash-alt"></i></button>';
          }

          $arrData[$i]['options'] = '<div class="text-center">'.$btnDelete.' '.'</div>';
          $arrData[$i]['nombre'] = strtok($arrData[$i]['nombre'], " ");

          $mes = intval($arrData[$i]['fechapago']);
          $arrData[$i]['fechapago'] = $meses[$mes-1];
        }

          echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
      }else{
        header('Location: '.base_url().'/dashboard');
      }
      die();
    }

    public function getDeudoresold(){
        if($_SESSION['permisosMod']['r']){
            $arrData = $this->model->selectDeudores();

            $mesActual = strval(date('m'));
            $anioActual = strval(date('Y'));
            $mes = "";
            $anio = "";
            for ($i=0; $i < count($arrData); $i++) {
                $mes = substr($arrData[$i]['fechapago'],3,2);
                $anio = substr($arrData[$i]['fechapago'],6);

                if ($mesActual == $mes && $anioActual == $anio) {
                  $arrData[$i]['fechapago'] = '<span class="badge badge-success">Si Pago</span>';
                }else{
                  $arrData[$i]['fechapago'] = '<span class="badge badge-danger">No Pago</span>';
                }

                $arrData[$i]['precio'] = SMONEY.' '.intval($arrData[$i]['precio']);
                $arrData[$i]['fechainicio'] = substr($arrData[$i]['fechainicio'],0,2);
                $arrData[$i]['nombre'] = strtok($arrData[$i]['nombre'], " ");
            }

            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }else{
            header('Location: '.base_url().'/dashboard');
        }
        die();
    }

    public function getDeudores(){
        if($_SESSION['permisosMod']['r']){

            $anioctual = date('Y');
			      $mesActual = date('m');

            $arrData2 = $this->model->selectDeudores($mesActual,$anioctual);
            $arrData = $this->model->selectInquilinos();

            for ($i=0; $i < count($arrData); $i++) {

                if($arrData[$i]['idproducto'] > 0){
                  $arrData[$i]['status'] = '<span class="badge badge-danger">No Pago</span>';
                }

                for ($j=0; $j < count($arrData2); $j++) {
                  if ($arrData[$i]['idproducto'] == $arrData2[$j]['idproducto']) {
                    $arrData[$i]['status'] = '<span class="badge badge-success">Si Pago</span>';
                  }
                }

                $arrData[$i]['precio'] = SMONEY.' '.intval($arrData[$i]['precio']);
                $arrData[$i]['fechainicio'] = substr($arrData[$i]['fechainicio'],0,2);
                $arrData[$i]['nombre'] = strtok($arrData[$i]['nombre'], " ");
            }

            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }else{
            header('Location: '.base_url().'/dashboard');
        }
        die();
    }

    public function getDeudores2(){
        if($_SESSION['permisosMod']['r']){

            $anioctual = date('Y');
			      $mesActual = date('m', strtotime('-1 month'));
            if ($mesActual == 12) {
              $anioctual = $anioctual - 1;
            }

            $arrData2 = $this->model->selectDeudores($mesActual,$anioctual);
            $arrData = $this->model->selectInquilinos();

            for ($i=0; $i < count($arrData); $i++) {

                if($arrData[$i]['idproducto'] > 0){
                  $arrData[$i]['status'] = '<span class="badge badge-danger">No Pago</span>';
                }

                for ($j=0; $j < count($arrData2); $j++) {
                  if ($arrData[$i]['idproducto'] == $arrData2[$j]['idproducto']) {
                    $arrData[$i]['status'] = '<span class="badge badge-success">Si Pago</span>';
                  }
                }

                $arrData[$i]['precio'] = SMONEY.' '.intval($arrData[$i]['precio']);
                $arrData[$i]['fechainicio'] = substr($arrData[$i]['fechainicio'],0,2);
                $arrData[$i]['nombre'] = strtok($arrData[$i]['nombre'], " ");
            }

            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }else{
            header('Location: '.base_url().'/dashboard');
        }
        die();
    }

    public function getContratos(){
        if($_SESSION['permisosMod']['r']){
            $arrData = $this->model->selectContratos();

            $fechaActual = date('d/m/Y');
            $mesActual = intval(date('m'));
            $anioActual = intval(date('Y'));
            for ($i=0; $i < count($arrData); $i++) {
                $mes = intval(substr($arrData[$i]['fechafin'],3,2));
                $anio = intval(substr($arrData[$i]['fechafin'],6));

                $fechabd = $arrData[$i]['fechafin'];

                if ($mesActual == $mes && $anioActual <= $anio) {
                  $arrData[$i]['status'] = '<span class="badge badge-warning">Renovar</span>';
                }elseif ($mesActual > $mes && $anioActual == $anio) {
                  $arrData[$i]['status'] = '<span class="badge badge-danger">Vencido</span>';
                }else{
                  $arrData[$i]['status'] = '<span class="badge badge-success">Vigente</span>';
                }

                $arrData[$i]['precio'] = SMONEY.' '.intval($arrData[$i]['precio']);
                // $arrData[$i]['fechapago'] = $date_input;
            }

            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }else{
            header('Location: '.base_url().'/dashboard');
        }
        die();
    }

    public function deletePagos(){
      if ($_POST) {
        if($_SESSION['permisosMod']['d']){
          $intIdPago = intval($_POST['idpago']);
          $requestfecha = $this->model->selectPago($intIdPago);
          $fecha = intval($requestfecha['fecha']);
          $fechaActual = intval(date('d'));

          if ($fecha == $fechaActual) {
            $requestDelete = $this->model->deletePago($intIdPago);
            if ($requestDelete == 'ok') {
              $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Pago.');
            }else{
              $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Pago.');
            }
          }else{
            $arrResponse = array('status' => false, 'msg' => 'Solo se puede elimiar el pago en el día registrado.');
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
      }
      die();
    }

    public function setPago(){
      if ($_POST) {
        $idProducto = intval($_POST['listProductos']);
        $idTipopago = intval($_POST['listtipopago']);
        $dia = 01;
        $txtFechaPago = $_POST['txtFechaPago'].'-'.$dia;

        $data['productoPrecio'] = $this->model->selectProductoPago($idProducto);
        $precio = $data['productoPrecio']['precio'];

        $request_pago = $this->model->insertPago($idProducto, $idTipopago, $txtFechaPago, $precio);

        if($request_pago > 0 ) {
          $arrResponse = array('status' => true, 'idpago' => $request_pago, 'msg' => 'Pago registrado correctamente.');
        }else if($request_pago == 'exist'){
            $arrResponse = array('status' => false, 'msg' => 'El pago del mes seleccionado ya fue realizado.');
        }else{
            $arrResponse = array("status" => false, "msg" => 'No es posible hacer el pago.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }
      die();
    }

  }
?>
