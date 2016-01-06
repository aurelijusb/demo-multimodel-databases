<?php
use triagens\ArangoDb\Collection;
use triagens\ArangoDb\CollectionHandler;
use triagens\ArangoDb\Connection;
use triagens\ArangoDb\ConnectionOptions;
use triagens\ArangoDb\Document;
use triagens\ArangoDb\DocumentHandler;
use triagens\ArangoDb\UpdatePolicy;

require 'vendor/autoload.php';

// Connect
$connectionOptions = array(
    ConnectionOptions::OPTION_ENDPOINT => 'tcp://arangodb3:8529',
    ConnectionOptions::OPTION_AUTH_TYPE => 'Basic',
    ConnectionOptions::OPTION_AUTH_USER => 'root',
    ConnectionOptions::OPTION_AUTH_PASSWD => 'rootpwd',
    ConnectionOptions::OPTION_CONNECTION => 'Close',
    ConnectionOptions::OPTION_TIMEOUT => 3,
    ConnectionOptions::OPTION_RECONNECT => true,
    ConnectionOptions::OPTION_CREATE => true,
    ConnectionOptions::OPTION_UPDATE_POLICY => UpdatePolicy::LAST,
);
$connection = new Connection($connectionOptions);

// Create a new collection
$collectionName = "Elements";
$collection = new Collection($collectionName);
$collectionHandler = new CollectionHandler($connection);
if ($collectionHandler->has($collectionName)) {
    $collectionHandler->drop($collectionName);
}
$collectionId = $collectionHandler->create($collection);

// Add new documents
$documentHandler = new DocumentHandler($connection);

$document1 = new Document();
$document1->set("now", date('Y-m-d H:i:s'));

$document2 = new Document();
$document2->set("created", ['during' => ['VilniusPHP', 'event']]);

$documentId1 = $documentHandler->save($collectionName, $document1);
$documentId2 = $documentHandler->save($collectionName, $document2);

// Read them all
$documents = $collectionHandler->all($collectionId);
foreach ($documents as $document) {
    /** @var $document Document */
    echo '<h2>'.htmlspecialchars($document->getInternalId()).'</h2>';
    echo "<div><b>Revision:</b> {$document->getRevision()}</b>";
    echo '<pre>'.json_encode($document->getAll(), JSON_PRETTY_PRINT).'</pre>';
}
