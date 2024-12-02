<?php

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
require '../app/models/catalog.php';

$logger = new Logger(__FILE__);
$logger->pushHandler(new StreamHandler('php://stdout', Level::Debug));
$logger->pushHandler(new StreamHandler('/error.log', Level::Error));
$logger->pushHandler(new StreamHandler('/critical.log', Level::Critical));

function Xml2Json($fileContents) {
	global $logger;

	$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
        $fileContents = trim(str_replace('"', "'", $fileContents));
	$simpleXml = simplexml_load_string($fileContents); //logger->debug($simpleXml);
	$json = json_encode($simpleXml); //logger->debug($json);
	return $json;
}

function all() {
	global $logger;

	define('REQUEST', 'data/raw.xml');

	$xml = file_get_contents(REQUEST); $logger->debug($xml);
	$json = Xml2Json($xml); $logger->debug($json);
	define('DECODED', json_decode($json, true));
	define('COURSES', courses(DECODED));
	define('FIRST', course(DECODED, 0));

	$content = '';
// header
	$logger->debug('header start');	
	$fieldNames = [];
	$content .= '<tr bgcolor="#9acd32">';
	foreach (FIRST.elements as $f) {
		define('FIELDNAME', $f.name);

		$fieldNames[] = FIELDNAME;
		$content .= "<th style=\"text-align: left\">\${ FIELDNAME }</th>";
	}
	$content .= '</tr>';
	$logger->debug('header end');	

// data
	$logger->debug('data start');	
	$idx = 0;
	foreach (COURSES as $c) {
		$content .= '<tr>';
		$idx2 = 0;
		foreach ($fieldNames as $f) {
			define('FIELD_DATA', field($json, $idx++, $idx2++));

			$content .= "<td>\${ FIELD_DATA }</td>";
		}
		$content .= '</tr>';
	}
	$logger->debug('data end');	
	
	$logger->debug($content);
	return $content;
}

?>
