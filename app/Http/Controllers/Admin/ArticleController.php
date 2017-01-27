<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCategoryRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function __construct(ArticleRepository $articles, CategoryRepository $categories, RoleRepository $roles)
    {
        $this->categories = $categories;
        $this->articles = $articles;
        $this->roles = $roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articles->all()->paginate();

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categories->categoriesForDropdown();
        $roles = $this->roles->rolesForDropdown();

        return view('admin.articles.create_edit', compact('roles', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $user = $this->categories->save($request->all(), null);

        if ($user->id) {
            $request->session()->flash('success', 'Категорiя успiшно додана');

            return redirect(route('categories.edit', $user->id));
        }

        $request->session()->flash('error', 'Помилка при створеннi категорiї');

        return redirect(route('categories.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categories->find($id);

        return view('admin.categories.create_edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, $id)
    {
        $category = $this->categories->find($id);

        $this->categories->save($request->all(), $category->id);

        $request->session()->flash('success', 'Даннi збереженi');

        return redirect(route('categories.edit', $category->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $isDeleted = $this->categories->delete($id);

        if ($isDeleted) {
            $request->session()->flash('success', 'Данi видаленi');
        } else {
            $request->session()->flash('error', 'Помилка при видаленнi даних');
        }

        return redirect(route('categories.index'));
    }
}
