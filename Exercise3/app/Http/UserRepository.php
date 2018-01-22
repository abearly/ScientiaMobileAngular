<?php

namespace App\Http;

use App\User;
use App\Http\Response\ApiResponse;

class UserRepository
{
    protected $users;
    protected $file;

    public function __construct()
    {
        $path = storage_path();
        $this->file = $path.'/users.json';
        $json = file_get_contents($this->file);
        if (!$json) {
            throw new Exception();
        }

        $users = json_decode($json);

        foreach ($users as $user) {
            $data = [
                'id' => $user->id,
                'username' => $user->username,
                'password' => $user->password,
                'name' => $user->name,
                'role' => $user->role,
                'token' => $user->token,
            ];
            $this->users[] = new User($data);
        }
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function getUserById($id)
    {
        foreach ($this->users as $user) {
            if ($user->id === $id) {
                return $user;
            }
        }

        $response = ApiResponse::instance();
        $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
        $response->success = false;
        $response->data = [];
        $response->message = "Could not find user with id $id";
        return $response->send();
    }

    public function getUserByUsername($username)
    {
        foreach ($this->users as $user) {
            if ($user->username === $username) {
                return $user;
            }
        }

        $response = ApiResponse::instance();
        $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
        $response->success = false;
        $response->data = [];
        $response->message = "Could not find user with username $username";
        return $response->send();
    }

    public function saveUsers($users)
    {
        $response = ApiResponse::instance();
        $this->users = $users;
        if (!file_put_contents($this->file, json_encode($users))) {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->data = [];
            $response->message = "Could not save users";
            return $response->send();
        }

        $response->status = ApiResponse::STATUS_CODE_OK;
        $response->success = true;
        $response->data = $users;
        $response->message = "Saved!";
        return $response->send();
    }
}
