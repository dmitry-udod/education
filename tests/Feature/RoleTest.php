<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRoleIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->get(route('roles.index'))
            ->assertSee('Ролi')
        ;
    }
}
