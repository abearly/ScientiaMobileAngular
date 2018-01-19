<?php

namespace App\Http\Response;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Contracts\ArrayableInterface;

class ApiResponse
{
    const STATUS_CODE_OK = Response::HTTP_OK;
    const STATUS_CODE_INVALID_INPUT = Response::HTTP_BAD_REQUEST;
    const STATUS_CODE_UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;
    const STATUS_CODE_FORBIDDEN = Response::HTTP_FORBIDDEN;
    const STATUS_CODE_NOT_FOUND = Response::HTTP_NOT_FOUND;
    const STATUS_CODE_SERVER_ERROR = Response::HTTP_INTERNAL_SERVER_ERROR;

    private $properties = [
        'success' => null,
        'message' => null,
        'data' => null,
        'status' => null
    ];

    protected static $instance = null;
    /**
     * @var Symfony\Component\HttpFoundation\Response
     */
    protected $response;

    public static function instance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
            self::$instance->response = JsonResponse::create();
        }
        return self::$instance;
    }

    public function send()
    {
        if (empty($this->properties['status'])) {
            throw new Exception("Status code is not defined");
        }

        $this->response->setData($this->properties);
        $this->response->setStatusCode($this->properties['status']);
        $this->response->send();
        exit;
    }

    public static function __callStatic($call, $arguments)
    {
        $instance = self::instance();
        $instance->$call = reset($arguments);
        return $instance;
    }
    public function __call($call, $arguments)
    {
        $this->$call = reset($arguments);
        return $this;
    }

    public function __set($key, $value)
    {
        if (! array_key_exists($key, $this->properties)) {
            return;
        }
        switch ($key) {
            case 'success':
                if (! is_bool($value)) {
                    throw new Exception("Response success is not boolean");
                }
                break;
            case 'data':
                if ($value instanceof ArrayableInterface) {
                    $value = $value->toArray();
                }
                if (! is_array($value)) {
                    throw new Exception("Response data is not array");
                }
                break;
            case 'paginated':
                if (! is_array($value)) {
                    throw new Exception("Pagination data must be array");
                }
                break;
            case 'pagination':
                if (! is_array($value)) {
                    throw new Exception("Pagination data must be array");
                }
                break;
        }
        $this->properties[$key] = $value;
        return;
    }
}
