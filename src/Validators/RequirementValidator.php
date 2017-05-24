<?php


namespace Phizzl\UptimeTools\Validators;


use Phizzl\UptimeTools\Checks\AbstractCheck;
use Phizzl\UptimeTools\Checks\Requirements\Requirement;

class RequirementValidator implements TypeValidatorInterface
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value){
        $return = false;

        if($value instanceof AbstractCheck){
            $return = $this->validateCheck($value);
        }

        return $return;
    }

    /**
     * @param AbstractCheck $check
     * @return bool
     * @throws \Exception
     */
    private function validateCheck(AbstractCheck $check){
        $requirements = $check->getRequirements()->all();
        $options = $check->getOptions();

        /* @var Requirement $requirement */
        foreach($requirements as $requirement){
            if(!$requirement->requirementsMet($options)){
                throw new \Exception("Unmet requirement");
            }
        }

        return true;
    }
}