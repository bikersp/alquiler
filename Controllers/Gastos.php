<?php
	class Gastos extends Controllers{
		public function __construct(){
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MGASTOS);
		}

		public function Gastos(){
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Gastos - ".NOMBRE_EMPRESA;
			$data['page_title'] = "GASTOS";
			$data['page_name'] = "Gastos";
			$data['page_functions_js'] = "functions_gastos.js";
			$data['menu'] = "gastos";
			$this->views->getView($this,"gastos",$data);
		}

		public function getGastos(){
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectGastos();
				$meses = Meses();

				for ($i=0; $i < count($arrData); $i++) {
					$btnDelete = '';
					if ($_SESSION['permisosMod']['d']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDeleteGasto" onClick="fntDeleteGasto('.$arrData[$i]['idgasto'].')" title="Eliminar Gasto"><i class="fas fa-trash-alt"></i></button>';
					}

					$arrData[$i]['options'] = '<div class="text-center">'.$btnDelete.'</div>';
					$arrData[$i]['monto'] = SMONEY.' '.$arrData[$i]['monto'];
					$mes = intval($arrData[$i]['fechapago']);
          $arrData[$i]['fechapago'] = $meses[$mes-1];
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setGasto(){
			if($_POST){
				$idservicio = intval($_POST['txtServicio']);
				$mensaje  = strClean($_POST['mensaje']);
				$monto = strClean($_POST['monto']);
				$dia = 01;
        $fecha = $_POST['txtFechaPago'].'-'.$dia;

				$request_gasto = $this->model->insertGasto($idservicio,$mensaje,$fecha,$monto);

				if($request_gasto > 0){
					$arrResponse = array('status' => true, 'msg' => 'Gasto registrado correctamente.');
				}else if($request_gasto == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'El gasto del mes seleccionado ya fue realizado.');
				}else{
					$arrResponse = array('status' => false, 'msg' => "No es posible registrar el gasto.");
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

    public function deleteGasto(){
      if ($_POST) {
        if($_SESSION['permisosMod']['d']){
          $intIdGasto = intval($_POST['idgasto']);
          $requestfecha = $this->model->selectGasto($intIdGasto);
          $fecha = intval($requestfecha['fecha']);
          $fechaActual = intval(date('d'));

          if ($fecha == $fechaActual) {
            $requestDelete = $this->model->deleteGasto($intIdGasto);
            if ($requestDelete == 'ok') {
              $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Gasto.');
            }else{
              $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Gasto.');
            }
          }else{
            $arrResponse = array('status' => false, 'msg' => 'Solo se puede elimiar el gasto en el día registrado.');
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
      }
      die();
    }

	}
?>