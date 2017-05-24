<?php


namespace Phizzl\UptimeTools\Checks;


use Phizzl\UptimeTools\Checks\Requirements\RequirementBag;
use Phizzl\UptimeTools\Options\Options;
use Phizzl\UptimeTools\Options\OptionsInterface;

abstract class AbstractCheck implements CheckInterface
{
    /**
     * @var RequirementBag
     */
    protected $requirements;

    /**
     * @var Options
     */
    protected $options;

    public function __construct(){
        $this->options = new Options();
        $this->requirements = new RequirementBag();
    }

    /**
     * @param Options $options
     */
    public function setOptions(OptionsInterface $options){
        $this->options = $options;
    }

    /**
     * @return RequirementBag
     */
    public function getRequirements(){
        return $this->requirements;
    }

    /**
     * @return Options
     */
    public function getOptions(){
        return $this->options;
    }


    abstract public function run();
}