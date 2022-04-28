<?php
namespace App\Library\Interface;
use App\Models\NotificationLog;

interface ReadXmlInterface{

    /**
     * 
     *
     * @return NotificationLog[]
     */
    public function ReadXml();

}