<?php
namespace App\Entity;

class JobSearch{
 
    /**
     * @var string|null
     */
    private $mission;


    /**
     * Get the value of mission
     *
     * @return  string|null
     */ 
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * Set the value of mission
     *
     * @param  string|null  $mission
     *
     * @return  self
     */ 
    public function setMission(string $mission)
    {
        $this->mission = $mission;

        return $this;
    }
}