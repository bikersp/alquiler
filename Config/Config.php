<?php
	// define("BASE_URL", "http://localhost/mvc/");

	// Ruta de Proyecto
	// const BASE_URL = "https://www.alquiler.jgodrive.com";
	const BASE_URL = "http://localhost/alquiler";
	// const BASE_URL = "http://192.168.0.139/alquiler";

	// Zona Horaria
	date_default_timezone_set('America/Lima');
	setlocale(LC_TIME, "spanish");

	// Datos de conexion a BD Nube
	// const DB_HOST = "localhost";
	// const DB_NAME = "jgodrive_alquiler_cuartos";
	// const DB_USER = "jgodrive_alquiler";
	// const DB_PASSWORD = "Alquiler2021";
	// const DB_CHARSET = "utf8";

	// Datos de conexion a BD Local
	const DB_HOST = "localhost";
	const DB_NAME = "alquiler";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";

	// Delimitadores decimal y millar ej. 24,1929.00
	const SPD = ".";
	const SPM = ",";

	// Simbolode moneda
	const SMONEY = "S/.";
	const CURRENCY = "USD";

	// ID Paypal Live
	// const IDCLIENTE = "ARA0RdvPC8TyUEaXjAkK1YDU58vm7I0oaJC7wcHTBSOwt9D6h1cAh1OBTH-1k4Tugdrk9aKcjdfHsldH";
	// const URLPAYPAL = "https://api-m.paypal.com";
	// const SECRET = "EG_coGCWsn-ekeOhVnwzrQ-33uWCFTUFUZWqW1_t1ukTwuYRDoddqYjFumPouWseb_GwplRZmuy8KYb4";
	// ID Paypal Sandbox
	 const IDCLIENTE = "Aab2ARV-epCU--iWjZUkHkwnRetqcJz3_d_W3NxTYE4P8wW4RX-OHodGVL8lP3NGC4xVkQ281-fpjESR";
	 const URLPAYPAL = "https://api-m.sandbox.paypal.com";
	 const SECRET = "EMC1e3aG3TX-NfyqoQAeEFWCeG9PH3MxSFEBkh-7XfnTjOrsMgRXCyppBh-LkElBB-ICQUXvFU2fQ8pK";

	// Datos de Correo
	const NOMBRE_REMITENTE = "Alquiler";
	const EMAIL_REMITENTE = "no-reply@tienda.com";
	const NOMBRE_EMPRESA = "Alquiler";
	const WEB_EMPRESA = "www.alquiler.jgodrive.com";

	const DESCRIPCION = "La mejor tienda en línea con artículos de moda.";
	const SHAREDHASH = "TiendaVirtual";

	// Datos Empresa
	const DIRECCION = "Avenida las Americas zona 13, Lima";
	const TELEFONO_EMPRESA = "923423423";
	const WHATSAPP = "+50278787845";
	const EMAIL_EMPRESA = "info@gmail.com";
	const EMAIL_PEDIDOS = "info@gmail.com";
	const EMAIL_SUSCRIPCION = "info@gmail.com";
	const EMAIL_CONTACTO = "info@gmail.com";

	// Redes Sociales
	const FACEBOOK = "https://www.facebook.com/";
	const INSTAGRAM = "https://www.instagram.com/";

	// Categorias
	const CATEGORIA_SLIDER = "1,2,3";
	const CATEGORIA_BANNER = "3,2,1";
	const CAT_FOOTER = "1,2,3,4,5";

	// Datos para Encriptar
	const KEY = "bikersprop";
	const METHODENCRIPT = "AES-128-ECB";

	//Envío
	const COSTOENVIO = 0;
	const CAJA = 50;

	//Modulos
	const MDASHBOARD = 1;
	const MUSUARIOS = 2;
	const MCLIENTES = 3;
	const MPRODUCTOS = 4;
	const MPEDIDOS = 5;
	const MCATEGORIAS = 6;
	const MSUSCRIPTORES = 7;
	const MCONTACTOS = 8;
	const MGASTOS = 9;

	//Roles
	const RADMINISTRADOR = 1;
	const RCLIENTES = 7;

	//Estados
	const STATUS = array('Completo', 'Aprobado', 'Cancelado', 'Reembolsado', 'Pendiente', 'Entregado');

	//Paginacion
	const CANTPORDHOME = 8;
	const PROPORPAGINA = 4;
	const PROCATEGORIA = 4;
	const PROBUSCAR = 4;
?>