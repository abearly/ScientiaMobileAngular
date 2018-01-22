<?php

namespace App\Http\Controllers;

date_default_timezone_set('America/New_York');

use Illuminate\Routing\Controller as BaseController;
use App\Http\Response\ApiResponse;
use Illuminate\Http\Request;
use App\User;
use App\Http\UserRepository;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function get()
    {
        $response = ApiResponse::instance();
        $repo = new UserRepository();
        $users = $repo->getUsers();

        $response->status = ApiResponse::STATUS_CODE_OK;
        $response->success = true;
        $response->data = $users;
        $response->message = "Users";
        return $response->send();
    }

    public function login(Request $request)
    {
        $response = ApiResponse::instance();
        $repo = new UserRepository();
        $users = $repo->getUsers();

        $username = $request->input('username');
        $password = $request->input('password');

        foreach ($users as $user) {
            if ($user->username === $username) {
                if ($user->password === $password) {
                    $response->status = ApiResponse::STATUS_CODE_OK;
                    $response->success = true;
                    $response->data = ['user' => $user];
                    $response->message = "Login successful!";
                    return $response->send();
                } else {
                    $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
                    $response->success = false;
                    $response->data = ['password'];
                    $response->message = "Invalid password!";
                    return $response->send();
                }
            }
        }

        $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
        $response->success = false;
        $response->data = ['username'];
        $response->message = "Unknown username!";
        return $response->send();
    }


    public function create(Request $request)
    {

    }

    public function changePassword(Request $request) {
        $password = $request->input('password');
        $repeat = $request->input('repeat');
        $id = $request->input('id');

        $response = ApiResponse::instance();

        if ($password !== $repeat) {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->data = [];
            $response->message = 'Passwords do not match';
            return $response->send();
        }

        if (strlen($password) < 6) {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->data = [];
            $response->message = 'Password must be 6 characters minimum';
            return $response->send();
        }

        $repo = new UserRepository();
        $users = $repo->getUsers();

        foreach ($users as $user) {
            if ($user->id === $id) {
                $user->password = $password;
                break;
            }
        }

        $repo->saveUsers($users);
    }

    public function editUser(Request $request)
    {
        $user = $request->input('user');
        $response = ApiResponse::instance();

        $error_data = [];
        if ($user['username'] === null || $user['username'] === '') {
            $error_data['username'] = 'Username is required';
        }

        if ($user['name'] === null || $user['name'] === '') {
            $error_data['name'] = 'Name is required';
        }

        if ($user['role'] === null || $user['role'] === '') {
            $error_data['role'] = 'Role is required';
        }

        if (!empty($error_data)) {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->message = "Error!";
            $response->data = $error_data;
            return $response->send();
        }

        $repo = new UserRepository();
        $users = $repo->getUsers();

        foreach ($users as $item) {
            if ($item->username === $user['username'] && $item->id !== $user['id']) {
                $error_data['username'] = 'Username is not unique';
            }
        }

        if (!empty($error_data)) {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->message = "Error!";
            $response->data = $error_data;
            return $response->send();
        }

        foreach ($users as $item) {
            if ($item->id === $user['id']) {
                $item->username = $user['username'];
                $item->name = $user['name'];
                $item->role = $user['role'];
                break;
            }
        }
        $repo->saveUsers($users);
    }

    private function createToken() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function addUser(Request $request)
    {
        $user = $request->input('user');
        $repeat = $request->input('repeat');

        $response = ApiResponse::instance();

        $error_data = [];
        if ($user['username'] === null || $user['username'] === '') {
            $error_data['username'] = 'Username is required';
        }

        if ($user['name'] === null || $user['name'] === '') {
            $error_data['name'] = 'Name is required';
        }

        if ($user['role'] === null || $user['role'] === '') {
            $error_data['role'] = 'Role is required';
        }

        if ($user['password'] === null || $user['password'] === '') {
            $error_data['password'] = 'Password is required';
        }

        if ($user['password'] !== $repeat) {
            $error_data['password'] = 'Passwords do not match';
        } else if (strlen($user['password']) < 6) {
            $error_data['password'] = 'Password must be 6 characters minimum';
        }

        if (!empty($error_data)) {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->message = "Error!";
            $response->data = $error_data;
            return $response->send();
        }

        $repo = new UserRepository();
        $users = $repo->getUsers();

        $last_id = 0;
        foreach ($users as $item) {
            if ($item->username === $user['username']) {
                $error_data['username'] = 'Username is not unique';
                break;
            }
            if ($item->id > $last_id) {
                $last_id = $item->id;
            }
        }
        if (!empty($error_data)) {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->message = "Error!";
            $response->data = $error_data;
            return $response->send();
        }

        $last_id++;
        $user['id'] = $last_id;
        $user['token'] = $this->createToken();
        $users[] = new User($user);
        $repo->saveUsers($users);
    }

    public function deleteUser(Request $request)
    {
        $id = $request->input('id');
        $response = ApiResponse::instance();
        $repo = new UserRepository();
        $users = $repo->getUsers();

        $updated_users = [];
        foreach ($users as $user) {
            if ($user->id !== $id) {
                $updated_users[] = $user;
            }
        }
        $repo->saveUsers($updated_users);
    }
}
