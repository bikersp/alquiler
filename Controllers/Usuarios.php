<?php
    class Usuarios extends Controllers{

        public function __construct(){
            parent::__construct();
            session_start();
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/dashboard');
            }
            getPermisos(MUSUARIOS);
        }

        public function usuarios(){
            if (empty($_SESSION['permisosMod']['r'])) {
                header("Location:".base_url().'/dashboard');
            }
            $data['page_tag'] = "Usuarios - ".NOMBRE_EMPRESA;
            $data['page_title'] = "USUARIOS";
            $data['page_name'] = "Usuarios";
            $data['page_functions_js'] = "functions_usuarios.js";
			$data['menu'] = "usuarios";
            $this->views->getView($this,"usuarios",$data);
        }

        public function setUsuario(){
            if($_POST){
                if (empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus'])) {

                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $idUsuario = intval($_POST['idUsuario']);
                    $strIdentificacion = strClean($_POST['txtIdentificacion']);
                    $strNombre = ucwords(strClean($_POST['txtNombre']));
                    $strApellido = ucwords(strClean($_POST['txtApellido']));
                    $intTelefono = intval(strClean($_POST['txtTelefono']));
                    $strEmail = strtolower(strClean($_POST['txtEmail']));
                    $intTipoId = intval(strClean($_POST['listRolid']));
                    $intStatus = intval(strClean($_POST['listStatus']));
                    $txtCuentas = $_POST['txtCuentas'];
                    $request_user = "";

                    if ($idUsuario == 0) {
                        $option = 1;
                        $strPassword = empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256", $_POST['txtPassword']);

                        if($_SESSION['permisosMod']['w']){
                            $request_user = $this->model->insertUsuario($strIdentificacion,
                                                                    $strNombre,
                                                                    $strApellido,
                                                                    $txtCuentas,
                                                                    $intTelefono,
                                                                    $strEmail,
                                                                    $strPassword,
                                                                    $intTipoId,
                                                                    $intStatus);
                        }
                    }else{
                        $option = 2;
                        $strPassword = empty($_POST['txtPassword']) ? "" : hash("SHA256", $_POST['txtPassword']);

                        if($_SESSION['permisosMod']['u']){
                            $request_user = $this->model->updateUsuario($idUsuario,
                                                                    $strIdentificacion,
                                                                    $strNombre,
                                                                    $strApellido,
                                                                    $txtCuentas,
                                                                    $intTelefono,
                                                                    $strEmail,
                                                                    $strPassword,
                                                                    $intTipoId,
                                                                    $intStatus);
                        }
                    }

                    if ($request_user > 0) {
                        if ($option == 1) {
                            $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
                        }else{
                            $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                        }
                    }else if ($request_user == 'exist') {
                        $arrResponse = array("status" => false, "msg" => '¡Atención el email o la identificación ya existe, ingrese otro.');
                    }else{
                        $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getUsuarios(){
            if($_SESSION['permisosMod']['r']){
                $arrData = $this->model->selectUsuarios();

                for ($i=0; $i < count($arrData); $i++) {
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    if ($arrData[$i]['status'] == 1) {
                      $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                    }else{
                      $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                    }

                    if ($_SESSION['permisosMod']['r']) {
                        $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['idpersona'].')" title="Ver Usuario"><i class="far fa-eye"></i></button>';
                    }
                    if ($_SESSION['permisosMod']['u']) {
                        if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) || ($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1)) {
                            $btnEdit = '<button class="btn btn-primary btn-sm btnEditUsuario" onClick="fntEditUsuario(this,'.$arrData[$i]['idpersona'].')" title="Editar Usuario"><i class="fas fa-pencil-alt"></i></button>';
                        }else{
                            $btnEdit = '<button class="btn btn-primary btn-sm disabled btnEditUsuario" title="Editar Usuario"><i class="fas fa-pencil-alt"></i></button>';
                        }
                    }
                    if ($_SESSION['permisosMod']['d']) {
                        if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) || ($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) and ($_SESSION['userData']['idpersona'] != $arrData[$i]['idpersona'])) {
                            $btnDelete = '<button class="btn btn-danger btn-sm btnDeleteUsuario" onClick="fntDeleteUsuario('.$arrData[$i]['idpersona'].')" title="Eliminar Usuario"><i class="fas fa-trash-alt"></i></button>';
                        }else{
                            $btnDelete = '<button class="btn btn-danger btn-sm disabled btnDeleteUsuario" title="Eliminar Usuario"><i class="fas fa-trash-alt"></i></button>';
                        }
                    }

                    $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                }

                echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            }else{
                header('Location: '.base_url().'/dashboard');
            }
            die();
        }

        public function getUsuario($idpersona){
            if($_SESSION['permisosMod']['r']){
                $idusuario = intval($idpersona);

                if ($idusuario > 0) {
                    $arrData = $this->model->selectUsuario($idusuario);
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

        public function deleteUsuario(){
          if ($_POST) {
            if($_SESSION['permisosMod']['d']){
                $intIdpersona = intval($_POST['idUsuario']);
                $requestDelete = $this->model->deleteUsuario($intIdpersona);
                if ($requestDelete) {
                  $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Usuario.');
                }else{
                  $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Usuario.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE); 
            }
          }
          die();
        }

        public function perfil(){
            $data['page_tag'] = "Perfil";
            $data['page_title'] = "Perfil de usuario";
            $data['page_name'] = "perfil";
            $data['page_functions_js'] = "functions_usuarios.js";
            $this->views->getView($this,"perfil",$data);
        }

        public function putPerfil(){
            if ($_POST) {
                if (empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono'])) {
                    $arrResponse = array("status" => false, "msg", "Datos incorrectos.");
                }else{
                    $idUsuario = $_SESSION['idUser'];
                    $strIdentificacion = strClean($_POST['txtIdentificacion']);
                    $strNombre = ucwords(strClean($_POST['txtNombre']));
                    $strApellido = ucwords(strClean($_POST['txtApellido']));
                    $strCuentas = $_POST['txtCuentas'];
                    $intTelefono = intval(strClean($_POST['txtTelefono']));
                    $strPassword = "";

                    if (!empty($_POST['txtPassword'])) {
                        $strPassword = hash("SHA256", $_POST['txtPassword']);
                    }

                    $request_user = $this->model->updatePerfil($idUsuario,
                                                                    $strIdentificacion,
                                                                    $strNombre,
                                                                    $strApellido,
                                                                    $strCuentas,
                                                                    $intTelefono,
                                                                    $strPassword);
                    if ($request_user) {
                        sessionUser($_SESSION['idUser']);
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }else{
                        $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function putDFiscal(){
            if ($_POST) {
                if (empty($_POST['txtNit']) || empty($_POST['txtNombreFiscal']) || empty($_POST['txtDirFiscal'])) {
                    $arrResponse = array("status" => false, "msg", "Datos incorrectos.");
                }else{
                    $idUsuario = $_SESSION['idUser'];
                    $strNit = strClean($_POST['txtNit']);
                    $strNomFiscal = ucwords(strClean($_POST['txtNombreFiscal']));
                    $strDirFiscal = ucwords(strClean($_POST['txtDirFiscal']));

                    $request_user = $this->model->updateDataFiscal($idUsuario,
                                                                    $strNit,
                                                                    $strNomFiscal,
                                                                    $strDirFiscal);
                    if ($request_user) {
                        sessionUser($_SESSION['idUser']);
                        $arrResponse = array("status" => true, "msg" => 'Datos Actualizados correctamente.');
                    }else{
                        $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

    }
?>