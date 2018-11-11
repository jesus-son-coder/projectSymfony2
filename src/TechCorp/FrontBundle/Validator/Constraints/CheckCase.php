<?php
/**
 * Created by PhpStorm.
 * User: rvck2
 * Date: 28/10/2018
 * Time: 01:12
 */

namespace TechCorp\FrontBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CheckCase extends Constraint
{
    public $message = 'La chaîne "%value%" ne respecte pas la casse "%casse%".';

    public $validCase = 'lowercase';
}