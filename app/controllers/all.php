<?php

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger(__FILE__);
$logger->pushHandler(new StreamHandler('php://stdout', Level::Debug));
$logger->pushHandler(new StreamHandler('php://stdout', Level::Error));
$logger->pushHandler(new StreamHandler('php://stdout', Level::Critical));

function all() {
	global $logger;
	$content = '';

	define('REQUEST', 'data/raw.xml');
	define('S', file_get_contents(REQUEST)); $logger->debug(S);
	define('CATALOG', new SimpleXMLElement(S));
// data
	$logger->debug('data start');

	foreach (CATALOG->course as $c) {
		$content .= '<tr>';

// id
		$id = $c->id;
		$content .= '<td>'.$id.'</td>';

// title
		$title = $c->title;
		$content .= '<td>'.$title.'</td>';

// description
		$description = $c->description;
		$content .= '<td>'.$description.'</td>';

		$content .= '</tr>'; $logger->debug($content);
	}

	$logger->debug('data end');	
	$logger->debug($content);
	return $content;
}

?>
