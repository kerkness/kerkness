<?php 

Route::set('kerk/gui/media', 'gui/media/<type>/<file>', array('file'=>'.*?'))
	->defaults(array(
		'controller'	=> 'gui',
		'action'		=> 'media',
));