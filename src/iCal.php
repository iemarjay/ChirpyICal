<?php
/**
 * Date: 1/9/17
 * Time: 7:57 PM
 * Author: iemarjay <emarjay921@gmail.com>
 */

namespace ChirpyICal;

use BadMethodCallException;
use DateTime;
use ChirpyICal\EventOrganizer;


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
    protected $dTStartTime  = '';

    /**
     * the end date and time acceptable by DateTime class
     *
     * @var string
     */
    protected $dTEnd  = '';
    protected $dTEndTime  = '';

    /**
     * available options for status
     *
     * @var array
     */
    protected $statusOption;

    /**
     * This property defines the overall status or confirmation for the calendar component.
     *
     * @var string
     */
    protected $status = '';

    /**
     * This property provides a more complete description of the calendar component, than that provided by the "SUMMARY" property
     *
     * @var string
     */
    protected $description  = '';

    /**
     * This property specifies non-processing information intended to provide a comment to the calendar user
     *
     * @var string
     */
    protected $comment  = '';

    /**
     * This property defines the calendar scale used for the calendar information specified in the iCalendar object
     *
     * @var string
     */
    protected $calScale = "CALSCALE:GREGORIAN\r\n";

    /**
     * This property defines the iCalendar object method associated with the calendar object
     *
     * @var string
     */
    protected $method   = "METHOD:REQUEST\r\n";

    /**
     * The property defines the organizer for a calendar component
     *
     * @var string|object
     */
    protected $organizerObject;

    /**
     * This property defines the access classification for a calendar component
     *
     * @var string
     * @link http://www.kanzaki.com/docs/ical/class.html
     */
    protected $class    = '';
    protected $classOption  = ['PUBLIC', 'PRIVATE', 'CONFIDENTIAL', 'iana-token', 'x-name'];

    /**
     * @return object|string
     */
    public function getOrganizer()
    {
        return $this->organizerObject && $this->organizerObject->organizer ?
            "{$this->organizerObject->organizer}\r\n" : '';
    }

    public function setOrganizer()
    {
        $this->organizerObject  = new EventOrganizer;

        return $this->organizerObject;
    }

    /**
     * @param string $class
     * @throws \BadMethodCallException
     */
    public function setClass($class)
    {
        if (!$class || !is_string($class))
        {
            throw new BadMethodCallException('method setTransparent expects param 1 to be type of String, '. gettype($class). ' given.');
        }
        else if (in_array(strtoupper($class), $this->class))
        {
            $option = implode(', ', $this->class);
            throw new BadMethodCallException("method setTransparent expects param 1 to be $option, $class given.");
        }

        $this->class = "CLASS:$class\r\n";
    }

    /**
     * @param string $method
     * @throws \BadMethodCallException
     */
    public function setMethod($method)
    {
        if (!$method || !is_string($method))
        {
            throw new BadMethodCallException('method setMethod expects param 1 to be type of String, '. gettype($method). ' given.');
        }

        $this->method = "METHOD:$method\r\n";
    }

    /**
     * @param string $calScale
     * @throws \BadMethodCallException
     */
    public function setCalScale($calScale)
    {
        if (!$calScale || !is_string($calScale))
        {
            throw new BadMethodCallException('method setComment expects param 1 to be type of String, '. gettype($calScale). ' given.');
        }

        $this->calScale = "CALSCALE:$calScale\r\n";
    }


    /**
     * @param string $comment
     * @throws BadMethodCallException
     */
    public function setComment($comment)
    {
        if (!$comment || !is_string($comment))
        {
            throw new BadMethodCallException('method setComment expects param 1 to be type of String, '. gettype($comment). ' given.');
        }

        $this->comment = "COMMENT:$comment\r\n";
    }

    /**
     * @param string $description
     * @throws BadMethodCallException
     */
    public function setDescription($description)
    {
        if (!$description || !is_string($description))
        {
            throw new BadMethodCallException('method setDescription expects param 1 to be type of String, '. gettype($description). ' given.');
        }

        $this->description = "DESCRIPTION:$description\r\n";
    }

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
        $this->dTStartTime  = "{$dateTime->format('Ymd')}T{$dateTime->format('His')}";
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
        $this->dTEndTime= "{$dateTime->format('Ymd')}T{$dateTime->format('His')}";
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
            $option = implode(', ', $this->statusOption);
            throw new BadMethodCallException("method setStatus expects param 1 to be $option, $status given.");
        }

        $this->status = 'STATUS:'. strtoupper($status). "\r\n";

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