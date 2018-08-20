<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use CreateAdminsTable as Admins;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    const AUTHENTICATED = 'back-office-authenticated';

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
        return view('back-office.auth.login', compact('title'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function login(Request $request)
    {
        try {
            // Validate Form
            /**
             * @todo VRAAG 5.A - READ: valideer formulier.
             *
             * Valideer het formulier:
             *
             * - 'email' is verplicht en moet een geldig e-mailadres zijn
             * - 'password' is verplicht
             */
            # antwoord »

            # « antwoord
            // Process Form
            /**
             * @todo VRAAG 5.B - READ: haal informatie uit het formulier.
             *
             * Maak twee variabelen met de informatie uit het request:
             *
             * - `$email`
             * - `$password`
             */
            # antwoord »

            # « antwoord
            // 3. Get Admin form admins table.
            /**
             * @todo VRAAG 5.C - READ: voer query uit om gegevens op te vragen.
             *
             * Haal uit de databasetabel `admins` deze informatie op:
             *
             * - e-mailadres als `email`
             * - wachtwoord als `hash`
             * Bewaar de opgehaalde informatie in de variabele `$admin`.
             */
            # antwoord »

            # « antwoord
            if ($admin) {
                /**
                 * @todo VRAAG 5.D - Controleer wachtwoord.
                 * Controleer of het wachtwoord geldig is
                 * en bewaar de uitkomst in de variabele `$authenticated`.
                 */
                # antwoord »

                # « antwoord
                if ($authenticated) {
                    $_SESSION[self::AUTHENTICATED] = $admin->id;
                    return redirect()->route('back-office.dashboard');
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
        return view('back-office.auth.login', compact(
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
