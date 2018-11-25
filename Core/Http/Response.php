<?php

namespace Core\Http;

use Core\Container;


class Response
{
    /**
     * Container Object
     *
     * @var \Core\Container
     */
    private $container;

    /**
     * Headers container that will be sent to the browser
     *
     * @var array
     */
    private $headers = [];

    /**
     * The content that will be sent to the browser
     *
     * @var string
     */
    private $content = '';


    /**
     * Constructor
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Set the response output content
     *
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Set the response Headers
     *
     * @param string $header
     * @param mixed value
     * @return void
     */
    public function setHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

    /**
     * Send the response headers and content
     *
     * @return void
     */
    public function send()
    {
        $this->sendHeaders();
        $this->sendOutput();
    }

    /**
     * Send the response headers
     *
     * @return void
     */
    private function sendHeaders()
    {
        $this->setDefaultJsonHeaders();
        foreach ($this->headers as $header => $value) {
            header($header . ':' . $value);
        }


        //Remove fingerprinting headers
        header_remove("X-Powered-By");
        header_remove("Server");
    }

    private function setDefaultJsonHeaders()
    {
        $headers = [
            'Content-Type'             => "application/json",
            'Content-Security-Policy'  => "default-src 'none'",
            'X-Content-Type-Options'   => "nosniff header",
            'X-Frame-Options'          => "deny header",
        ];

        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * Send the response output
     *
     * @return void
     */
    private function sendOutput()
    {
        echo $this->content;
    }

    /**
     * Set http response code
     * @param int $statusCode
     * @return void
     */
    public function setHttpResponseCode(int $statusCode)
    {
        $sapi_type = php_sapi_name();
        if (substr($sapi_type, 0, 3) == 'cgi')
            header("Status: ". $statusCode);
        else
            header("HTTP/1.1 ". $statusCode);
    }
}