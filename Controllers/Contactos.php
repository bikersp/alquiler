<?php
	class Contactos extends Controllers{
		public function __construct(){
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MCONTACTOS);
		}

		public function Contactos(){
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Mensajes - ".NOMBRE_EMPRESA;
			$data['page_title'] = "MENSAJES";
			$data['page_name'] = "Mensajes";
			$data['page_functions_js'] = "functions_contactos.js";
			$data['menu'] = "contactos";
			$this->views->getView($this,"contactos",$data);
		}

		public function getContactos(){
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectContactos();

				for ($i=0; $i < count($arrData); $i++) {
					$btnDelete = '';
					if ($_SESSION['permisosMod']['d']) {
						// $btnDelete = '<button class="btn btn-danger btn-sm btnDeleteSuscripcion" onClick="fntDeleteSuscripcion('.$arrData[$i]['idcontactos'].')" title="Eliminar Suscripción"><i class="fas fa-trash-alt"></i></button>';
						$btnView = '<button class="btn btn-info btn-sm btnViewContactos" onClick="fntViewInfo('.$arrData[$i]['idcontacto'].')" title="Ver Mensaje"><i class="fas fa-eye"></i></button>';
					}

					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

    public function getMensaje($idmensaje){
      if($_SESSION['permisosMod']['r']){
          $idmensaje = intval($idmensaje);
          if($idmensaje > 0){
              $arrData = $this->model->selectMensaje($idmensaje);
              if(empty($arrData)) {
                  $arrResponse = array("status" => false, "msg" => 'Datos no encontrados.');
              }else{
                  $arrResponse = array("status" => true, "data" => $arrData);
              }
              echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
          }
      }
      die();
    }

    public function deleteContacto(){
      if ($_POST) {
        if($_SESSION['permisosMod']['d']){
          $intIdcontacto = intval($_POST['idcontactos']);
          $requestDelete = $this->model->deleteContacto($intIdcontacto);
          if($requestDelete) {
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Mensaje.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Mensaje.');
					}
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
      }
      die();
    }

	}
?>