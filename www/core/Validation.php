<?php

namespace core;

class Validation
{
    public static function validate(array $validationRules): array
    {
        $errors = [];
        $data = [];
        // Check if POST data is received
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($validationRules as $field => $rules) {
                $fieldValue = $_POST[$field] ?? '';

                foreach ($rules as $rule) {
                    if ($rule == "required") {
                        if (empty($fieldValue)) {
                            $errors[$field] = "Поле {$field} пустое!";
                        }
                    }

                    if ($rule == "is_numeric") {
                        if (!is_numeric($fieldValue)) {
                            $errors[$field] = "Значение в поле {$field} неверное!";
                        }
                    }

                    if ($rule == "is_int") {
                        if (!is_int($fieldValue)) {
                            $errors[$field] = "Значение в поле {$field} неверное!";
                        }
                    }
                }

                if (empty($errors)){
                    $data[$field] = htmlspecialchars($fieldValue);
                }
            }
        }

        return ['errors' => $errors, 'data' => $data];
    }
}