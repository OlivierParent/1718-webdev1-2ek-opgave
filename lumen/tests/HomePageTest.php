<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class HomePageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomePageHasBackOfficeLink()
    {
        $this->get('/');
//->response->assertSee('SwishSho');
    }
}
