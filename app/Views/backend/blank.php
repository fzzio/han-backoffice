<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php foreach($css_files as $file): ?>
			<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
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
		<div class="app">
			<?php echo $output; ?>
		</div>
		<?php foreach($js_files as $file): ?>
			<script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>
	</body>
</html>
