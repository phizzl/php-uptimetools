<?php


namespace Phizzl\HeartbeatTools\Checks\Requirements;


class RequirementBag
{
    /**
     * @var array
     */
    private $requirements;

    public function __construct(){
        $this->requirements = [];
    }

    /**
     * @param Requirement $requirement
     */
    public function addRequirement(Requirement $requirement){
        $this->requirements[] = $requirement;
    }

    /**
     * @return array
     */
    public function all(){
        return $this->requirements;
    }
}