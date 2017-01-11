<?php
/**
 * Created by PhpStorm.
 * User: proteux
 * Date: 1/9/17
 * Time: 9:08 PM
 * Author: iemarjay <emarjay921@gmail.com>
 */

require __DIR__.'/vendor/autoload.php';

$vevent = new ChirpyICal\VEvent;
$vtodo  = new ChirpyICal\VTodo;
$org  = new ChirpyICal\EventOrganizer;

$vevent->setStartDate('+2 Days');
$vtodo->setStartDate('+2 Days');
$vtodo->setDueDateTime('+2 Days');
$vtodo->setCompleted('+5 Days');

$vtodo->setOrganizer()->setDisplayName('today away')->setSentBy('today away');

$vevent->generateICal();
$vtodo->generateICal();


echo "<pre>";
var_dump($vevent->toString(), $vtodo->toString());


