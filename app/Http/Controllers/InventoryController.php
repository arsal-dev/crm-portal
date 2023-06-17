<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Notifications\NewNotification;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    public function create()
    {
        $projects = Project::all();
        return view('superadmin.inventory.add', ['projects' => $projects]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'picture' => 'required|image',
            'area' => 'required',
            'price' => 'required',
            'project' => 'required',
        ]);

        $imagePath = $request->file('picture')->store('inventory_images', 'public');

        Inventory::create([
            'name' => $request->name,
            'picture' => $imagePath,
            'area' => $request->area,
            'price' => $request->price,
            'project_id' => $request->project,
        ]);

        return redirect()->route('inventory.create')->with('success', 'Inventory added successfully.');
    }

    public function all()
    {
        $inventories = Inventory::with('priceChange')->get();
        return view('superadmin.inventory.all', compact('inventories'));
    }

    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $projects = Project::all();
        return view('superadmin.inventory.edit', compact('inventory', 'projects'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'picture' => 'nullable|image',
            'area' => 'required',
            'price' => 'required',
            'project' => 'required',
        ]);

        $inventory = Inventory::findOrFail($id);

        if ($request->hasFile('picture')) {
            // Update the picture if a new one is provided
            $imagePath = $request->file('picture')->store('inventory_images', 'public');
            $inventory->picture = $imagePath;
        }

        $inventory->name = $request->name;
        $inventory->area = $request->area;
        $inventory->price = $request->price;
        $inventory->project_id = $request->project;

        $inventory->save();

        return redirect()->route('inventory.all')->with('success', 'Inventory updated successfully.');
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);

        // Delete the associated image file from storage
        Storage::disk('public')->delete($inventory->picture);

        // Delete the inventory from the database
        $inventory->delete();

        return redirect()->route('inventory.all')->with('success', 'Inventory deleted successfully.');
    }
}
