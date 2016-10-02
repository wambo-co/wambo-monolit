<?php

namespace Wambo\Core\Module;

use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;
use Wambo\Core\Storage\JSONDecoder;
use Wambo\Core\Storage\JSONEndoder;
use Wambo\Core\Storage\StorageInterface;

class JSONModuleStorage implements StorageInterface
{
    private $filesystem;

    private $filename;

    public function __construct(Filesystem $filesystem, string $filename)
    {
        $this->filesystem = $filesystem;
        $this->filename = $filename;
    }

    public function read() : array
    {
        try {
            $json = $this->filesystem->read($this->filename);
        } catch (FileNotFoundException $e)
        {
            $json = "{}";
        }

        $jsonDecoder = new JSONDecoder();
        $data = $jsonDecoder->getData($json);

        return $data;
    }

    public function write(array $data)
    {
        $jsonEncoder = new JSONEndoder();
        $json = $jsonEncoder->getJson($data);
        $this->filesystem->put($this->filename, $json);
    }
}