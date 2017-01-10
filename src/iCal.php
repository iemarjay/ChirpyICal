<?php
/**
 * Date: 1/9/17
 * Time: 7:57 PM
 * Author: iemarjay <emarjay921@gmail.com>
 */

namespace ChirpyICal;

use BadMethodCallException;
use DateTime;


abstract class iCal
{
    /**
     * the iCal generated
     *
     * @var string
     */
    protected $iCal = '';

    /**
     * the iCal generated
     *
     * @var string
     */
    protected $summary = '';

    /**
     * timezone ical uses
     *
     * @var string
     */
    private $timeZone   = 'Africa/Lagos';

    /**
     * the calender attendee
     *
     * @var array
     */
    protected $attendee     = [];

    /**
     * the start date and time as acceptable by DateTime class
     *
     * @var string
     */
    protected $dTStart  = '';

    /**
     * the end date and time acceptable by DateTime class
     *
     * @var string
     */
    protected $dTEnd  = '';

    /**
     * available options for status
     *
     * @var array
     */
    protected $statusOption = [
        'TENTATIVE'
    ];

    /**
     * event status
     *
     * @var string
     */
    protected $status = '';

    /**
     * @param string $timeZone
     * @throws BadMethodCallException
     */
    public function setTimeZone($timeZone)
    {
        if (!$timeZone || !is_string($timeZone))
        {
            throw new BadMethodCallException('method setTimeZone expects param 1 to be type of String, '. gettype($timeZone). ' given.');
        }

        $this->timeZone = $timeZone;
    }

    /**
     * sets the date the event is to start
     *
     * @param $dateTime
     * @return $this
     * @throws BadMethodCallException
     */
    public function setStartDate($dateTime)
    {
        if (!$dateTime || !is_string($dateTime))
        {
            throw new BadMethodCallException('method setStartDate expects param 1 to be type of String, '. gettype($dateTime). ' given.');
        }

        $dateTime       = new DateTime($dateTime);
        $this->dTStart  = "DTSTART:{$dateTime->format('Ymd')}T{$dateTime->format('His')}\r\n";

        return $this;
    }

    /**
     * sets the date the event ends
     *
     * @param $dateTime
     * @return $this
     * @throws BadMethodCallException
     */
    public function setEndDate($dateTime)
    {
        if (!$dateTime || !is_string($dateTime))
        {
            throw new BadMethodCallException('method setEndDate expects param 1 to be type of String, '. gettype($dateTime). ' given.');
        }

        $dateTime       = new DateTime($dateTime);
        $this->dTEnd  = "DTEND:{$dateTime->format('Ymd')}T{$dateTime->format('His')}\r\n";

        return $this;
    }

    /**
     * sets the status of the event
     *
     * @param $status
     * @return $this
     * @throws BadMethodCallException
     */
    public function setStatus($status)
    {
        if (!$status || !is_string($status))
        {
            throw new BadMethodCallException('method setStatus expects param 1 to be type of String, '. gettype($status). ' given.');
        }
        else if (in_array(strtoupper($status), $this->statusOption))
        {
            throw new BadMethodCallException("method setStatus expects param 1 to be TENTATIVE,  or , $status given.");
        }

        $this->status = strtoupper($status);

        return $this;
    }

    /**
     * @param string $summary
     * @return $this
     */
    public function setSummary($summary)
    {
        if (!$summary || !is_string($summary))
        {
            throw new BadMethodCallException('method setSummary expects param 1 to be type of String, '. gettype($summary). ' given.');
        }

        $this->summary = "SUMMARY:{$summary}\r\n";

        return $this;
    }

    /**
     * generates the iCal string
     *
     * @return mixed
     */
    abstract protected function generateICal();

    /**
     * generates the iCal string
     *
     * @return mixed
     */
    public function toString()
    {
        return $this->iCal;
    }
}