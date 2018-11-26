<?php

namespace App\Traits;


trait ThrottlingTrait
{
    /**
     * Container Object
     *
     * @var \Core\Container
     */
    protected $container;

    /**
     * Requests count
     *
     * @var int
     */
    private $rate_limit_limit;

    /**
     * Remaining request count
     *
     * @var int
     */
    private $rate_limit_remaining;

    /**
     * Reset time
     *
     * @var int
     */
    private $rate_limit_reset;

    /**
     * Period time (15 minutes)
     *
     * @var float|int
     */
    private $rate_limit_time;

    /**
     * ThrottlingTrait constructor.
     */
    public function __construct()
    {
        $this->container = \Core\Container::getInstance();

        $this->rate_limit_limit = config('rate_limit.limit');
        $this->rate_limit_time = config('rate_limit.time');
        $this->rate_limit_reset = time() + $this->rate_limit_time;
    }

    /**
     * Check rate limits
     *
     * @return bool
     */
    public function checkRateLimits()
    {
        if (!$this->getRateLimitsFromSession()) {
            $this->getRateLimitsFromDB();
        }

        if (isset($this->rate_limit_remaining) && $this->rate_limit_remaining > 0) {
            $this->rate_limit_remaining--;
            $this->container->get('session')->set('rate_limit_remaining', $this->rate_limit_remaining);
            return true;
        }

        if($this->rate_limit_reset <= time()) {
            $this->resetRateLimits();
            return true;
        }

        return false;
    }

    /**
     * Set rate limits
     *
     * @param int $rate_limit_limit
     * @param int $rate_limit_remaining
     * @param int $rate_limit_reset
     */
    private function setRateLimits(int $rate_limit_limit, int $rate_limit_remaining, int $rate_limit_reset)
    {
        $this->rate_limit_limit = $rate_limit_limit;
        $this->rate_limit_remaining = $rate_limit_remaining;
        $this->rate_limit_reset = $rate_limit_reset;
    }

    /**
     * Set rate limits in session
     *
     * @param int $rate_limit_limit
     * @param int $rate_limit_remaining
     * @param int $rate_limit_reset
     */
    private function setRateLimitsInSession(int $rate_limit_limit, int $rate_limit_remaining, int $rate_limit_reset)
    {
        $this->container->get('session')->set('rate_limit_limit', $rate_limit_limit);
        $this->container->get('session')->set('rate_limit_remaining', $rate_limit_remaining);
        $this->container->get('session')->set('rate_limit_reset', $rate_limit_reset);
    }

    /**
     * Set rate limits in database
     *
     * @param int $rate_limit_limit
     * @param int $rate_limit_remaining
     * @param int $rate_limit_reset
     */
    private function setRateLimitsInDB(int $rate_limit_limit, int $rate_limit_remaining, int $rate_limit_reset)
    {
        $user_id = $this->container->get('session')->get('id');

        $rate_limit = [
            "rate_limit_limit"     => $rate_limit_limit,
            "rate_limit_remaining" => $rate_limit_remaining,
            "rate_limit_reset"     => $rate_limit_reset,
        ];

        $query = $this->container->get('db')->pdo()->prepare('UPDATE users SET `rate_limit` = :rate_limit WHERE id = :id ');
        $query->execute(["rate_limit" => json_encode($rate_limit), "id" => $user_id]);
    }


    /**
     * Retrieve rate limits from session
     *
     * @return bool
     */
    private function getRateLimitsFromSession()
    {
        if ( $this->container->get('session')->has('rate_limit_remaining') && $this->container->get('session')->has('rate_limit_reset')) {

            $this->setRateLimits(
                (int) $this->container->get('session')->get('rate_limit_limit'),
                (int) $this->container->get('session')->get('rate_limit_remaining'),
                (int) $this->container->get('session')->get('rate_limit_reset')
            );

            return true;
        }

        return false;
    }

    /**
     * Retrieve rate limits from database
     *
     * @return void
     */
    private function getRateLimitsFromDB()
    {
        $user_id = $this->container->get('session')->get('id');

        $user = $this->container->get('db')->select('rate_limit')->where('id=?' , $user_id)->fetch('users');


        if (!$user['rate_limit']) {
            $rate_limit_limit = (int) $this->rate_limit_limit;
            $rate_limit_remaining = (int) $this->rate_limit_limit;
            $rate_limit_reset = (int) time() + $this->rate_limit_time;

            $this->setRateLimitsInDB($rate_limit_limit, $rate_limit_remaining, $rate_limit_reset);

        } else {
            $rate_limit = json_decode($user['rate_limit'], true);

            $rate_limit_limit = (int) $rate_limit['rate_limit_limit'];
            $rate_limit_remaining = (int) $rate_limit['rate_limit_remaining'];
            $rate_limit_reset = (int) $rate_limit['rate_limit_reset'];
        }

        $this->setRateLimits($rate_limit_limit, $rate_limit_remaining, $rate_limit_reset);
        $this->setRateLimitsInSession($rate_limit_limit, $rate_limit_remaining, $rate_limit_reset);
    }

    /**
     * Reset rate limits
     *
     * @return void
     */
    private function resetRateLimits()
    {
        $rate_limit_limit = (int) $this->rate_limit_limit;
        $rate_limit_remaining = (int) $this->rate_limit_limit;
        $rate_limit_reset = (int) time() + $this->rate_limit_time;

        $this->setRateLimits($rate_limit_limit, $rate_limit_remaining, $rate_limit_reset);
        $this->setRateLimitsInSession($rate_limit_limit, $rate_limit_remaining, $rate_limit_reset);
        $this->setRateLimitsInDB($rate_limit_limit, $rate_limit_remaining, $rate_limit_reset);
    }

    /**
     * Send rate limits in header
     *
     * @return void
     */
    private function sendHeaders()
    {
        $this->container->get('response')->setHeader("x-rate-limit-limit", $this->rate_limit_limit);
        $this->container->get('response')->setHeader("x-rate-limit-remaining", $this->rate_limit_remaining);
        $this->container->get('response')->setHeader("x-rate-limit-reset", $this->rate_limit_reset);
    }


}
