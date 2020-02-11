<?php

namespace App\Api\Validations;


class StuffValidation extends Validation
{
    /**
     * @param array $data
     */
    public function validateOnCreate(array $data): void
    {
        $this->isNotNull($data['first_name'], 'first_name');
        $this->isRegExp('/^[a-zA-Z\s]{5,50}$/', $data['first_name'], 'first_name');
        $this->isNotNull($data['last_name'], 'last_name');
        $this->isRegExp('/^[a-zA-Z\s]{5,50}$/', $data['last_name'], 'last_name');
        $this->isNotNull($data['email'], 'email');
        $this->isEmail($data['email']);
        $this->isNotNull($data['password'], 'password');
    }
}
