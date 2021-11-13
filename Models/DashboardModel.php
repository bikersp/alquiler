<?php
	class DashboardModel extends Mysql{

		public function __construct(){
			parent::__construct();
		}

		public function cantUsuarios(){
                  $sql = "SELECT COUNT(*) as total FROM persona WHERE status !=0";
                  $request =  $this->select($sql);
                  $total = $request['total'];
                  return $total;
		}

		public function cantClientes(){
                  $sql = "SELECT COUNT(*) as total FROM persona WHERE status !=0 AND rolid=".RCLIENTES;
                  $request =  $this->select($sql);
                  $total = $request['total'];
                  return $total;
		}

		public function cantCategorias(){
                  $sql = "SELECT COUNT(*) as total FROM categoria WHERE status !=0";
                  $request =  $this->select($sql);
                  $total = $request['total'];
                  return $total;
		}

		public function cantProductos(){
                  $sql = "SELECT COUNT(*) as total FROM producto WHERE status !=0";
                  $request =  $this->select($sql);
                  $total = $request['total'];
                  return $total;
		}

		public function cantPedidos(){
                  $rolid = $_SESSION['userData']['idrol'];
                  $idUser= $_SESSION['userData']['idpersona'];
                  $where = "";

                  if ($rolid == RCLIENTES) {
                        $where = " WHERE personaid = ".$idUser;
                  }

                  $sql = "SELECT COUNT(*) as total FROM pedido ".$where;
                  $request =  $this->select($sql);
                  $total = $request['total'];
                  return $total;
		}

		public function lastOrders(){
                  $rolid = $_SESSION['userData']['idrol'];
                  $idUser= $_SESSION['userData']['idpersona'];
                  $where = "";

                  if ($rolid == RCLIENTES) {
                        $where = " WHERE p.personaid = ".$idUser;
                  }

                  $sql = "SELECT p.idpago,
							pe.nombres as usuario,
							pro.nombre,
							ca.nombre as categoria,
							ca.descripcion as piso,
							pro.precio,
							tp.tipopago,
                                          DATE_FORMAT(p.fecharegistro, '%d/%m/%Y') as fecha,
                                          MONTH(p.fechapago) as fechapago
			 		FROM pagos p
					INNER JOIN producto pro
					ON p.productoid = pro.idproducto
					INNER JOIN persona pe
					ON pe.idpersona = p.personaid
			 		INNER JOIN tipopago tp
			 		ON p.tipopagoid = tp.idtipopago
					INNER JOIN categoria ca
					ON ca.idcategoria = pro.categoriaid 
                        LIMIT 10 ";
                  $request =  $this->select_all($sql);
                  return $request;
		}

		public function selectPagosMes(int $anio, string $mes){
                  $sql = "SELECT p.tipopagoid, tp.tipopago, COUNT(p.tipopagoid) as cantidad, SUM(p.monto) as total
                        FROM pagos p
                        INNER JOIN tipopago tp
                        ON p.tipopagoid = tp.idtipopago
                        WHERE MONTH(p.fecharegistro) = $mes AND YEAR(p.fecharegistro) = $anio
                        GROUP BY tipopagoid";
                  $pagos =  $this->select_all($sql);
                  $meses = Meses();
                  $arrData = array('anio' => $anio, 'mes' => $meses[intval($mes-1)], 'tipospago' => $pagos);
                  return $arrData;
		}

		public function selectVentasMes(int $anio, string $mes){
                  $rolid = $_SESSION['userData']['idrol'];
                  $idUser= $_SESSION['userData']['idpersona'];
                  $where = "";

                  if ($rolid == RCLIENTES) {
                        $where = " AND personaid = ".$idUser;
                  }

                  $totalVentasMes = 0;
                  $arrVentasDias = array();
                  $dias = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
                  $n_dia = 1;

                  for ($i=0; $i < $dias; $i++) { 
                        $date = date_create($anio.'-'.$mes.'-'.$n_dia);
                        $fechaVenta = date_format($date, "Y-m-d");

                        $sql = "SELECT DAY(fecharegistro) AS dia, COUNT(idpago) AS cantidad, SUM(monto) AS total
                              FROM pagos 
                              WHERE DATE(fecharegistro) = '$fechaVenta' ".$where;
                        $ventaDia =  $this->select($sql);
                        $ventaDia['dia'] = $n_dia;
                        $ventaDia['total'] = $ventaDia['total'] == "" ? 0 : $ventaDia['total'];
                        $totalVentasMes += $ventaDia['total'];
                        array_push($arrVentasDias, $ventaDia);
                        $n_dia++;
                  }
                  $meses = Meses();
                  $arrData = array('anio' => $anio, 'mes' => $meses[intval($mes-1)], 'total' => $totalVentasMes, 'ventas' => $arrVentasDias);
                  return $arrData;
		}

		public function selectVentasAnio(int $anio){
                  $arrMVentas = array();
                  $arrMeses = Meses();

                  $totalVentasAnio = 0;
                  for ($i=1; $i <= 12; $i++) {
                        $arrData = array('anio' => '','no_mes' => '','mes' => '','venta' => '');

                        $sql = "SELECT $anio AS anio, $i AS mes, SUM(monto) AS venta 
                              FROM pagos
                              WHERE MONTH(fecharegistro) = $i AND YEAR(fecharegistro) = $anio 
                              GROUP BY MONTH(fecharegistro) ";
                        $ventaMes =  $this->select($sql);
                        $arrData['mes'] = $arrMeses[$i-1];
                        if(empty($ventaMes)){
                              $arrData['anio'] = $anio;
                              $arrData['no_mes'] = $i;
                              $arrData['venta'] = 0;
                        }else{
                              $arrData['anio'] = $ventaMes['anio'];
                              $arrData['no_mes'] = $ventaMes['mes'];
                              $arrData['venta'] = $ventaMes['venta'];
                        }
                        $totalVentasAnio += $ventaMes['venta'];
                        array_push($arrMVentas, $arrData);
                  }
                  $arrVentas = array('anio' => $anio, 'meses' => $arrMVentas, 'total' => $totalVentasAnio);
                  return $arrVentas;
		}

            public function productosTen(){
                  $sql = "SELECT * 
                        FROM producto
                        WHERE status = 1
                        ORDER BY idproducto DESC LIMIT 1,10";
                  $request = $this->select_all($sql);
                  return $request;
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