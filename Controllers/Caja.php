<?php
	class Caja extends Controllers{
		public function __construct(){
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
		}

		public function Caja(){
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Caja - ".NOMBRE_EMPRESA;
			$data['page_title'] = "CAJA";
			$data['page_name'] = "Caja";
			$data['page_functions_js'] = "functions_caja.js";
			$data['menu'] = "caja";

			$anio = date('Y');
			$mes = date('m');
			$data['pagosMes'] = $this->model->selectPagosMes($anio, $mes);
			$data['gastosMes'] = $this->model->selectGastosMes($anio, $mes);
			$data['gastosOtros'] = $this->model->selectOtros($anio, $mes);
			$data['cajaMes'] = $this->model->selectCajaMes($anio, $mes);

			$anioctual = date('Y');
			$mesAnterior = date('m', strtotime('-1 month'));
			if ($mesAnterior == 12) {
				$anioctual = $anioctual - 1;
			}
			$data['pagosMesAnterior'] = $this->model->selectPagosMes($anioctual, $mesAnterior);
			$data['gastosMesAnterior'] = $this->model->selectGastosMes($anioctual, $mesAnterior);
			$data['gastosOtrosAnterior'] = $this->model->selectOtros($anioctual, $mesAnterior);
			$data['cajaMesAnterior'] = $this->model->selectCajaMes($anioctual, $mesAnterior);

			$data['caja'] = $this->model->selectCaja();
			$data['otro'] = $this->model->selectOtro();
			$this->views->getView($this,"caja",$data);
		}

		public function getGastos(){
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectGastos();
				$meses = Meses();

				for ($i=0; $i < count($arrData); $i++) {
					$btnDelete = '';
					if ($_SESSION['permisosMod']['d']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDeleteGasto" onClick="fntDeleteGasto('.$arrData[$i]['idgasto'].')" title="Eliminar Gasto"><i class="fas fa-trash-alt"></i></button>';
						// $btnView = '<button class="btn btn-info btn-sm btnViewContactos" onClick="fntViewInfo('.$arrData[$i]['idcontacto'].')" title="Ver Mensaje"><i class="fas fa-eye"></i></button>';
					}

					$arrData[$i]['options'] = '<div class="text-center">'.$btnDelete.'</div>';
					$arrData[$i]['monto'] = SMONEY.' '.$arrData[$i]['monto'];
					$mes = intval(substr($arrData[$i]['fechapago'],3,2));
          $arrData[$i]['fechapago'] = $meses[$mes-1];
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setGasto(){
			if($_POST){
				$nombre = strClean($_POST['txtServicio']);
				$mensaje  = strClean($_POST['mensaje']);
				$fecha = $_POST['txtFechaPago'];
				$monto = strClean($_POST['monto']);

				$request_gasto = $this->model->insertGasto($nombre,$mensaje,$fecha,$monto);

				if($request_gasto > 0){
					$arrResponse = array('status' => true, 'msg' => 'Gasto Guardados correctamente.');
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