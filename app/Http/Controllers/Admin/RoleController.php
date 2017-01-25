<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreAdminRole;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roles->all()->paginate();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRole $request)
    {
        $role = $this->roles->save($request->all(), null);

        if ($role->id) {
            $request->session()->flash('success', 'Роль створена');

            return redirect(route('roles.edit', $role->id));
        }

        $request->session()->flash('error', 'Помилка при створеннi ролi');

        return redirect(route('roles.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roles->find($id);

        return view('admin.roles.create_edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAdminRole $request, $id)
    {
        $role = $this->roles->find($id);

        $role = $this->roles->save($request->all(), $role->id);

        $request->session()->flash('success', 'Роль збережена');

        return redirect(route('roles.edit', $role->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $isDeleted = $this->roles->delete($id);

        if ($isDeleted) {
            $request->session()->flash('success', 'Роль видалена');
        } else {
            $request->session()->flash('error', 'Помилка при видаленнi ролi');
        }

        return redirect(route('roles.index'));
    }
}
