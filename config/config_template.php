<?php
// dictum配置文件
$dictumConfig = [
	// 数据库配置
	'mysql' => [
		'host' => '{DB_HOST}',
		'port' => {DB_PORT},
		'user' => '{DB_USER}',
		'pass' => '{DB_PASS}',
		'name' => '{DB_NAME}',
        'prefix' => '{DB_PREFIX}',
	],
	// 站点名称（显示在标题和网页上）
	'sitename'           => '{SITENAME}',
	// 站点介绍（显示在网页上）
	'description'        => '{DESCRIPTION}',
];

function mysqlInfo($key,$dictumConfig)
{
    return $dictumConfig['mysql'][$key];
}

?>