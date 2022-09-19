<?php

return [
	'validResponse'      => [
		'success'        =>true,
		'statusCode'     =>200,
	],

	'inValidResponse'    => [
		'success'        =>false,
		'statusCode'     =>400,
	],

	'invalidToken'       => [
        'success'        => false,
        'statusCode'     => 401,
        'message'        => 'Unauthorized',
    ],



];