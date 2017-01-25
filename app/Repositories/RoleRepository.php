<?php

namespace App\Repositories;

use App\Role;
use Illuminate\Database\Query\Builder;

class RoleRepository
{
    /**
     * Get roles list for pagination
     *
     * @return Builder
     */
    public function all()
    {
        return Role::orderBy('created_at', 'DESC');
    }

    /**
     * Find role by id
     *
     * @param $id
     * @return Role
     */
    public function find($id)
    {
        return Role::findOrFail($id);
    }

    /**
     * Save role data
     *
     * @param array $data
     * @param $id
     * @return Role
     */
    public function save(array $data, $id)
    {
        if (is_null($id)) {
            $role = new Role();
        } else {
            $role = $this->find($id);
        }

        $role->name = str_slug($data['display_name']);
        $role->display_name = $data['display_name'];
        $role->description = $data['description'];
        $role->save();

        return $role;
    }
}