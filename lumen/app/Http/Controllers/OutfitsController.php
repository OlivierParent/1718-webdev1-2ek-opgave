<?php

namespace App\Http\Controllers;

use CreateOutfitPieceTable as OutfitPiece;
use CreatePiecesTable as Pieces;
use CreateOutfitsTable as Outfits;
use Illuminate\View\View;

class OutfitsController extends Controller
{
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
        $this->_titleOutfit = 'Outfit';
        $this->_titleOutfits = 'Outfits';
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $title = $this->_titleOutfits;
        $outfits = app('db')
            ->table(Outfits::TABLE) // 'outfits'
            ->select(
                Outfits::TABLE_PK,                // 'outfits.id'
                Outfits::TABLE . '.name as name', // 'outfits.name as name'
                Outfits::TABLE . '.description',  // 'outfits.description'
                'price',
                app('db')->raw(
                    sprintf( // 'group_concat(`pieces`.`name`) as `pieces`'
                        'group_concat(`%1$s`.`name`) as `%1$s`',
                        Pieces::TABLE // 'pieces'
                    )
                )
            )
            ->join(
                OutfitPiece::TABLE, // 'piece_outfit'
                Outfits::TABLE_PK,      // 'outfits.id'
                Outfits::FK             // 'outfit_id'
            )
            ->join(
                Pieces::TABLE,   // 'pieces'
                Pieces::FK,      // 'piece_id'
                Pieces::TABLE_PK // 'pieces.id'
            )
            ->where([
                [Outfits::TABLE . '.deleted_at', null],  // 'outfits.deleted_at'
                [Pieces::TABLE . '.deleted_at', null], // 'pieces.deleted_at'
            ])
            ->groupBy(Outfits::PK)
            ->orderBy('price', 'desc')
            ->orderBy('name')
            ->get();
        return view('outfits.index', compact(
            'outfits',
            'title'
        ));
    }

    /**
     * @param int $outfitId
     * @return View
     */
    public function show(int $outfitId): View
    {
        $title = $this->_titleOutfit;
        $outfit = app('db')
            ->table(Outfits::TABLE) // 'outfits'
            ->select(
                Outfits::TABLE_PK,                // 'outfits.id'
                Outfits::TABLE . '.name as name', // 'outfits.name as name'
                Outfits::TABLE . '.description',  // 'outfits.description'
                'price',
                app('db')->raw(
                    sprintf( // 'group_concat(`pieces`.`id`) as `pieces`',
                        'group_concat(`%1$s`.`%2$s`) as `%1$s`',
                        Pieces::TABLE, // 'pieces'
                        Pieces::PK     // 'id'
                    )
                )
            )
            ->join(
                OutfitPiece::TABLE, // 'piece_outfit'
                Outfits::TABLE_PK,      // 'outfits.id'
                Outfits::FK             // 'outfit_id'
            )
            ->join(
                Pieces::TABLE,   // 'pieces'
                Pieces::FK,      // 'piece_id'
                Pieces::TABLE_PK // 'pieces.id'
            )
            ->where([
                [Outfits::TABLE_PK, $outfitId],        // 'outfits.id'
                [Pieces::TABLE . '.deleted_at', null], // 'pieces.deleted_at'
            ])
            ->first();
        $pieceIds = array_map('intval', explode(',', $outfit->pieces)); // E.g. '1,5,8' -> ['1','5','8'] -> [1,5,8]
        $pieces = app('db')
            ->table(Pieces::TABLE) // 'pieces'
            ->select(
                Pieces::PK, // 'id'
                'name'
            )
            ->whereIn(Pieces::PK, $pieceIds) // sql: WHERE id IN (1,5,8)
            ->orderBy('name')
            ->get()
            ->toArray(); // Necessary for empty(), does not work for Collection.
        return view('outfits.show', compact(
            'pieces',
            'outfit',
            'title'
        ));
    }
}
