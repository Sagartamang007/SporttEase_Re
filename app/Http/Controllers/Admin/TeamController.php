<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    // ✅ List all teams
    public function index()
    {
        $teams = Team::all();
        return view('admin.team.index', compact('teams'));
    }

    // ✅ Show form to create a team
    public function create()
    {
        return view('admin.team.create');
    }

    // ✅ Store new team
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle Image Upload
        $imagePath = $request->file('image')->store('teams', 'public');

        Team::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'image' => $imagePath,
        ]);

        return redirect()->route('team.index')->with('success', 'Team member added successfully.');
    }

    // ✅ Show edit form
    public function edit(Team $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    // ✅ Update team
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($team->image); // Delete old image
            $team->image = $request->file('image')->store('teams', 'public');
        }

        $team->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'image' => $team->image,
        ]);

        return redirect()->route('team.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(Team $team)
    {
        // Check if image exists before deleting
        if ($team->image && Storage::disk('public')->exists($team->image)) {
            Storage::disk('public')->delete($team->image);
        }

        $team->delete();

        return redirect()->route('team.index')->with('success', 'Team member deleted successfully.');
    }

}
