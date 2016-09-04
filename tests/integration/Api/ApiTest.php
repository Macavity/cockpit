<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class ApiTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_should_return_json_if_requested()
    {
        /** @var \App\User $user */
        $user = factory(App\User::class)->create();

        $this->actingAs($user);

        $response = $this->get('/api/users', $this->jwtHeaders($user));

        $response->seeJsonStructure([
            'data' => [
                '*' => [
                    'uuid', 'name'
                ]
            ]
        ])
            ->assertResponseStatus(self::HTTP_OK);
    }

    /** @test */
    public function it_should_return_json_if_an_error_occurs()
    {
        $this->json('GET', '/api/blub-not-existing/url', ['some' => 'data'])
            ->seeJsonStructure(['message', 'status_code']);
    }

    /** @test */
    public function a_user_can_authenticate_and_will_get_a_token()
    {
        $faker = Faker\Factory::create();
        $fakePassword = $faker->password(8);

        /** @var User $user */
        $user = factory(User::class)->create([
            'password' => Hash::make($fakePassword)
        ]);

        $this->json('POST', '/api/authenticate', [
                'email' => $user->email(),
                'password' => $fakePassword
            ])
            ->seeJsonStructure([
                'token'
            ])
            ->assertResponseStatus(self::HTTP_OK);
    }

    public function it_should_allow_a_user_to_refresh_his_token()
    {
        /** @var \App\User $user */
        $user = factory(App\User::class)->create();

        $this->get('/api/token', $this->jwtHeaders($user))
            ->seeStatusCode(self::HTTP_OK)
            ->seeJsonStructure([
                'token'
            ]);
    }
}
