<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
<?php include('../main/inc.css.php'); ?>
<style type="text/css">
li { list-style: circle; }

hr { border-top-style: dashed; }

.gadget { padding: 25px; }
</style>
</head>

<body id="center_box" <?php if($url_target != ''){ echo 'onkeypress="window.open(\'' . $url_target . '\',\'_self\')"';} ?>>
<div class="gadget">
	<h3><?php echo $title; ?></h3>
	<hr />
	<div>
		<?php echo $message; ?>
	</div>
	<hr />
	<div class="center">
		<?php 
			if($url_target != '')
			{
				$button_text = ($button_text == '') ? 'OK' : $button_text;
				echo '<a href="' . $url_target . '" class="button">' . $button_text . '</a>';
			}
		?>
	</div>
</div>
</body>
</html>