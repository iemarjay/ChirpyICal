<?php
/**
 * Created by PhpStorm.
 * User: proteux
 * Date: 1/9/17
 * Time: 9:08 PM
 * Author: iemarjay <emarjay921@gmail.com>
 */

require __DIR__.'/vendor/autoload.php';

$ical = new ChirpyICal\VEvent;

var_dump($ical->setStartDate('2016/12/3 4:00'));


