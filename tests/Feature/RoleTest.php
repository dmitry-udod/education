<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRoleIndex()
    {
        $user = User::find(1);

        $this->actingAs($user)
            ->get(route('roles.index'))
            ->assertSee('Ролi')
        ;
    }

    public function testRoleCreate()
    {
        $user = User::find(1);

        $this->actingAs($user)
            ->get(route('roles.create'))
            ->assertSee('display_name')
        ;
    }
}
