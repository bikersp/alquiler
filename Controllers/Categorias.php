<?php
  class Categorias extends Controllers{

    public function __construct(){
      parent::__construct();
      session_start();
      if (empty($_SESSION['login'])) {
          header('Location: '.base_url().'/dashboard');
      }
      getPermisos(MCATEGORIAS);
    }

    public function categorias(){
      if (empty($_SESSION['permisosMod']['r'])) {
          header("Location:".base_url()."/dashboard");
      }
      $data['page_tag'] = "Cuartos - ".NOMBRE_EMPRESA;
      $data['page_title'] = "CUARTOS";
      $data['page_name'] = "Cuartos";
      $data['page_functions_js'] = "functions_categorias.js";
			$data['menu'] = "categorias";
      $this->views->getView($this,"categorias",$data);
    }

    public function setCategoria(){
      if($_SESSION['permisosMod']['w']){
        if ($_POST) {
            if (empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus'])) {
                $arrResponse = array("status" => false, "msg" => "Datos incorrectos.");
            }else{
                $intIdCategoria = intval($_POST['idCategoria']);
                $strCategoria = strClean($_POST['txtNombre']);
                $strPrecio = strClean($_POST['txtPrecio']);
                $strDescripcion = strClean($_POST['txtDescripcion']);
                $intStatus = intval($_POST['listStatus']);

                $ruta = strtolower(clear_cadena($strCategoria));
                $ruta = str_replace(" ","-", $ruta);

                $foto = $_FILES['foto'];
                $nombre_foto = $foto['name'];
                $type = $foto['type'];
                $url_temp = $foto['tmp_name'];
                $imgPortada = 'portada.png';

                if ($nombre_foto != "") {
                    $estraccion = explode("/", $type);
                    $extension = $estraccion[1];
                    $imgPortada = 'img_'.md5(date('dmY H:m:s')).'.'.$extension;
                }

                if ($intIdCategoria == 0) {
                    // Crear
                    if($_SESSION['permisosMod']['w']){
                        $request_categoria = $this->model->insertCategoria($strCategoria, $strPrecio, $strDescripcion, $imgPortada, $ruta, $intStatus);
                        $option = 1;
                    }
                }else{
                    // Actualizar
                    if($_SESSION['permisosMod']['u']){
                        if ($nombre_foto == '') {
                            if ($_POST['foto_actual'] != 'portada.png' && $_POST['foto_remove'] == 0) {
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }
                        $request_categoria = $this->model->updateCategoria($intIdCategoria, $strCategoria, $strPrecio, $strDescripcion, $imgPortada, $ruta, $intStatus);
                        $option = 2;
                    }
                }

                if ($request_categoria > 0) {
                  if ($option == 1) {
                    $arrResponse = array('status' => true, 'msg' => 'Datos Guardados correctamente.');
                    if ($nombre_foto != '') { uploadImage($foto,$imgPortada); }
                  }else{
                    $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                    if ($nombre_foto != '') { uploadImage($foto,$imgPortada); }

                    // Eliminar img al actualizar
                    if (($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada.png') || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada.png')) {
                        deleteFile($_POST['foto_actual']);
                    }

                  }
                }else if ($request_categoria == 'exist') {
                  $arrResponse = array('status' => false, 'msg' => '¡Atención! El Cuarto ya existe.');
                }else{
                  $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
      }

    }

    public function getCategorias(){
      if($_SESSION['permisosMod']['r']){
          $arrData = $this->model->selectCategoriasLibres();

          for ($i=0; $i < count($arrData); $i++) {
              $btnView = '';
              $btnEdit = '';
              $btnDelete = '';

              if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
              }else{
                $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
              }

              if ($arrData[$i]['categoriaid'] == "") {
                $arrData[$i]['categoriaid'] = '<span class="badge badge-success">Libre</span>';
              }else{
                $arrData[$i]['categoriaid'] = '<span class="badge badge-danger">Ocupado</span>';
              }

              $arrData[$i]['precio'] = SMONEY.' '.intval($arrData[$i]['precio']);

              if ($_SESSION['permisosMod']['r']) {
                  $btnView = '<button class="btn btn-info btn-sm btnViewCategoria" onClick="fntViewCategoria('.$arrData[$i]['idcategoria'].')" title="Ver Piso"><i class="far fa-eye"></i></button>';
              }
              if ($_SESSION['permisosMod']['u']) {
                  $btnEdit = '<button class="btn btn-primary btn-sm btnEditCategoria" onClick="fntEditCategoria(this,'.$arrData[$i]['idcategoria'].')" title="Editar Piso"><i class="fas fa-pencil-alt"></i></button>';                  
              }
              if ($_SESSION['permisosMod']['d']) {
                  $btnDelete = '<button class="btn btn-danger btn-sm btnDeleteCategoria" onClick="fntDeleteCategoria('.$arrData[$i]['idcategoria'].')" title="Eliminar Piso"><i class="fas fa-trash-alt"></i></button>';
              }

              $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
          }

          echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
      }else{
          header('Location: '.base_url().'/dashboard');
      }
      die();
    }

    public function getCategoria(int $idcategoria){
      if($_SESSION['permisosMod']['r']){
        $intIdcategoria = intval($idcategoria);

        if ($intIdcategoria > 0) {
          $arrData = $this->model->selectCategoria($intIdcategoria);
          if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
          }else{
            $arrData['url_portada'] = media().'/img/uploads/'.$arrData['portada'];
            $arrResponse = array('status' => true, 'msg' => $arrData);
          }
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE); 
        }
      }
      die();
    }

    public function deleteCategoria(){
      if ($_POST) {
        if($_SESSION['permisosMod']['d']){
            $intIdcategoria = intval($_POST['idCategoria']);
            $requestDelete = $this->model->deleteCategoria($intIdcategoria);
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

    public function getSelectCategoriasOld(){
      $htmlOptions = "";
      $arrData = $this->model->selectCategorias();
      if (count($arrData) > 0) {
          for ($i=0; $i < count($arrData); $i++) {
              if ($arrData[$i]['status'] == 1) {
                  $htmlOptions .='<option value="'.$arrData[$i]['idcategoria'].'">'.$arrData[$i]['nombre'].' - '.$arrData[$i]['descripcion'].'</option>';
                }

          }
      }
      echo $htmlOptions;
      die();
    }

    public function getSelectCategorias(){
      $htmlOptions = "";
      $arrData = $this->model->selectCategoriasLibres();
      if (count($arrData) > 0) {
          for ($i=0; $i < count($arrData); $i++) {
              if ($arrData[$i]['categoriaid'] == "" && $arrData[$i]['status'] == 1) {
                  $htmlOptions .='<option value="'.$arrData[$i]['idcategoria'].'">'.$arrData[$i]['nombre'].' - '.$arrData[$i]['descripcion'].' / Libre'.'</option>';
              }else{
                $htmlOptions .='<option value="'.$arrData[$i]['idcategoria'].'">'.$arrData[$i]['nombre'].' - '.$arrData[$i]['descripcion'].'</option>';
              }

          }
      }
      echo $htmlOptions;
      die();
    }

  }
?>