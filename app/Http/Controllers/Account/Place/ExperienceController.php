<?php

namespace App\Http\Controllers\Account\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExperienceStoreRequest;
use App\Http\Requests\ExperienceUpdateRequest;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function index(Request $request): View
    {
        $experiences = Experience::all();

        return view('experience.index', compact('experiences'));
    }

    public function create(Request $request): View
    {
        return view('experience.create');
    }

    public function store(ExperienceStoreRequest $request): RedirectResponse
    {
        $experience = Experience::create($request->validated());

        $request->session()->flash('experience.id', $experience->id);

        return redirect()->route('experiences.index');
    }

    public function show(Request $request, Experience $experience): View
    {
        return view('experience.show', compact('experience'));
    }

    public function edit(Request $request, Experience $experience): View
    {
        return view('experience.edit', compact('experience'));
    }

    public function update(ExperienceUpdateRequest $request, Experience $experience): RedirectResponse
    {
        $experience->update($request->validated());

        $request->session()->flash('experience.id', $experience->id);

        return redirect()->route('experiences.index');
    }

    public function destroy(Request $request, Experience $experience): RedirectResponse
    {
        $experience->delete();

        return redirect()->route('experiences.index');
    }
}
