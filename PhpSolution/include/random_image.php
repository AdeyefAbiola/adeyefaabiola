<?php
	$images = [
		[
			'file' => 'kinkakuji',
			'caption' => 'The Golden pavilion in Kyoto'],
		[
			'file' => 'maiko',
			'caption' => 'Maiko&#8212; trainee gesha in Kyoto'
		],
		[
			'file' => 'maiko_phone',
			'caption' => 'Monk begging for alm in Kyoto'
		],
		[
			'file' => 'fountains',
			'caption' => 'Fountains in central Kyoto'
		],
		[
			'file' => 'ryoanji',
			'caption' => 'Autumn leaves in ryoanji temple, Kyoto'
		],
		[
			'file' => 'menu',
			'caption' => 'Menu outside restaurant in Pontocho, Kyoto'
		],
		[
			'file' => 'basin',
			'caption' => 'Water basin at Ryoanji temple, Kyoto'
		],
		[
			'file' => 'angel',
			'caption' => 'You can,t but like this girl'
		],
		[
			'file' => 'ronaldo',
			'caption' => 'World greatest player alive'
		]
	];
	$numImage = count($images);
	$max = $numImage - 1;
	$i = rand(0, $max);
	//$i = rand(0, count($images)-1);
	$selectedImage = "images/{$images[$i]['file']}.jpg";
	$caption = $images[$i]['caption'];
	if(file_exists($selectedImage) && is_readable($selectedImage)){
		$imageSize = getimagesize($selectedImage);
	}
?>