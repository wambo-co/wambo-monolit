<?php

namespace Wambo\Core\Storage;

/**
 * Class JSONEndoder
 * @package Wambo\Core\Storage
 */
class JSONEndoder
{
    public function getJson(array $data)
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}