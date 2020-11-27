<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\AuthResource;
use App\Repositories\AuthRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller
{
  protected $auth_repo;
  public function __construct(AuthRepository $auth_repository)
  {
    $this->auth_repo = $auth_repository;
  }
  public function signUp(AuthRequest $req)
  {
    try {
      DB::beginTransaction();

      /*  ***Store image in disk*** */

      $image           = $req->file('image');
      if($image){
        $image_path_name = time() . $image->getClientOriginalName();
        Storage::disk('users')->put($image_path_name, File::get($image));
      }else{
        $image_path_name = null;
      }     

      $data = [
        'name'     => $req->name,
        'surname'  => $req->surname,
        'email'    => $req->email,
        'password' => bcrypt($req->password),
        'image'    => $image_path_name,
      ];

      $query = $this->auth_repo->create($data);
      $user  = new AuthResource($query);
      $body  = compact('user');
      DB::commit();

      return response()->json(compact('body'), 201);

    } catch (Exception $e) {
      DB::rollback();

      $message = 'Algo inesperado aconteceu...';
      throw new Exception($message, 500);
    }

  }

  public function login(Request $req)
  {
    $req->validate([
      'email'       => 'required|string|email',
      'password'    => 'required|string',
      'remember_me' => 'boolean',
    ]);

    $credentials = request(['email', 'password']);

    if (!Auth::attempt($credentials)) {
      return response()->json([
        'message' => 'Este usuario nao existe ou a password está incorrecta',
      ], 401);
    }

    $user = $req->user();

    $tokenResult = $user->createToken('Personal Access Token');
    $token       = $tokenResult->token;

    if ($req->remember_me) {
      $token->expires_at = Carbon::now()->addWeeks(1);
    }

    $token->save();

    return response()->json([
      'access_token' => $tokenResult->accessToken,
      'token_type'   => 'Bearer',
      'expires_at'   => Carbon::parse(
        $tokenResult->token->expires_at
      )->toDateTimeString(),
    ]);
  }

  /**
   * Logout user (Revoke the token)
   *
   * @return [string] message
   */
  public function logout(Request $request)
  {
    $request->user()->token()->revoke();

    return response()->json([
      'message' => 'Successfully logged out',
    ]);
  }
}
