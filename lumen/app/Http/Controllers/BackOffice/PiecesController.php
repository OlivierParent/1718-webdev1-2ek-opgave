<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use CreatePiecesTable as Pieces;
use DateTime;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use stdClass as Piece;

class PiecesController extends Controller
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
    protected $_titlePiece;

    /**
     * @var string
     */
    protected $_titlePieces;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_titleCreate = 'New piece';
        $this->_titleEdit = 'Update piece';
        $this->_titlePiece = 'Piece';
        $this->_titlePieces = 'Pieces';
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $pieces = self::getPieces();
        $title = $this->_titlePieces;
        return view('back-office.pieces.index', compact(
            'pieces',
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
        $title = $this->_titleCreate;
        return view('back-office.pieces.create', compact('title'));
    }

    /**
     * Store the submitted data from the piece form.
     *
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function store(Request $request)
    {
        try {
            // Validate form.
            /**
             * @todo VRAAG 7.B - CREATE: valideer formulier.
             *
             * Valideer het formulier:
             *
             * - `name` is verplicht
             * - `description` is verplicht
             */
            # antwoord »

            # « antwoord
            // Process form.
            /**
             * @todo VRAAG 7.C - CREATE: haal informatie uit het formulier.
             *
             * Maak de variabele `$piece` met deze informatie uit het request:
             *
             * - `name`
             * - `description`
             */
            # antwoord »

            # « antwoord
            /**
             * @todo VRAAG 7.D - CREATE: voer query uit om gegevens op te slaan.
             *
             * Sla `$piece` op in de databasetabel `pieces`
             * en bewaar de primaire sleutel in de variabele `$pieceId`
             */
            # antwoord »

            # « antwoord
            return redirect()->route('back-office.pieces.show', compact('pieceId'));
        } catch (ValidationException $exception) {
            $errors = $exception->getResponse()->original;
        } catch (Exception $exception) {
            dd($exception);
        }
        // Show form
        [
            'name' => $name,
            'description' => $description,
        ] = $request->all();
        $title = $this->_titleCreate;
        return view('back-office.pieces.create', compact(
            'name',
            'description',
            'errors',
            'title'
        ));
    }

    /**
     * @param int $pieceId
     * @return View
     */
    public function show(int $pieceId): View
    {
        $piece = self::getPiece($pieceId);
        $title = $this->_titlePiece;
        return view('back-office.pieces.show', compact(
            'piece',
            'title'
        ));
    }

    /**
     * Edit piece.
     *
     * @param int $pieceId
     * @return View
     */
    public function edit(int $pieceId): View
    {
        $piece = self::getPiece($pieceId);
        $title = $this->_titleEdit;
        return view('back-office.pieces.edit', compact(
            'piece',
            'title'
        ));
    }

    /**
     * Update piece.
     *
     * @param int $pieceId
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function update(int $pieceId, Request $request)
    {
        try {
            // Validate form.
            /**
             * @todo VRAAG 7.F - UPDATE: valideer formulier.
             *
             * Valideer het formulier:
             *
             * - `name` is verplicht
             * - `description` is verplicht
             */
            # antwoord »

            # « antwoord
            // Process form.
            /**
             * @todo VRAAG 7.G - UPDATE: haal informatie uit het formulier.
             *
             * Maak de variabele `$pieces` met deze informatie uit het request:
             *
             * - `name`
             * - `description`
             */
            # antwoord »

            # « antwoord
            /**
             * @todo VRAAG 7.H - UPDATE: voer query uit om gegevens bij te werken.
             *
             * Werk het `$piece` uit de databasetabel `pieces` bij met de nieuwe gegevens.
             */
            # antwoord »

            # « antwoord
            return redirect()->route('back-office.pieces.show', compact('pieceId'));
        } catch (ValidationException $exception) {
            $errors = $exception->getResponse()->original;
        }
        $piece = new Piece();
        $piece->{Pieces::PK} = $pieceId; // 'id'
        $piece->name = $request->get('name');
        $piece->description = $request->get('description');
        $title = $this->_titleEdit;
        return view('back-office.pieces.edit', compact(
            'piece',
            'errors',
            'title'
        ));
    }

    /**
     * Delete piece.
     *
     * @param int $pieceId
     * @return RedirectResponse
     */
    public function delete(int $pieceId): RedirectResponse
    {
        try {
            $piece = self::getPiece($pieceId);
            // Soft (un)delete
            /**
             * @todo VRAAG 7.I - DELETE: verwijder gegevens.
             *
             * Verwijder `$piece` met een soft delete.
             */
            # antwoord »

            # « antwoord
        } catch (QueryException $exception) {
            dd($exception);
        } finally {
            return redirect()->route('back-office.pieces.index');
        }
    }

    /**
     * @return Collection
     */
    public static function getPieces(): Collection
    {
        /**
         * @todo VRAAG 7.A - READ: voer query uit om gegevens op te halen.
         *
         * Haal uit de databasetabel `pieces` de nodige informatie op die in de Views gebruikt wordt.
         * Sorteer op naam.
         */
        # antwoord »

        # « antwoord
    }

    /**
     * @param int $pieceId
     * @return Piece
     */
    protected static function getPiece(int $pieceId): Piece
    {
        /**
         * @todo VRAAG 7.E - READ: voer query uit om gegevens op te halen.
         *
         * Haal een specifiek piece op uit de databasetabel `pieces`
         * en zorg ervoor dat het enkel die informatie bevat die echt nodig is in de Views.
         */
        # antwoord »

        # « antwoord
    }
}
