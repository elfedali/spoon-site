<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\RoleStoreRequest;
use App\Http\RoleUpdateRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(Request $request): View
    {
        return view('role.index');
    }

    public function create(Request $request): View
    {
        return view('role.create');
    }

    public function store(RoleStoreRequest $request): RedirectResponse
    {

        return redirect()->route('roles.index');
    }

    public function show(Request $request): View
    {
        return view('role.show');
    }

    public function edit(Request $request): View
    {
        return view('role.edit');
    }

    public function update(RoleUpdateRequest $request): RedirectResponse
    {

        return redirect()->route('roles.index');
    }

    public function destroy(Request $request): RedirectResponse
    {


        return redirect()->route('roles.index');
    }
}
