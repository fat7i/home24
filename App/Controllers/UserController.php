<?php

namespace App\Controllers;

use App\Models\User;
use Core\Abstracts\AbstractController;


class UserController extends AbstractController
{
    /**
     * User login
     *
     * @return string
     */
    public function login()
    {
        $this->validator->required('email')->email('email');
        $this->validator->required('password');

        if ($this->validator->fails()) {
            $this->errors['errors'] = $this->validator->flattenMessages();
            return $this->json($this->errors, 400);
        }

        $email = $this->request->post('email');
        $password = $this->request->post('password');

        $user = new User();

        if (!$user->isValidLogin($email, $password)) {
            $this->errors['errors'][] = 'Invalid Login Data';
        }

        if ($this->errors) {
            return $this->json($this->errors, 400);
        }

        return $this->json($user->generateToken());
    }

    /**
     * User logout
     *
     * @return string
     */
    public function logout()
    {
        $this->saveRateLimits();
        $this->session->destroy();
        return $this->json(["message" => "logged out successfully"]);
    }

    /**
     * Create a user
     *
     * @return string
     */
    public function create()
    {
        if ($this->isValidInputs()) {

            $user = new User();
            $output = $user->create();

            return $this->json($output, 201);
        } else {

            $this->errors['errors'] = $this->validator->flattenMessages();
            return $this->json($this->errors, 400);
        }
    }

    /**
     * Validate the inputs
     *
     * @return bool
     */
    private function isValidInputs()
    {
        $this->validator->required('name');
        $this->validator->required('email')->email('email')->unique('email', ['users', 'email']);
        $this->validator->required('password')->match('password', 'password_confirmation');

        return $this->validator->passes();
    }

    private function saveRateLimits(){
        $user_id = $this->container->get('session')->get('id');

        $rate_limit = [
            "rate_limit_limit"     => (int) $this->container->get('session')->get('rate_limit_limit'),
            "rate_limit_remaining" => (int) $this->container->get('session')->get('rate_limit_remaining'),
            "rate_limit_reset"     => (int) $this->container->get('session')->get('rate_limit_reset'),
        ];

        $query = $this->container->get('db')->pdo()->prepare('UPDATE users SET `rate_limit` = :rate_limit WHERE id = :id ');
        $query->execute(["rate_limit" => json_encode($rate_limit), "id" => $user_id]);
    }
}