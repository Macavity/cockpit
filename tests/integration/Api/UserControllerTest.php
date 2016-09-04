<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_should_return_the_current_user_if_authenticated()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $this->json('GET', 'api/users/me', [], $this->jwtHeaders($user))
            ->seeJsonStructure([
                'data' => ['uuid', 'name']
            ])
            ->seeJson([
                'uuid' => $user->uuid(),
                'name' => $user->name(),
            ])
            ->assertResponseStatus(self::HTTP_OK);
    }

    /** @test */
    public function it_should_return_an_error_if_not_authenticated()
    {
        $this->json('GET', 'api/users/me')
            ->assertResponseStatus(self::HTTP_BAD_REQUEST);
    }

    public function it_should_update_a_user_if_authenticated()
    {
        $faker = Faker\Factory::create();
        $fakeName = $faker->name;

        /** @var App\User $user */
        $user = factory(App\User::class)->create();

        $updatedData = [
            'name' => $fakeName
        ];

        $this->post('/api/users/'.$user->uuid(), $updatedData, $this->jwtHeaders($user))
            ->seeStatusCode(self::HTTP_ACCEPTED)
            ->seeJsonStructure([
                'data' => [
                    'uuid' => $user->uuid(),
                    'name' => $fakeName,
                ]
            ]);
    }

    public function it_should_create_a_user()
    {
        $user = factory(User::class)->make();

        $this->post('/api/users/', $user, $this->jwtHeaders($user))
            ->seeStatusCode(self::HTTP_CREATED);
    }

    /** @test */
    public function it_should_get_a_user_by_its_uuid()
    {
        /**
         * @type User
         */
        $user = factory(User::class)->create();

        $this->get('/api/users/'.$user->uuid())
            ->seeStatusCode(self::HTTP_OK);
    }
}
