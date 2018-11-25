<?php

namespace App\Middleware;

use Core\Container;
use Core\Http\Request;
use \Firebase\JWT\SignatureInvalidException;


class Auth implements MiddlewareInterface
{
    /**
     * {@inheritdoc}
     *
     * @param Container $container
     * @param string $next
     * @throws \Firebase\JWT\SignatureInvalidException
     * @return mixed|void
     */
    public function handle(Container $container, $next)
    {
        $session_id = $container->get('session')->get('session_id');

        if(!$session_id){
            $container->get('response')->setHttpResponseCode(401);
            return json_encode(["error" => "Expired token"]);
        }

        try {

            $jwt_token = Request::getTokenFromHeader();

            $container->get('jwt')::decode($jwt_token, $session_id , array('HS256'));

        } catch (SignatureInvalidException $e) {

            $container->get('response')->setHttpResponseCode(401);
            return json_encode(["error" => $e->getMessage()]);
        }

        return $next;
    }
}