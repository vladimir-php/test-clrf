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
     * @return $this
     */
    public function addError(string $field, string $message): self
    {
        if (!array_key_exists($field, $this->errors) ) {
            $this->errors[$field] = [];
        }
        $this->errors[$field][] = $message;
        return $this;
    }

    /**
     * @param  string  $field
     * @param  array   $messages
     *
     * @return $this
     */
    public function addErrors(string $field, array $messages): self
    {
        $this->errors[$field] = $messages;
        return $this;
    }

}
