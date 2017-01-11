<?php
/**
 * Created by PhpStorm.
 * User: proteux
 * Date: 1/10/17
 * Time: 10:42 AM
 * Author: iemarjay <emarjay921@gmail.com>
 */

namespace ChirpyICal;


class VJournal extends iCal
{

    /**
     * This property defines the overall status or confirmation for the calendar component
     *
     * @var array
     */
    protected $statusOption = [
        'DRAFT', 'FINAL', 'CANCELLED'
    ];


}