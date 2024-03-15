<?php

namespace App\Http\Controllers\Account\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Place\TableStoreRequest;
use App\Http\Requests\Account\Place\TableUpdateRequest;
use App\Models\Table;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TableController extends Controller
{
    public function index(Request $request): View
    {
        $tables = Table::all();

        return view('table.index', compact('tables'));
    }

    public function create(Request $request): View
    {
        return view('table.create');
    }

    public function store(TableStoreRequest $request): RedirectResponse
    {
        $table = Table::create($request->validated());

        $request->session()->flash('table.id', $table->id);

        return redirect()->route('tables.index');
    }

    public function show(Request $request, Table $table): View
    {
        return view('table.show', compact('table'));
    }

    public function edit(Request $request, Table $table): View
    {
        return view('table.edit', compact('table'));
    }

    public function update(TableUpdateRequest $request, Table $table): RedirectResponse
    {
        $table->update($request->validated());

        $request->session()->flash('table.id', $table->id);

        return redirect()->route('tables.index');
    }

    public function destroy(Request $request, Table $table): RedirectResponse
    {
        $table->delete();

        return redirect()->route('tables.index');
    }
}
