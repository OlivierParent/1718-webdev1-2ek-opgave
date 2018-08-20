<?php

namespace App\Http\Controllers;

use CreateUsersTable as Users;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    const AUTHENTICATED = 'front-office-authenticated';

    /**
     * @var string
     */
    protected $_loginTitle;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_loginTitle = 'Login';
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $title = $this->_loginTitle;
        return view('auth.login', compact('title'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function login(Request $request)
    {
        try {
            // Validate Form
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            // Process Form
            [
                'email' => $email,
                'password' => $password,
            ] = $request->only([
                'email',
                'password',
            ]);
            $user = app('db')
                ->table(Users::TABLE) // 'users'
                ->select(
                    Users::PK, // 'id'
                    'email',
                    'password as hash'
                )
                ->where([
                    'email' => $email,
                    'deleted_at' => null,
                ])
                ->first();
            if ($user) {
                $authenticated = password_verify($password, $user->hash);
                if ($authenticated) {
                    $_SESSION[self::AUTHENTICATED] = $user->id;
                    return redirect()->route('users.show', [
                        'userId' => $user->id,
                    ]);
                }
            }
            $errors = [
                'message' => 'Unable to login with the provided credentials.',
            ];
        } catch (ValidationException $exception) {
            $errors = $exception->getResponse()->original;
        } catch (Exception $exception) {
            dd($exception);
        }
        // Show Form
        [
            'email' => $email,
        ] = $request->all();
        $password = '';
        $title = $this->_loginTitle;
        return view('auth.login', compact(
            'email',
            'password',
            'errors',
            'title'
        ));
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        session_destroy();
        return redirect()->route('home');
    }
}
