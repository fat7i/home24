<?php

namespace App\Models;

use Core\Abstracts\AbstractModel;


class User extends AbstractModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * User Data
     *
     * @var mixed
     */
    private $user;


    /**
     * Determine if the given login data is valid
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function isValidLogin($email, $password)
    {
        $user = $this->where('email=?' , $email)->fetch($this->table);

        if (!$user) {
            return false;
        }
        $this->user = $user;
        return password_verify($password, $user['password']);
    }

    /**
     * Generate JWT token
     *
     * @return array
     */
    public function generateToken()
    {
        $this->session->set('id', $this->user['id']);
        $this->session->set('session_id', mt_rand());

        $session_id = $this->session->get('session_id');

        $token = [
            "iss" => $_SERVER['REQUEST_URI'],
            "iat" => time(),
            "exp" => time() + (60*60),
            "id" => $this->user['id'],
        ];

        $jwt_token = $this->jwt::encode($token, $session_id);
        return ["token" => $jwt_token];
    }

    /**
     * Create product
     *
     * @return array of created product
     */
    public function create()
    {
        $user_id = $this->data('name', $this->request->post('name'))
            ->data('email', $this->request->post('email'))
            ->data('password', password_hash($this->request->post('password'), PASSWORD_DEFAULT))
            ->insert($this->table)->lastId();

        $this->user = $this->getOne($user_id);

        return $this->generateToken();
    }

    /**
     * Get one user by id
     *
     * @param int $id
     * @return null
     */
    public function getOne (int $id)
    {
        $output = $this->select('id', 'name', 'email', 'created_at')
            ->from($this->table)
            ->where('id = ?', $id)
            ->fetch();

        if (!$output) return null;

        return $output;
    }

}