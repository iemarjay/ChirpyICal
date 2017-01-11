<?php
namespace ChirpyICal;

use BadMethodCallException;

/**
 *
 * Date: 1/9/17
 * Time: 5:25 PM
 * Author: iemarjay <emarjay921@gmail.com>
 */
class VEvent extends VEventAndTodo
{
    /**
     * This property defines the persistent, globally unique identifier for the calendar component.
     *
     * @var null
     */
    private $uid  = null;

    /**
     * This property defines the overall status or confirmation for the calendar component
     *
     * @var array
     */
    protected $statusOption = [
        'TENTATIVE', 'CONFIRMED', 'CANCELLED'
    ];

    /**
     * This property defines whether an event is transparent or not to busy time searches
     *
     * @var string
     */
    protected $transparent  = '';

    protected $transparentOptions   = ['TRANSPARENT', 'OPAQUE'];

    /**
     * @param $transparent
     * @return $this
     * @throws BadMethodCallException
     */
    public function setTransparent($transparent)
    {
        if (!$transparent || !is_string($transparent))
        {
            throw new BadMethodCallException('method setTransparent expects param 1 to be type of String, '. gettype($transparent). ' given.');
        }
        else if (in_array(strtoupper($transparent), $this->transparentOptions))
        {
            $option = implode(', ', $this->transparentOptions);
            throw new BadMethodCallException("method setTransparent expects param 1 to be $option, $transparent given.");
        }

        $transparent    = strtoupper($transparent);

        $this->transparent = "TRANSP:{$transparent}";

        return $this;
    }


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

        $iCal   .= $this->method;
        $iCal   .= $this->calScale;

        $iCal   .= "BEGIN:VEVENT\r\n";

        $iCal   .= $this->class;
        $iCal   .= $this->getOrganizer();
        $iCal   .= $this->summary;
        $iCal   .= $this->description;
        $iCal   .= $this->duration;
        $iCal   .= $this->dTStart;
        $iCal   .= $this->dTEnd;
        $iCal   .= $this->transparent;
        $iCal   .= $this->comment;

        $iCal   .= "END:VEVENT\r\n";
        $iCal   .= "END:VCALENDAR\r\n";

        $this->iCal = $iCal;
    }
}