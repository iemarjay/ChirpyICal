<?php
/**
 * Created by PhpStorm.
 * User: proteux
 * Date: 1/10/17
 * Time: 10:40 AM
 * Author: iemarjay <emarjay921@gmail.com>
 */

namespace ChirpyICal;

use DateTime;
use BadMethodCallException;


class VTodo extends VEventAndTodo
{
    /**
     * This property defines the overall status or confirmation for the calendar component
     *
     * @var array
     */
    protected $statusOption = [
        'NEEDS-ACTION', 'COMPLETED', 'IN-PROCESS', 'CANCELLED'
    ];

    /**
     * This property defines the date and time that a to-do is expected to be completed
     *
     * @link http://www.kanzaki.com/docs/ical/due.html
     * @var string
     */
    protected $due  = '';
    protected $dueTime  = '';

    /**
     * This property defines the date and time that a to-do was actually completed
     *
     * @link http://www.kanzaki.com/docs/ical/completed.html
     * @var string
     */
    protected $completed    = '';

    /**
     * This property is used by an assignee or delegatee of a to-do to convey the percent completion of a to-do to the Organizer
     *
     * @var string
     * @link http://www.kanzaki.com/docs/ical/percentComplete.html
     */
    protected $percentComplete  = '';

    /**
     * @param int $percentComplete
     * @throws \BadMethodCallException
     */
    public function setPercentComplete(int $percentComplete)
    {
        if (!is_int($percentComplete) && 0 > $percentComplete && 100 < $percentComplete)
        {
            throw new BadMethodCallException('method setPercentComplete expects param 1 to be a positive integer between zero and one hundred, '. $percentComplete. ' given.');
        }

        $this->percentComplete = "PERCENT-COMPLETE:$percentComplete\r\n";
    }

    /**
     * @param $completed
     * @return $this
     * @throws BadMethodCallException
     */
    public function setCompleted($completed)
    {
        if($completed && !is_string($completed))
        {
            throw new BadMethodCallException('method setCompleted expects param 1 to be type of String, '. gettype($completed). ' given.');
        }

        $completed      = iCalTimeFormat($completed);
        $this->completed= "COMPLETED:{$completed}\r\n";

        return $this;
    }

    /**
     * @param $due
     * @throws BadMethodCallException
     * @return $this
     */
    public function setDueDateTime($due)
    {
        if($due && !is_string($due))
        {
            throw new BadMethodCallException('method setStartDate expects param 1 to be type of String, '. gettype($due). ' given.');
        }

        $due    = new DateTime($due);

        if($due && $this->dTStartTime && new DateTime($this->dTStartTime) > $due)
        {
            throw new BadMethodCallException('method setDueDateTime expects param 1 to be greater than or equal to todo start time');
        }

        $this->dueTime  = iCalTimeFormat($due);
        $this->due      = "DUE:{$due->format('Ymd')}T{$due->format('His')}\r\n";

        return $this;
    }


    public function generateICal()
    {
        $iCal    = "BEGIN:VCALENDAR\r\n";
        $iCal   .= "VERSION:2.0\r\n";
        $iCal   .= "PRODID:-//ChambersLegal//EmailClient//EN\r\n";

        $iCal   .= $this->method;
        $iCal   .= $this->calScale;

        $iCal   .= "BEGIN:VTODO\r\n";

        $iCal   .= $this->class;
        $iCal   .= $this->getOrganizer();
        $iCal   .= $this->summary;
        $iCal   .= $this->description;
        $iCal   .= $this->duration;
        $iCal   .= $this->dTStart;
        $iCal   .= $this->dTEnd;
        $iCal   .= $this->due;
        $iCal   .= $this->completed;
        $iCal   .= $this->comment;
        $iCal   .= $this->percentComplete;

        $iCal   .= "END:VTODO\r\n";
        $iCal   .= "END:VCALENDAR\r\n";

        $this->iCal = $iCal;
    }

}