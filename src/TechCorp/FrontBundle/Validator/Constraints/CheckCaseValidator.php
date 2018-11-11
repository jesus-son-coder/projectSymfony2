<?php
/**
 * Created by PhpStorm.
 * User: rvck2
 * Date: 28/10/2018
 * Time: 01:34
 */

namespace TechCorp\FrontBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CheckCaseValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $caseErrorParameters = array(
            '%value%' => $value,
            '%case%' => $constraint->validCase
        );
        if($constraint->validCase === 'lowercase') {
            if(!ctype_lower($value)){
                $this->context->addViolation($constraint->message, $caseErrorParameters);
            }
        }
        else if($constraint->validCase === 'uppercase') {
            if(!ctype_upper($value)){
                $this->context->addViolation($constraint->message, $caseErrorParameters);
            }
        }
        else {
            $errorMessage = "La contrainte de validation %s ne supporte pas la casse %s.";
            $errorReplaced = sprintf($errorMessage, get_class($constraint),
                                                    $constraint->validCase
                            );
            throw new \LogicException ($errorReplaced);
        }
    }
}