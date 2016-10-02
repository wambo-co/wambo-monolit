<?php

namespace Wambo\Core\Storage;


interface StorageInterface
{
    public function read() : array;

    public function write(array $data);
}