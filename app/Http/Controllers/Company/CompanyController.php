<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index()
    {
        $query = Company::select(
            'companies.company_name',
            'companies.address',
            'companies.contact_no',
            'users.email',
            'users.username',
            'companies.company_id',
            'companies.id'
        )
            ->join('users', 'users.id', '=', 'companies.company_id');

        if (Auth::check() && Auth::user()->role_id == 2) {
            $query->where('companies.company_id', Auth::id());
        }

        $data = $query->paginate(10);

        return view('companies.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_no' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'role_id' => 2,
            ]);

            Company::create([
                'company_id' => $user->id,
                'company_name' => $request->company_name,
                'address' => $request->address,
                'contact_no' => $request->contact_no,
            ]);
        });

        return redirect()->route('company.index')
            ->with('success', 'Company created successfully.');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        if (Auth::check() && Auth::user()->role_id == 2 && $company->company_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        if (Auth::check() && Auth::user()->role_id == 2 && $company->company_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_no' => 'required',
        ]);

        $company->update($validated);

        return redirect()->route('company.index')
            ->with('success', 'Company updated successfully');
    }

    public function destroy(Company $company)
    {
        if (Auth::check() && Auth::user()->role_id == 2 && $company->company_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $company->delete();

        return redirect()->route('company.index')
            ->with('success', 'Company deleted successfully');
    }

    public function updateEmployerProfile(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_no' => 'required',
        ]);

        Company::updateOrCreate(
            ['company_id' => Auth::id()],
            [
                'company_name' => $request->company_name,
                'address' => $request->address,
                'contact_no' => $request->contact_no,
            ]
        );

        if ($request->filled('name')) {
            User::where('id', Auth::id())->update([
                'name' => $request->name,
            ]);
        }

        return redirect()->back()->with('success', 'Employer company profile updated successfully.');
    }
}
