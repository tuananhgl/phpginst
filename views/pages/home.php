<?php 
	
	foreach ($listMenu as $key => $menu) { ?>
		<div>
			<a href="index.php?controller=pages&page=<?= $menu->file ?>"><?= $menu->title ?></a>
		</div>		
	<?php }
