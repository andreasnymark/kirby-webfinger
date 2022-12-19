<?php

Kirby::plugin( 'andreasnymark/kirby-webfinger', [
	'routes' => [
		require_once __DIR__ . '/webfinger.php',
	],
]);
