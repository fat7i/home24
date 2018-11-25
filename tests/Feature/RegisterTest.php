<?php

namespace Tests\Feature;

use Tests\AbstractTestCase;
use GuzzleHttp\Exception\RequestException;

class RegisterTest extends AbstractTestCase
{
    /**
     *  Test user register successfully
     */
    public function testsRegistersSuccessfully()
    {
        $url = self::BASE_URI . '/register';
        $payload = [
            'name' => 'Test User',
            'email' => 'testuser'. rand(0,100) .'@test.com',
            'password' => 'testPassword',
            'password_confirmation' => 'testPassword',
        ];

        $headers = ['Content-type' => 'application/json'];

        $request = $this->client->post($url, ['body' => json_encode($payload), 'headers' => $headers]);

        $response = (string) $request->getBody();

        $statusCode = $request->getStatusCode();

        $this->assertEquals(201, $statusCode);
        $this->assertJson($response);

        //TODO delete user after test
    }

    /**
     *  Test user register without name, email and password
     */
    public function testsRequiresPasswordEmailAndName()
    {
        $url = self::BASE_URI . '/register';
        $headers = ['Content-type' => 'application/json'];

        try {

            $this->client->post($url, ['body' => "", 'headers' => $headers]);

        } catch (RequestException $e) {

            $statusCode = $e->getCode();
            $response = (string)$e->getResponse()->getBody();


            $this->assertEquals(400, $statusCode);
            $this->assertJson($response);

            $expectedJson = '{
                "errors": {
                    "name": "Name Is Required",
                    "email": "Email Is Required",
                    "password": "Password Is Required"
                }
            }';

            $this->assertJsonStringEqualsJsonString($expectedJson, $response);
        }
    }

    /**
     *  Test passwords not match
     */
    public function testsRequirePasswordConfirmation()
    {
        $url = self::BASE_URI . '/register';
        $headers = ['Content-type' => 'application/json'];

        $payload = [
            'name' => 'Test User',
            'email' => 'testuser'. rand(0,100) .'@test.com',
            'password' => 'testPassword',
            'password_confirmation' => 'anotherTestPassword',
        ];

        try {

            $this->client->post($url, ['body' => json_encode($payload), 'headers' => $headers]);

        } catch (RequestException $e) {

            $statusCode = $e->getCode();
            $response = (string)$e->getResponse()->getBody();


            $this->assertEquals(400, $statusCode);
            $this->assertJson($response);

            $expectedJson = '{
                "errors": {
                    "password_confirmation": "Password_confirmation should match Password"
                }
            }';

            $this->assertJsonStringEqualsJsonString($expectedJson, $response);
        }
    }
}