<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /**
         * @todo VRAAG 3 - Schakel authenticatie override terug uit.
         *
         * Verwijder onderstaande regel
         * en ga naar <http://localhost:8080/back-office/admins/logout>.
         */
        # antwoord »
        $_SESSION[AuthController::AUTHENTICATED] = 1;
        # « antwoord
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $title = 'Back Office';

        /**
         * @todo VRAAG 1 - QUERY: outfit top 10.
         *
         * Top 10 outfits aller tijden volgens aantal (`quantity`) bestellingen
         * in aflopende volgorde.
         *
         * Kolommen in het antwoord van de databaseserver:
         *
         *  - `name`
         *  - `total`
         */
        $sql = <<<'sql'
            -- antwoord »

            -- « antwoord
sql;
        $outfits = app('db')->select($sql);
        $outfits = array_map(function ($outfit) {
            $outfit->name = ucwords(str_replace_first(' and ', ' & ', $outfit->name));
            return (array) $outfit;
        }, $outfits);

        /**
         * @todo VRAAG 2 - QUERY: overzicht 7 dagen terug in de tijd.
         *
         * Overzicht per dag van: omzet, aantal bestellingen en gemiddelde bedrag
         * per bestelling. En dit voor 7 dagen terug in de tijd gesorteerd op dag aflopend.
         * Zorg er ook voor dat bedragen afgerond worden op 2 cijfers na de komma.
         *
         * Kolommen in het « antwoord van de databaseserver:
         *
         * - `day`
         * - `orders`
         * - `total_revenue`
         * - `avg_order_revenue`
         */
        $sql = <<<'sql'
            -- antwoord »

            -- « antwoord
sql;
        $orders = app('db')->select($sql);
        $orders = array_map(function ($order) {
            return (array) $order;
        }, $orders);

        return view('back-office.dashboard', compact(
            'outfits',
            'orders',
            'title'
        ));
    }
}
