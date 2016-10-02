<?php

namespace Wambo\Core\Storage;

use Wambo\Core\Storage\Exception\RuntimeException;

/**
 * Class JSONDecoder
 * @package Wambo\Core\Storage
 */
class JSONDecoder
{
    public function getData(string $json)
    {
        $data = json_decode($json, true);
        if ($error = json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException(json_last_error_msg());
        }

        return $data;
    }
}