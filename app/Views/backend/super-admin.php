<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/hueleanuevo/css/estilo.css'); ?>" />
        <title>
			<?php echo $page_title ?>
		</title>
	</head>
	<body>
		<div class="container-1">
			<img src="<?php echo base_url('assets/hueleanuevo/img/logo.jpg'); ?>" alt="Huele a Nuevo" class="han-logo" />
		</div>
		<h3>
			<?php echo $page_title ?>
        </h3>
        <div>
			<a href='<?php echo site_url('backend/employee')?>'>Empleados</a> |
			<a href='<?php echo site_url('backend/client')?>'>Clientes</a> |
			<a href='<?php echo site_url('backend/planAssignation')?>'>Cliente - Plan</a> |
			<a href='<?php echo site_url('backend/order')?>'>Pedido</a> |
			<a href='<?php echo site_url('backend/orderDetail')?>'>Pedido Detalle</a> |
		</div>
	</body>
</html>
