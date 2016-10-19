<?php
use App\User;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Default preparation for each test
     *
     */
    public function setUp()
    {
        parent::setUp(); // Don't forget this!

        $this->prepareForTests();
    }

    /**
     * Migrates the database and set the mailer to 'pretend'.
     * This will cause the tests to run quickly.
     *
     */
    private function prepareForTests()
    {
        Artisan::call('migrate');
    }

    /**
     * @param $route
     * @param User $user
     * @return array
     */
    protected function getDataFromApiGet($route, $data = [], User $user = null)
    {
        $response = $this->apiGetResponse($route, $data, $user)->response->getContent();

        $array =  json_decode($response, true)['data'];

        $this->assertNotNull($array);

        return $array;
    }

    /**
     * @param $route
     * @param array $data
     * @param User $user
     * @return array
     */
    protected function getDataFromApiPost($route, $data = [], User $user = null)
    {
        $response = $this->apiPostResponse($route, $data, $user)->response->getContent();

        $array =  json_decode($response, true)['data'];

        $this->assertNotNull($array);

        return $array;
    }

    /**
     * @param $route
     * @param array $data
     * @param User|null $user
     * @return $this
     */
    protected function apiGetResponse($route, $data = [], User $user = null)
    {
        $route .= count($data) ? '?'.http_build_query($data) : '';

        return $this->get('/api/'.$route, $this->jwtHeaders($user));
    }

    /**
     * @param $route
     * @param array $data
     * @param User|null $user
     * @return $this
     */
    protected function apiPostResponse($route, $data = [], User $user = null)
    {
        return $this->post('/api/'.$route, $data, $this->jwtHeaders($user));
    }

    /**
     * Return request headers needed to interact with the API.
     *
     * @param \App\User|null $user
     * @return array array of headers.
     */
    protected function jwtHeaders($user = null)
    {
        $headers = ['Accept' => 'application/json'];

        if (!is_null($user)) {
            $token = JWTAuth::fromUser($user);
            JWTAuth::setToken($token);
            $headers['Authorization'] = 'Bearer '.$token;
        }

        return $headers;
    }
}
