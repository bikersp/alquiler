<?php
  class ContactosModel extends Mysql{

    public $intIdcontacto;

    public function selectContactos(){
      $sql = "SELECT idcontacto, nombre, email, DATE_FORMAT(date, '%d/%m/%Y') as fecha, mensaje
          FROM contacto ORDER BY idcontacto DESC";
      $request = $this->select_all($sql);
      return $request;
    }

    public function selectMensaje(int $idmensaje){
      $this->intIdcontacto = $idmensaje;
      $sql = "SELECT idcontacto, nombre, email, DATE_FORMAT(date, '%d/%m/%Y') as fecha, mensaje
          FROM contacto WHERE idcontacto = $this->intIdcontacto";
      $request = $this->select($sql);
      return $request;
    }

  }
 ?>