<?php

namespace App\Service;

class BaseService
{
    protected function hasFields(array $data, array $mandatoryFields): array
    {
        $undefinedFields = [];
        foreach ($mandatoryFields as $field) {
            if (!isset($data[$field])) {
                $undefinedFields[] = $field;
            }
        }
        return $undefinedFields;
    }
}