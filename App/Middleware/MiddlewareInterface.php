<?php

namespace App\Middleware;

use Core\Container;

interface MiddlewareInterface
{
    /**
     * Handle the middleware
     *
     * @param Container $container
     * @param string $next
     * @return mixed
     */
    public function handle(Container $container, $next);
}