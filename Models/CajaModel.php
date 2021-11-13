<?php
	class CajaModel extends Mysql{

		public $strPrecio;
		public $strDescripcion;

		public $intIdGasto;
		public $strNombre;
		public $strFecha;

		public function __construct(){
			parent::__construct();
		}

		public function selectPagosMes(int $anio, string $mes){
		$sql = "SELECT MONTH(fecharegistro) as mes, COUNT(tipopagoid) as cantidad, SUM(monto) as total
					FROM pagos
					WHERE MONTH(fecharegistro) = $mes AND YEAR(fecharegistro) = $anio";
		$pagos =  $this->select($sql);
		return $pagos;
		}

		public function selectGastosMes(int $anio, string $mes){
		$sql = "SELECT MONTH(fecharegistro) as mes, COUNT(idgasto) as cantidad, SUM(monto) as total
					FROM gastos
					WHERE MONTH(fecharegistro) = $mes AND YEAR(fecharegistro) = $anio AND servicioid < 2";
		$pagos =  $this->select($sql);
		return $pagos;
		}

		public function selectOtros(int $anio, string $mes){
		$sql = "SELECT COUNT(nombre) as cantidad, SUM(monto) as total
					FROM gastos
					WHERE MONTH(fecharegistro) = $mes AND YEAR(fecharegistro) = $anio AND servicioid = 4";
		$pagos =  $this->select($sql);
		return $pagos;
		}

		public function selectCajaMes(int $anio, string $mes){
		$sql = "SELECT COUNT(nombre) as cantidad, SUM(monto) as total
					FROM gastos
					WHERE MONTH(fecharegistro) = $mes AND YEAR(fecharegistro) = $anio AND servicioid = 3";
		$pagos =  $this->select($sql);
		return $pagos;
		}

		public function selectCaja(){
		$sql = "SELECT COUNT(nombre) as cantidad, SUM(monto) as total
					FROM gastos
					WHERE servicioid = 3";
		$pagos =  $this->select($sql);
		return $pagos;
		}

		public function selectOtro(){
		$sql = "SELECT COUNT(nombre) as cantidad, SUM(monto) as total
					FROM gastos
					WHERE servicioid = 4";
		$pagos =  $this->select($sql);
		return $pagos;
		}

	}
?>