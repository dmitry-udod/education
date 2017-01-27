<?php

namespace App\Repositories;

use App\Article;
use Illuminate\Database\Query\Builder;

class ArticleRepository
{
    /**
     * Get Categories list for pagination
     *
     * @return Builder
     */
    public function all()
    {
        return Article::orderBy('order');
    }

    /**
     * Find Article by id
     *
     * @param $id
     * @return Article
     */
    public function find($id)
    {
        return Article::findOrFail($id);
    }

    /**
     * Save Article data
     *
     * @param array $data
     * @param $id
     * @return Article
     */
    public function save(array $data, $id)
    {
        if (is_null($id)) {
            $article = new Article();
        } else {
            $article = $this->find($id);
        }

        $article->name = $data['name'];
        $article->slug = $data['slug'];
        $article->order = (int)$data['order'];

        $article->save();

        return $article;
    }

    /**
     * Delete Article
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $article = $this->find($id);

        return $article->delete();
    }
}