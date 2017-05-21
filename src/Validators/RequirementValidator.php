<?php


namespace Phizzl\HeartbeatTools\Validators;


use Phizzl\HeartbeatTools\Checks\AbstractCheck;
use Phizzl\HeartbeatTools\Checks\Requirements\Requirement;

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