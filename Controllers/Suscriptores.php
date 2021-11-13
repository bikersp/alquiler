<?php
	class Suscriptores extends Controllers{
		public function __construct(){
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MSUSCRIPTORES);
		}

		public function Suscriptores(){
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Suscriptores - ".NOMBRE_EMPRESA;
			$data['page_title'] = "SUSCRIPTORES";
			$data['page_name'] = "Suscriptores";
			$data['page_functions_js'] = "functions_suscriptores.js";
			$data['menu'] = "suscriptores";
			$this->views->getView($this,"suscriptores",$data);
		}

		public function getSuscriptores(){
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectSuscriptores();

				for ($i=0; $i < count($arrData); $i++) {
					$btnDelete = '';
					if ($_SESSION['permisosMod']['d']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDeleteSuscripcion" onClick="fntDeleteSuscripcion('.$arrData[$i]['idsuscripcion'].')" title="Eliminar Suscripción"><i class="fas fa-trash-alt"></i></button>';
					}

					$arrData[$i]['options'] = '<div class="text-center">'.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

    public function deleteSuscriptor(){
      if ($_POST) {
        if($_SESSION['permisosMod']['d']){
          $intIdsuscripcion = intval($_POST['idsuscripcion']);
          $requestDelete = $this->model->deleteSuscriptor($intIdsuscripcion);
          if($requestDelete) {
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Suscripción.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Suscripción.');
					}
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
      }
      die();
    }

	}
?>