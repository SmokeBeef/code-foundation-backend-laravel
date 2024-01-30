<?php

namespace App\Http\Operation;

class BaseOperation
{
    private ?array $result;
    private string $message;
    private int $code;
    private bool $isSuccess = false;
    private ?array $errors = null;

    // Setter
    public function setResult(mixed $result): self
    {
        $this->result = $result;
        return $this;
    }

    public function setErrors(array $errors): self
    {
        $this->errors = $errors;
        return $this;
    }

    public function setIsSuccess(bool $success): self
    {
        $this->isSuccess = $success;
        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }
    public function setCode(int $code): self
    {
        $this->code = $code;
        return $this;
    }

    // Getter
    public function getResult(): mixed
    {
        return $this->result;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
    public function getCode(): int
    {
        return $this->code;
    }

    // Other Logic
    public function filterDataByGroup(array $data)
    {
        $filteredData = array();

        foreach ($data as $key => $value) {
            $keyParts = explode('_', $key);
            $group = $keyParts[0];

            if (count($keyParts) > 1) {
                $filteredData[$group][$key] = $value;
            } else {
                $filteredData[$group] = $value;
            }
        }

        return $filteredData;
    }

}