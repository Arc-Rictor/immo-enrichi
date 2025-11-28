<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\CompleteAgentRegistration;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CompleteAgentRegistrationController extends Controller
{
    /**
     * Show the form to complete the Agent registration.
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
   {
      return Inertia::render('Auth/AgentRegistrationProfile', [
          'user' => $request->user(),
      ]);
   }

    /**
     * Store the required Agent data
     *
     * @param Request $request
     * @param CompleteAgentRegistration $completeAgentRegistration
     * @return JsonResponse
     */
    public function store(Request $request, CompleteAgentRegistration $completeAgentRegistration)
   {
       $user = \Auth::user();

       $completeAgentRegistration->execute($user, $request->all());

       return response()->json(['redirect_to' => route('subscription-check')]);
   }
}
