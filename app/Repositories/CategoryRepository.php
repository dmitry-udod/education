<?php

namespace App\Repositories;

use App\Category;
use Illuminate\Database\Query\Builder;

class CategoryRepository
{
    /**
     * Get Categories list for pagination
     *
     * @return Builder
     */
    public function all()
    {
        return Category::orderBy('order');
    }

    /**
     * Find Category by id
     *
     * @param $id
     * @return Category
     */
    public function find($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Save Category data
     *
     * @param array $data
     * @param $id
     * @return Category
     */
    public function save(array $data, $id)
    {
        if (is_null($id)) {
            $category = new Category();
        } else {
            $category = $this->find($id);
        }

        $category->name = $data['name'];
        $category->slug = $data['slug'];
        $category->order = (int)$data['order'];

        $category->save();

        return $category;
    }

    /**
     * Delete Category
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $category = $this->find($id);

        return $category->delete();
    }

    public function categoriesForDropdown()
    {
        return Category::orderBy('name')->get()->pluck('name', 'id');
    }
}