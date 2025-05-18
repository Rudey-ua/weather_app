<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvalidInputException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render(): Response
    {
        return response(null, 400);
    }
}
