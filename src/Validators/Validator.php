<?php

namespace App\Validators;

use App\Exceptions\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 *
 */
abstract class Validator
{
    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @param  ValidatorInterface  $validator
     */
    public function __construct(protected ValidatorInterface $validator)
    {
        $request = Request::createFromGlobals();
        $this->data = $request->getContent() ? $request->toArray() : $request->query->all();

        if ($this->autoValidateRequest()) {
            try {
                $this->validate();
            }

            // ?? @todo: to hardcoded: make a separate Response class to avoid duplication
            catch (ValidationException $e) {
                $response = new JsonResponse($e->getErrors(), 422);
                $response->send();
                exit;
            }
        }
    }

    /**
     * @return void
     * @throws ValidationException
     */
    public function validate(): void
    {
        $this->validateData($this->data);
    }

    /**
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        if (!array_key_exists($key, $this->data) ) {
            return $default;
        }
        return $this->data[$key];
    }

    /**
     * @param  array  $data
     *
     * @return void
     * @throws ValidationException
     */
    public function validateData(array $data): void
    {
        $errors = [];
        foreach($this->constraints() as $field => $asserts) {
            $errorMessages = $this->validator->validate(array_key_exists($field, $data) ? $data[$field] : null, $asserts);
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
     * @return bool
     */
    protected function autoValidateRequest(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function constraints(): array
    {
        return [];
    }

}