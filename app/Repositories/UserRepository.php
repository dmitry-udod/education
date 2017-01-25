<?php

namespace App\Repositories;

use App\User;
use Illuminate\Database\Query\Builder;

class UserRepository
{
    /**
     * Get Users list for pagination
     *
     * @return Builder
     */
    public function all()
    {
        return User::orderBy('created_at', 'DESC');
    }

    /**
     * Find User by id
     *
     * @param $id
     * @return User
     */
    public function find($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Save User data
     *
     * @param array $data
     * @param $id
     * @return User
     */
    public function save(array $data, $id)
    {
        if (is_null($id)) {
            $user = new User();
        } else {
            $user = $this->find($id);
        }

//        $User->display_name = $data['display_name'];
//        $User->description = $data['description'];
        $user->save();

        return $user;
    }

    /**
     * Delete User
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $user = $this->find($id);

        return $user->delete();
    }
}