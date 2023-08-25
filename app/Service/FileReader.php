<?php

namespace App\Service;

use App\Exception\BadFileException;

/**
 * Service for handling file reading
 */
class FileReader
{
    /**
     * @var string File path
     */
    protected $filePath;

    /**
     * Constructor
     *
     * @param string $inputFilePath
     */
    public function __construct(string $inputFilePath)
    {
        if (substr($inputFilePath, 0, 1) !== '/') {
            $inputFilePath = PATH.'/'.$inputFilePath;
        }
        if (!is_readable($inputFilePath)) {
            throw new BadFileException();
        }
        $this->filePath = $inputFilePath;
    }

    /**
     * Read file to callback
     *
     * @param callable $callback
     * @return void
     */
    public function readLineByLine(callable $callback)
    {
        $handle = fopen($this->filePath, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $callback($line);
            }
            fclose($handle);
        }
    }
}