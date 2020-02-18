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
        $this->isNotNull($data['role'], 'role');
        $this->isRegExp('/^\d*$/', $data['role'], 'role');
    }

    /**
     * @param array $data
     */
    public function validationOnLogin(array $data): void
    {
        $this->isNotNull($data['email'], 'email');
        $this->isEmail($data['email']);
        $this->isNotNull($data['password'], 'password');
    }
}
