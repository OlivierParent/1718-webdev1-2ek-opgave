<?php

namespace App\Http\Controllers;

use CreateOutfitPieceTable as OutfitPiece;
use CreatePiecesTable as Pieces;
use CreateOutfitsTable as Outfits;
use Illuminate\View\View;

class PiecesController extends Controller
{
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
        $this->_titlePiece = 'Piece';
        $this->_titlePieces = 'Pieces';
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $title = $this->_titlePieces;
        $pieces= app('db')
            ->table(Pieces::TABLE) // 'pieces'
            ->select(
                Pieces::PK, // 'id'
                'name',
                'deleted_at'
            )
            ->where('deleted_at', null)
            ->orderBy('name')
            ->get();
        return view('pieces.index', compact(
            'pieces',
            'title'
        ));
    }

    /**
     * @param int $pieceId
     * @return View
     */
    public function show(int $pieceId): View
    {
        $title = $this->_titlePiece;
        $piece = app('db')
            ->table(Pieces::TABLE) // 'pieces'
            ->select(
                'name',
                'description'
            )
            ->where(Pieces::PK, $pieceId) // 'id'
            ->first();
        $outfits = app('db')
            ->table(Outfits::TABLE) // 'outfits'
            ->select(
                Outfits::PK, // 'id'
                'name'
            )
            ->join(
                OutfitPiece::TABLE, // 'piece_outfit'
                Outfits::PK,        // 'id'
                Outfits::FK         // 'outfit_id'
            )
            ->where([
                [Pieces::FK, $pieceId],                 // 'piece_id'
                [Outfits::TABLE . '.deleted_at', null], // 'outfits.deleted_at'
            ])
            ->orderBy('name')
            ->get()
            ->toArray(); // Necessary for empty(), does not work for Collection.
        return view('pieces.show', compact(
            'piece',
            'outfits',
            'title'
        ));
    }
}
