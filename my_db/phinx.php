<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'develop' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'test',
            'user' => 'intern',
            'pass' => 'password',
            'port' => '3306',
	    'charset' => 'utf8',
	    'collation' => 'utf8mb4_general_ci'
        ],
    ],
];
