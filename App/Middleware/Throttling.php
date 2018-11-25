<?php

namespace App\Middleware;

use App\Traits\ThrottlingTrait;
use Core\Container;


class Throttling implements MiddlewareInterface
{
    use ThrottlingTrait;

    /**
     * {@inheritdoc}
     *
     * @param Container $container
     * @param string $next
     * @return mixed|void
     */
    public function handle(Container $container, $next)
    {
        $hasLimit = $this->checkRateLimits();
        $this->sendHeaders();

        if($hasLimit){
           return $next;
       }else{
            $container->get('response')->setHttpResponseCode(429);
           return json_encode(["error" => "Rate limit exceeded"]);
       }
    }
}