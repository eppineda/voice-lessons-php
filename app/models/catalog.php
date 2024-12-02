<?php

function catalog($json) { return $json.elements; }
function courses($json) { return $json.elements[0].elements; }
function course($json, $idx) { return courses($json)[$idx]; }
function fields($json, $idx) { return course($json, $idx).elements; }
function field($json, $idx, $idx2) { return fields($json, $idx)[$idx2].elements[0].text; }
function id($json, $idx) { return course($json, $idx).elements[0].elements[0].text; }
function title($json, $idx) { return course($json, $idx).elements[1].elements[0].text; }
function description($json, $idx) { return course($json, $idx).elements[1].elements[0].text; }

?>
