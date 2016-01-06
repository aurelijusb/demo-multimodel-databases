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

echo "<h2>Other examples</h2>";

if (file_exists("vendor/triagens/arangodb/autoload.php")) {
   echo <<<HTML
    <ol>
        <li><a href="arango.php">ArangoDB simple example</a></li>
        <li><a href="orient.php">OrientDB simple example</a></li>
    </ol>
HTML;
} else {
    echo "<div style='background: #FFDDDD'>Examples not ready. Use Composer to install them. README.md for details</div>";
}

