<?php
return array(
	'enable' => config('app.debug'),
	'prefix' => 'api-docs',
	'paths' => base_path('app'),
	'output' => storage_path('swagger/docs'),
	'exclude' => null,
	'default-base-path' => null,
	'default-api-version' => '1.0.0',
	'default-swagger-version' => '2.0',
	'api-doc-template' => null,
	'suffix' => '.{format}',
	'title' => 'CEC API'
);