<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::orderByDesc('created_at')->get();

        return Inertia::render('Companies/Index', [
            'companies' => $companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Companies/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $company = Company::create($validated);

        return redirect()->route('companies.show', $company->id)->with('success', "Company '{$company->name}' created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return Inertia::render('Companies/Show', [
            'company' => $company,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return Inertia::render('Companies/Edit', [
            'company' => $company,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $validated = $request->validated();

        $company->update($validated);

        return redirect()->route('companies.show', $company->id)->with('success', "Company '{$company->name}' updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        // Delete the logo file if it exists
        // if ($company->logo) {
        //     Storage::disk('public')->delete($company->logo);
        // }

        $company->delete();

        return redirect()->route('companies.index')->with('success', "Company '{$company->name}' was deleted successfully.");
    }
}
