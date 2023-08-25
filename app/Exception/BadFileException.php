<?php

namespace App\Exception;

use Exception;

/**
 * Exception throws if file not exists or user have no permission for reading
 */
class BadFileException extends Exception
{
    protected $message = 'File not exists or not readable';
}