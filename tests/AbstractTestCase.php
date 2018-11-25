<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

/**
 * Class AbstractTestCase
 * @package Tests
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     *  Base url
     */
    const BASE_URI = 'http://localhost/home24.task/public';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * {@inheritdoc}
     */
    function setUp()
    {
        parent::setUp();

        $this->client = new Client();
    }
}