<?php
namespace ChirpyICal;


/**
 *
 * Date: 1/9/17
 * Time: 5:25 PM
 * Author: iemarjay <emarjay921@gmail.com>
 */
class VEvent extends iCal
{
    /**
     * This property defines the persistent, globally unique identifier for the calendar component.
     *
     * @var null
     */
    private $uid  = null;

    /**
     * @param null $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return null
     */
    public function getUid()
    {
        return $this->uid;
    }

    public function generateICal()
    {
        $iCal    = "BEGIN:VCALENDAR\r\n";
        $iCal   .= "VERSION:2.0\r\n";
        $iCal   .= "PRODID:-//ChambersLegal//EmailClient//EN\r\n";
        $iCal   .= "METHOD:REQUEST\r\n";
        $iCal   .= "BEGIN:VEVENT\r\n";

        $iCal   .= $this->summary;

        $iCal   .= "END:VEVENT\r\n";
        $iCal   .= "END:VCALENDAR\r\n";

        $this->iCal = $iCal;
    }
}