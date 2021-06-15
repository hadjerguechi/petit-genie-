<?php
namespace App\Entity;

class JobSearch{
 
    /**
     * @var string|null
     */
    private $missiontitle;


    /**
     * Get the value of missiontitle
     *
     * @return  string|null
     */ 
    public function getMissiontitle()
    {
        return $this->missiontitle;
    }

    /**
     * Set the value of missiontitle
     *
     * @param  string|null  $missiontitle
     *
     * @return  self
     */ 
    public function setMissiontitle(string $missiontitle)
    {
        $this->missiontitle = $missiontitle;

        return $this;
    }
}