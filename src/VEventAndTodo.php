<?php
/**
 * Created by PhpStorm.
 * User: proteux
 * Date: 1/10/17
 * Time: 10:54 AM
 * Author: iemarjay <emarjay921@gmail.com>
 */
declare(strict_types=1);

namespace ChirpyICal;

abstract class VEventAndTodo extends iCal
{
    /**
     * This property specifies information related to the global
     * position for the activity specified by a calendar component
     *
     * @link http://www.kanzaki.com/docs/ical/geo.html
     * @var string
     */
    protected $geo  = '';

    /**
     * The property specifies a positive duration of time
     *
     * @var string
     */
    protected $duration = '';

    /**
     * @param $duration
     * @param int $mm
     * @param int $ss
     * @return $this
     */
    public function setDuration($duration, int $mm = 0, int $ss = 0)
    {
        if ($duration && is_string($duration))
        {
            $duration   = strtoupper($duration);
            $duration   = validDuration($duration) ? $duration : null;
        }

        if ($duration && is_int($duration) && is_int($mm) && is_int($ss))
        {
            $duration   = "{$duration}H{$mm}M{$ss}S";
        }

        $this->duration = $duration ? "DURATION:PT{$duration}\r\n" : '';

        return $this;
    }

    /**
     * @param $geo
     * @return $this
     */
    public function setGeo($geo)
    {
//        $this->geo = $geo;

        return $this;
    }


}