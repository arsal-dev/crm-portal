<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgreementController extends Controller
{
    public function all()
    {
        $agreements = Agreement::all();
        return view('superadmin.agreements.all', compact('agreements'));
    }

    public function create(){
        return view('superadmin.agreements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'document' => 'required|mimes:pdf,doc,docx,xls,xlsx',
        ]);

        $documentPath = $request->file('document')->store('agreement_documents', 'public');

        Agreement::create([
            'name' => $request->name,
            'description' => $request->description,
            'document' => $documentPath,
        ]);

        return redirect()->route('agreement.create')->with('success', 'Agreement document added successfully.');
    }

    public function destroy($id)
    {
        $agreement = Agreement::findOrFail($id);

        // Delete the associated document file from storage
        Storage::disk('public')->delete($agreement->document);

        // Delete the agreement from the database
        $agreement->delete();

        return redirect()->route('agreement.all')->with('success', 'Agreement deleted successfully.');
    }
}
