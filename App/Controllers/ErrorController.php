<?php

namespace App\Controllers;

use Core\Abstracts\AbstractController;


class ErrorController extends AbstractController
{
    /**
     * Display 404 output
     *
     * @return string
     */
    public function notFound()
    {

        $this->errors['errors'] = "Page not found!";
        return $this->json($this->errors, 404);
    }
}