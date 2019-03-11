<?php
require_once 'resolve.php';
/*
 * create a language translator
 */
$translator= new \Mido\Dictionary\Translator();
/*
 * create a new page renderer
 */
$render= new \Mido\Design\Render\Render();
$render->switchView();