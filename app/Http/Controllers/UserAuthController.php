<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

class UserAuthController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    function register(Request $request): Response
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);
            DB::beginTransaction();
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            $client = Client::where('password_client', 1)->first();

            $request->request->add([
                'grant_type'    => 'password',
                'client_id'     => $client->id,
                'client_secret' => $client->secret,
                'username'      => $data['email'],
                'password'      => $data['password'],
                'scope'         => null,
            ]);

            $token = Request::create(
                'oauth/token',
                'POST'
            );
            DB::commit();
            return Route::dispatch($token);

        } catch(ValidationException $e) {
            DB::rollback();
            return new Response(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            DB::rollback();
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    function login(Request $request): JsonResponse
    {
        try{
            $data = $request->validate([
                'email' => 'required|string|max:255',
                'password' => 'required|string|max:255',
            ]);

            $isAuth = auth()->attempt($data);

            if ($isAuth) {

                $user = User::find(Auth::user()->id);

                return new JsonResponse([
                    'success' => true,
                    'access_token' => $user->createToken('appToken')->accessToken,
                    'user' => $user,
                ], Response::HTTP_OK);
            } else {

                return new JsonResponse([
                    'success' => false,
                    'message' => 'Failed to authenticate.',
                ], Response::HTTP_NOT_FOUND);
            }
        } catch(ValidationException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch(Exception $e) {
            return new JsonResponse(null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
