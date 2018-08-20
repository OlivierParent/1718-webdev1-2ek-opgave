<?php

namespace App\Http\Controllers;

use CreateOrdersTable as Orders;
use CreateUsersTable as Users;
use DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use stdClass as User;

class UsersController extends Controller
{
    /**
     * @var string
     */
    protected $_titleEdit;

    /**
     * @var string
     */
    protected $_titleRegister;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_titleEdit = 'Edit User Profile';
        $this->_titleRegister = 'Register';
    }

    /**
     * Show the user registration form.
     *
     * @return View
     */
    public function create(): View
    {
        $title = $this->_titleRegister;
        return view('users.create', compact('title'));
    }

    /**
     * Store the submitted data from the user registration form.
     *
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function store(Request $request)
    {
        try {
            app('validator') // Necessary for 'unique:users' validation rule
                ->setPresenceVerifier(app('validation.presence'));
            // Validate Form
            $this->validate($request, [
                'name' => 'required|min:6',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'password-repeat' => 'required|same:password',
            ]);
            // Process Form
            $user = $request->only([
                'name',
                'email',
                'password',
            ]);
            $user['password'] = password_hash($user['password'], PASSWORD_ARGON2I);
            $userId = app('db')
                ->table(Users::TABLE) // 'users'
                ->insertGetId($user);
            $_SESSION[AuthController::AUTHENTICATED] = $userId;
            return redirect()->route('users.show', compact('userId'));
        } catch (ValidationException $exception) {
            $errors = $exception->getResponse()->original;
        } catch (\Exception $exception) {
            dd($exception);
        }
        // Show form
        [
            'name' => $name,
            'email' => $email,
        ] = $request->all();
        $password = '';
        $passwordRepeat = '';
        $title = $this->_titleRegister;
        return view('users.create', compact(
            'name',
            'email',
            'password',
            'passwordRepeat',
            'errors',
            'title'
        ));
    }

    /**
     * Show the user profile.
     *
     * @param int $userId
     * @return View
     */
    public function show(int $userId): View
    {
        $user = app('db')
            ->table(Users::TABLE) // 'users'
            ->select(
                Users::PK, // 'id'
                'name',
                'email'
            )
            ->where(Users::PK, $userId) // 'id'
            ->first();
        $title = 'User Profile';
        return view('users.show', compact(
            'user',
            'title'
        ));
    }

    /**
     * Edit the User profile.
     *
     * @param int $userId
     * @return View
     */
    public function edit(int $userId): View
    {
        $user = app('db')
            ->table(Users::TABLE) // 'users'
            ->select(
                Users::PK, // 'id'
                'name'
            )
            ->where(Users::PK, $userId) // 'id'
            ->first();
        $title = $this->_titleEdit;
        return view('users.edit', compact(
            'user',
            'title'
        ));
    }

    /**
     * Update the User profile.
     *
     * @param int $userId
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function update(int $userId, Request $request)
    {
        try {
            // Validate Form
            $this->validate($request, [
                'name' => 'required|min:6',
            ]);
            // Process Form
            app('db')
                ->table(Users::TABLE) // 'users'
                ->where(Users::PK, $userId) // 'id'
                ->update([
                    'name' => $request->get('name'),
                ]);
            return redirect()->route('users.show', compact('userId'));
        } catch (ValidationException $exception) {
            $errors = $exception->getResponse()->original;
        }
        $user = new User();
        $user->{Users::PK} = $userId; // 'id'
        $user->name = $request->get('name');
        $title = $this->_titleEdit;
        return view('users.edit', compact(
            'user',
            'errors',
            'title'
        ));
    }

    /**
     * Delete the user.
     *
     * @param int $userId
     * @return RedirectResponse
     */
    public function delete(int $userId): RedirectResponse
    {
        try {
            // Check if user has orders.
            $orders = app('db')
                ->table(Orders::TABLE) // 'orders'
                ->select(
                    app('db')->raw(
                        sprintf('count(`%s`) as `count`', Users::FK) // 'count(`user_id`) as `count`'
                    )
                )
                ->where(Users::FK, $userId) // 'user_id'
                ->first();
            if ($orders->count) {
                // Soft delete
                app('db')
                    ->table(Users::TABLE) // 'users'
                    ->where(Users::PK, $userId) // 'id'
                    ->update([
                        'deleted_at' => new DateTime(),
                    ]);
            } else {
                // Actual delete
                app('db')
                    ->table(Users::TABLE) // 'users'
                    ->where(Users::PK, $userId) // 'id'
                    ->delete();
            }
        } catch (QueryException $exception) {
            dd($exception);
        } finally {
            session_destroy();
            return redirect()->route('home');
        }
    }
}
