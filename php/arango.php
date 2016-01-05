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
$connectionOptions =array(
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

// create a new collection
$collectionName = "products";
$collection = new Collection($collectionName);
$collectionHandler = new CollectionHandler($connection);
if ($collectionHandler->has($collectionName)) {
    $collectionHandler->drop($collectionName);
}
$collectionId = $collectionHandler->create($collection);

// Add new document
$documentHandler = new DocumentHandler($connection);
$document = new Document();
$document->set("now", date('Y-m-d H:i:s'));
$documentId = $documentHandler->save($collectionName, $document);

// Read them all
$documents = $collectionHandler->all($collectionId);
foreach ($documents as $document) {
    /** @var $document Document */
    echo "<h2>" . htmlspecialchars($document->getInternalId()) . '</h2>';
    echo '<pre>' . json_encode($document->getAll(), JSON_PRETTY_PRINT) . '</pre>';
}
