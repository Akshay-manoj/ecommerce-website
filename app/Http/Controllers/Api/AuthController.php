<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Create a new user.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate the request input
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', Password::min(8)->letters()->numbers()->mixedCase()],
            ]);
            // Hash the password before saving
            $validated['password'] = Hash::make($validated['password']);

            // Create the user record
            $user = User::create($validated);

            return $this->success('User created successfully', $user, Response::HTTP_CREATED);

        } catch (ValidationException $exception) {
            return $this->error('Validation failed.', Response::HTTP_UNPROCESSABLE_ENTITY, $exception->errors());
        } catch (\Exception $exception) {
            return $this->error('An error occurred.', Response::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
        }

    }

    public function loginUser(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ]);

            $credentials = request(['email', 'password']);

            if (! $token = auth()->attempt($credentials)) {
                return $this->error('Unauthorized', Response::HTTP_UNAUTHORIZED);
            }

            return $this->success('Login successful', $this->respondWithToken($token), Response::HTTP_OK);
        } catch (\Exception $exception) {
            return $this->error('Login Failed', Response::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
        }
    }

    public function user(): JsonResponse
    {
        return $this->success('', auth()->user(), Response::HTTP_OK);
    }

    /**
     * Get the token array structure.
     *
     * @param  string  $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
    }

    /**
     * Refresh a token.
     */
    public function refresh(): JsonResponse
    {
        return $this->success('', $this->respondWithToken(auth()->refresh()), Response::HTTP_OK);
    }

    public function logout(): JsonResponse
    {
        auth()->logout(true);

        return $this->success('User logged out successfully', [], Response::HTTP_OK);
    }
}
