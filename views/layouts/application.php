<DOCTYPE html>
<html>
   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title></title>
  </head>
  <body>
  	<?php 
	  	if(isset($id)) {
	  		echo $page->title;
	  	}elseif(isset($idList)) {
	  		echo $page->title;
	  	} else {
	  		echo $menuPage->file;
	  	}
  	?>
    <?= @$content ?>
  </body>
</html>