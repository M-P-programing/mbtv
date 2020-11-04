<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Repositories\AuthRepository;
class AuthController extends Controller
{
    protected $auth_repo;
    public function __construct(AuthRepository $auth_repository){
        $this->auth_repo = $auth_repository;
    }
    public function signUp(AuthRequest $req){
        
        return response()->json(compact('body'));
    }

    public function login(){
        dd('login');
    }

    public function logout(){

    }
}