<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use CreateAdminsTable as Admins;
use Illuminate\View\View;

class AdminsController extends Controller
{
    /**
     * Show the admin profile.
     *
     * @param int $adminId
     * @return View
     */
    public function show(int $adminId): View
    {
        /**
         * @todo VRAAG 6 - READ: voer query uit om gegevens op te halen.
         *
         * Haal een specifieke `$admin` op uit de databasetabel `admins`
         * en zorg ervoor dat het enkel die informatie bevat die echt nodig is in de View.
         */
        # antwoord »

        # « antwoord
        $title = 'Admin Profile';
        return view('back-office.admins.show', compact(
            'admin',
            'title'
        ));
    }
}
