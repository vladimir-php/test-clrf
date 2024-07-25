<?php

namespace App\Validators;

use App\Exceptions\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 *
 */
abstract class Validator
{

    /**
     * @param  ValidatorInterface  $validator
     */
    public function __construct(protected ValidatorInterface $validator)
    {
    }

    /**
     * @param  Request  $request
     *
     * @return ValidationData
     * @throws ValidationException
     */
    public function validate(Request $request): ValidationData
    {
        // Creating a validation data
        $validationData = new ValidationData(
            $request->getContent() ? $request->toArray() : $request->query->all()
        );

        // Validate
        $this->validateData($validationData);

        return $validationData;
    }

    /**
     * @param  ValidationData  $validationData
     *
     * @return void
     * @throws ValidationException
     */
    public function validateData(ValidationData $validationData): void
    {
        $errors = [];
        foreach($this->constraints() as $field => $asserts) {
            $errorMessages = $this->validator->validate($validationData->get($field), $asserts);
            if (!count($errorMessages) ) {
                continue;
            }

            $errors[$field] = [];
            foreach($errorMessages as $errorMessage) {
                $errors[$field][] = $errorMessage->getMessage();
            }
        }
        if (!count($errors) > 0) {
            return;
        }

        throw new ValidationException($errors);
    }

    /**
     * @return array
     */
    protected function constraints(): array
    {
        return [];
    }

}