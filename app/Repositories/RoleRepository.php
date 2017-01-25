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

        if ($role->name !== Role::ROLE_SLUG_ADMIN) {
            $role->name = str_slug($data['display_name']);
        }
        $role->display_name = $data['display_name'];
        $role->description = $data['description'];
        $role->save();

        return $role;
    }

    /**
     * Delete role
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $role = $this->find($id);

        if ($role->name === Role::ROLE_SLUG_ADMIN) {
            return false;
        }

        return $role->delete();
    }

    /**
     * Get roles list for selects (id => name)
     *
     * @return mixed
     */
    public function rolesForDropdown()
    {
        return Role::orderBy('display_name')->get()->pluck('display_name', 'id');
    }
}