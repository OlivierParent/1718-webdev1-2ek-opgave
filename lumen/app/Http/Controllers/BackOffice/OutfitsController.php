<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use CreateOutfitPieceTable as OutfitPiece;
use CreatePiecesTable as Pieces;
use CreateOutfitsTable as Outfits;
use DateTime;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class OutfitsController extends Controller
{
    /**
     * @var string
     */
    protected $_titleCreate;

    /**
     * @var string
     */
    protected $_titleEdit;

    /**
     * @var string
     */
    protected $_titleOutfit;

    /**
     * @var string
     */
    protected $_titleOutfits;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_titleCreate = 'New Outfit';
        $this->_titleEdit = 'Update Outfit';
        $this->_titleOutfit = 'Outfit';
        $this->_titleOutfits = 'Outfits';
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $title = $this->_titleOutfits;
        /**
         * @todo VRAAG 8.A - READ: voer query uit om gegevens op te halen.
         *
         * Haal uit de databasetabel `outfits` de nodige informatie op die in de View gebruikt wordt.
         * Sorteer op naam
         * Bewaar de opgehaalde informatie in de variabele `$outfits`.
         */
        # antwoord »

        # « antwoord
        return view('back-office.outfits.index', compact(
            'outfits',
            'title'
        ));
    }

    /**
     * Show the piece create form.
     *
     * @return View
     */
    public function create(): View
    {
        $pieces = PiecesController::getPieces();
        $title = $this->_titleCreate;
        return view('back-office.outfits.create', compact(
            'pieces',
            'title'
        ));
    }

    /**
     * Store the submitted data from the outfit form.
     *
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function store(Request $request)
    {
        try {
            // Validate form.
            /**
             * @todo VRAAG 8.B - CREATE: valideer formulier.
             *
             * Valideer het formulier:
             *
             * - `name` is verplicht
             * - `description` is verplicht
             * - `price` is verplicht, moet een cijfer zijn, minimaal `0.01` en maximaal `999.99`
             * - `pieces` is verplicht
             */
            # antwoord »

            # « antwoord
            // Process form.
            /**
             * @todo VRAAG 8.C - CREATE: haal informatie uit het formulier.
             *
             * Maak de variabele `$outfit` met deze informatie uit het request:
             *
             * - `name`
             * - `description`
             * - `price`
             */
            # antwoord »

            # « antwoord
            /**
             * @todo VRAAG 8.D - CREATE: voer query uit om gegevens op te slaan.
             *
             * Sla `$outfit` op in de databasetabel `outfits`
             * en bewaar de primaire sleutel in de variabele `$outfitId`
             */
            # antwoord »

            # « antwoord
            /**
             * @todo VRAAG 8.E - CREATE: haal informatie uit het formulier.
             *
             * Maak de variabele `$pieces` met de informatie uit het request.
             */
            # antwoord »

            # « antwoord
            /**
             * @todo VRAAG 8.F - CREATE: combineer informatie.
             *
             * Maak de variabele `$piecesOutfits` die de combinaties bevat
             * van de primaire sleutel van de outfit met de primaire sleutel van elk piece.
             * Tip: gebruik hiervoor de functie `array_map` met een callback (anonieme functie).
             */
            # antwoord »

            # « antwoord
            // Insert new piece/outfit combinations.
            /**
             * @todo VRAAG 8.G - CREATE: voer query uit om gegevens op te slaan.
             *
             * Sla `$piecesOutfits` op in de databasetabel `piece_outfit`.
             */
            # antwoord »

            # « antwoord
            return redirect()->route('back-office.outfits.show', compact('outfitId'));
        } catch (ValidationException $exception) {
            $errors = $exception->getResponse()->original;
        } catch (Exception $exception) {
            dd($exception);
        }
        // Show form.
        $outfit = $request->only('name', 'description', 'price', 'pieces');
        $pieces = PiecesController::getPieces();
        $title = $this->_titleCreate;
        return view('back-office.outfits.create', compact(
            'outfit',
            'pieces',
            'errors',
            'title'
        ));
    }

    /**
     * @param int $outfitId
     * @return View
     */
    public function show(int $outfitId): View
    {
        /**
         * @todo VRAAG 8.H - READ: voer query uit om gegeven op te halen.
         *
         * Haal een specifieke `$outfit` op uit de databasetabel `outfits`,
         * aangevuld met gegevens uit de tabellen `piece_outfit` en `pieces`.
         * Zorg ervoor dat het enkel die informatie bevat die echt nodig is in de Views.
         */
        # antwoord »

        # « antwoord
        /**
         * @todo VRAAG 8.I - READ: bewerk opgehaalde gegevens.
         *
         * Maak een variabele `$pieceIds` en bewaar hierin de primaire sleutels van
         * de ingrediënten in `$outfit`.
         * Tip: gebruik hiervoor de functie `array_map` met de ingebouwde functies `intval` en `explode`.
         */
        # antwoord »

        # « antwoord
        /**
         * @todo VRAAG 8.J - READ: voer query uit om gegeven op te halen.
         *
         * Haal uit de databasetabel `pieces` alle ingrediënten uit de variabele `$pieceIds` op.
         * Sorteer op naam.
         * Bewaar het resultaat in een **array** met de naam `$pieces`.
         */
        # antwoord »

        # « antwoord
        $title = $this->_titleOutfit;
        return view('back-office.outfits.show', compact(
            'pieces',
            'outfit',
            'title'
        ));
    }

    /**
     * Delete piece.
     *
     * @param int $outfitId
     * @return RedirectResponse
     */
    public function delete(int $outfitId): RedirectResponse
    {
        try {
            /**
             * @todo VRAAG 8.K - DELETE: voer query uit om gegevens op te halen.
             *
             * Haal de `$outfit` op uit de databasetabel `outfits`.
             */
            # antwoord »

            # « antwoord
            // Soft (un)delete
            /**
             * @todo VRAAG 8.L - DELETE: voer query uit om gegevens te verwijderen.
             *
             * Verwijder de `$outfit` met een soft delete.
             */
            # antwoord »

            # « antwoord
        } catch (QueryException $exception) {
            dd($exception);
        } finally {
            return redirect()->route('back-office.outfits.index');
        }
    }
}
