<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct(UserRepository $users, RoleRepository $roles)
    {
        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->users->all()->paginate();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roles->rolesForDropdown();

        return view('admin.users.create_edit', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->users->save($request->all(), null);

        if ($user->id) {
            $request->session()->flash('success', 'Новий користувач успiшно створений');

            return redirect(route('users.edit', $user->id));
        }

        $request->session()->flash('error', 'Помилка при створеннi користувача');

        return redirect(route('users.create'));
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
        $user = $this->users->find($id);
        $roles = $this->roles->rolesForDropdown();
        $userRoleIds = $user->roles()->get()->pluck('id')->toArray();

        return view('admin.users.create_edit', compact('roles', 'user', 'userRoleIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, $id)
    {
        $user = $this->users->find($id);

        $role = $this->users->save($request->all(), $user->id);

        $request->session()->flash('success', 'Даннi збереженi');

        return redirect(route('users.edit', $role->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $isDeleted = $this->users->delete($id);

        if ($isDeleted) {
            $request->session()->flash('success', 'Данi видаленi');
        } else {
            $request->session()->flash('error', 'Помилка при видаленнi даних');
        }

        return redirect(route('users.index'));
    }
}
