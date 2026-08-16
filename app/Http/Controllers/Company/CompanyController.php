<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index()
    {

        //        $data = Company::latest()->paginate(5);
        $data = DB::table('companies')->select('companies.company_name', 'companies.address',
            'companies.contact_no', 'users.email', 'users.username', 'companies.company_id', 'companies.id')
            ->join('users', 'users.id', 'companies.company_id')->paginate(5);

        return view('companies.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {

        DB::transaction(function () use ($request) {

            $user = User::create(array_merge($request->all(), ['role_id' => 2]));

            $userid = $user->id;

            //        $request->validate([
            //
            //
            //        ]);

            Company::create(array_merge($request->all(), ['company_id' => $userid]));

        });

        return redirect()->route('company.index')
            ->with('success', 'Post created successfully.');

    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {

        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {

        $company->update($request->all());

        return redirect()->route('company.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('company.index')
            ->with('success', 'Post deleted successfully');
    }
}
