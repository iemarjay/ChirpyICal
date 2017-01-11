<?php
/**
 * Created by PhpStorm.
 * User: proteux
 * Date: 1/10/17
 * Time: 5:40 PM
 * Author: iemarjay <emarjay921@gmail.com>
 */

namespace ChirpyICal;

use BadMethodCallException;

class EventOrganizer
{
    public $organizer   = '';

    public function setDisplayName($displayName)
    {
        if($displayName && propExists('CN', $this->organizer))
        {
            throw new BadMethodCallException('property CAN NOT occur more than once');
        }

        $this->organizer    .= $this->organizer ? ";CN=$displayName" : "ORGANIZER;CN=$displayName";

        return $this;
    }

    public function setSentBy($sentBY)
    {
        if($sentBY && propExists('SENT-BY', $this->organizer))
        {
            throw new BadMethodCallException('property CAN NOT occur more than once');
        }

        $this->organizer    .= $this->organizer ? ";SENT-BY=$sentBY" : "ORGANIZER;SENT-BY=$sentBY";

        return $this;
    }

    public function setLanguage($language)
    {
        if($language && propExists('LANGUAGE', $this->organizer))
        {
            throw new BadMethodCallException('property CAN NOT occur more than once');
        }

        $this->organizer    .= $this->organizer ? ";LANGUAGE=$language" : "ORGANIZER;LANGUAGE=$language";

        return $this;
    }

    public function setDir($dir)
    {
        if($dir && propExists('DIR', $this->organizer))
        {
            throw new BadMethodCallException('property CAN NOT occur more than once');
        }

        $this->organizer    .= $this->organizer ? ";DIR=$dir" : "ORGANIZER;DIR=$dir";

        return $this;
    }

    public function toString()
    {
        return $this->organizer;
    }
}