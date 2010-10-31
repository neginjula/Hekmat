<!DOCTYPE html>

<html lang="fa">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title;?></tilte> <!-- title will be passed to this view in variable $title -->
		<link rel="stylesheet" href="<?php echo base_url();?>style/default.css" type="text/css" media="screen" title="default css" charset="utf-8"> <?php //we use php to specify the default css address ?>
	</head>
	
	<body>
		<?php $this->load->view($mainView); //from here forward we use another view wich is passed in a variable called $mainView ?>
	</body>
</html>