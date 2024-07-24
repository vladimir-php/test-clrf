<?php

namespace App\Validators;

use App\Exceptions\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

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
                $this->validate($this->data);
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
        $errors = $this->validator->validate($data, new Assert\Collection($this->constraints()));
        if (!count($errors) > 0) {
            return;
        }

        $exception = new ValidationException();
        foreach ($errors as $message) {
            $exception->addError(
                $message->getPropertyPath(),
                $message->getMessage(),
            );
        }
        throw $exception;
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