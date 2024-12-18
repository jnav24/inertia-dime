<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class VerifyMfaController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Auth/Mfa');
    }
}
