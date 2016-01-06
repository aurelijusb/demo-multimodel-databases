<?php

use PhpOrient\PhpOrient;
use PhpOrient\Protocols\Binary\Data\ID;
use PhpOrient\Protocols\Binary\Data\Record;

require 'vendor/autoload.php';

$client = new PhpOrient('orientdb3', 2424);
$client->connect('root', 'rootpwd');

if ($client->dbExists('demo')) {
    $client->dbDrop('demo');
}
$client->dbCreate('demo');
$client->dbOpen('demo');

// Create a new collection
$clusterId = $client->command('create class Elements extends V');

// Add new documents
$document1 = new Record();
$document1->setOData(['now' => date('Y-m-d H:i:s')]);
$document1->setRid(new ID($clusterId));
$document2 = new Record();
$document2->setOData(["created" => ['during' => ['VilniusPHP', 'event']]]);
$document2->setRid(new ID($clusterId));

$record1 = $client->recordCreate($document1);
$record2 = $client->recordCreate($document2);

// Read them all
$documents = $client->query('select from Elements');
foreach ($documents as $document) {
    /** @var $document Record */
    echo '<h2>' . $document->getRid() . '</h2>';
    echo "<div><b>Class:</b> {$document->getOClass()}</b>";
    echo "<div><b>Revision:</b> {$document->getVersion()}</b>";
    echo '<pre>'.json_encode($document->getOData(), JSON_PRETTY_PRINT).'</pre>';
}
