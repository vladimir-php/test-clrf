<?php

namespace App\Exceptions;


/**
 *
 */
class ValidationException extends Exception
{

    /**
     * @param  array  $errors
     */
    public function __construct(
        protected array $errors = []
    ) {
        parent::__construct('Validation error.');
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param  string  $field
     * @param  string  $message
     *
     * @return void
     */
    public function addError(string $field, string $message): self
    {
        $this->errors[] = [
            'field' => $field,
            'message' => $message,
        ];
        return $this;
    }

}
