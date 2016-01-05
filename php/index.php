<?php
echo "<h1>My neighbors</h1>";

$hosts = [
	'orientdb1:2480',
	'orientdb2:2480',
	'orientdb3:2480',
	'arangodb1:8529',
	'arangodb2:8529',
	'arangodb3:8529',
];
foreach($hosts as $host) {
	
	echo "<h2>$host</h2>";
	echo '<pre>' . implode("\n", get_headers('http://' . $host)) . '</pre>';
}

