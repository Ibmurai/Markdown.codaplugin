#!/usr/bin/php
<?php

$descriptor = array(
	array('pipe', 'r'),
	array('pipe', 'w'),
	array('pipe', 'a'),
);

$pipes = array();
$markdown = proc_open('perl Markdown.pl', $descriptor, $pipes, dirname(__FILE__));

fwrite($pipes[0], file_get_contents('php://stdin'));
fclose($pipes[0]);

echo stream_get_contents($pipes[1]);
fclose($pipes[1]);
fclose($pipes[2]);

proc_close($markdown);

