<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class ListUserValidator.
 *
 * @package namespace App\Validators;
 */
class ListUserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => ['name' => 'required', 'email' => 'required'],
        ValidatorInterface::RULE_UPDATE => ['name' => 'required', 'email' => 'required'],
    ];
}
