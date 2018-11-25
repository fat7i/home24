<?php

namespace Tests\Feature;

use GuzzleHttp\Exception\RequestException;
use Tests\AbstractTestCase;


final class LoginTest extends AbstractTestCase
{
    /**
     *  Login successfully test
     */
    public function testUserLoginSuccessfully()
    {
        $url = self::BASE_URI . '/login';
        $payload = ['email' => 'admin@test.com', 'password' => '123456'];
        $headers = ['Content-type' => 'application/json'];

        $request = $this->client->post($url, ['body' => json_encode($payload), 'headers' => $headers]);

        $response = (string) $request->getBody();

        $statusCode = $request->getStatusCode();

        $this->assertEquals(200, $statusCode);
        $this->assertJson($response);

    }

    /**
     *  Test login without email & password
     */
    public function testRequiresEmailAndLogin()
    {
        $url = self::BASE_URI . '/login';
        $headers = ['Content-type' => 'application/json'];

        try {

            $this->client->post($url, ['body' => "", 'headers' => $headers]);

        } catch (RequestException $e) {

            $statusCode = $e->getCode();
            $response = (string) $e->getResponse()->getBody();


            $this->assertEquals(400, $statusCode);
            $this->assertJson($response);

            $expectedJson = '{
                "errors": {
                    "email": "Email Is Required",
                    "password": "Password Is Required"
                }
            }';

            $this->assertJsonStringEqualsJsonString($expectedJson, $response);
        }
    }
}