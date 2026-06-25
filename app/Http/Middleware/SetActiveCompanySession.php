<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetActiveCompanySession
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user) {
            // If the user belongs to a specific company, lock their session to it.
            if (! is_null($user->company_id)) {
                session([
                    'company_id' => $user->company_id,
                    'active_company_id' => $user->company_id,
                    'company_name' => $user->company?->name,
                    'active_company_name' => $user->company?->name,
                ]);
            }
            // Super admins can work across companies, so default to the first one when none is set.
            elseif (! session()->has('company_id')) {
                $firstCompany = \App\Models\Company::first();
                if ($firstCompany) {
                    session([
                        'company_id' => $firstCompany->id,
                        'active_company_id' => $firstCompany->id,
                        'company_name' => $firstCompany->name,
                        'active_company_name' => $firstCompany->name,
                    ]);
                }
            }
        }

        return $next($request);
    }
}