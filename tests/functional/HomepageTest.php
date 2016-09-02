<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomepageTest extends TestCase
{
    /**
     * @test
     */
    public function homepage()
    {
        $this->visit('/')
             ->see('Cockpit');
    }

}
