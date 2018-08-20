<?php

namespace App\Http\Controllers;

use CreateOrderOutfitTable as OrderOutfit;
use CreateOrdersTable as Orders;
use CreateOutfitsTable as Outfits;
use CreateUsersTable as Users;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class OrdersController extends Controller
{
    const SHOPPING_CART = 'shoppingCart';

    /**
     * @var string
     */
    protected $_titleOrder;

    /**
     * @var string
     */
    protected $_titleOrders;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_titleOrder = 'Place Order';
        $this->_titleOrders = 'Orders';
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $title = $this->_titleOrders;
        $orders = app('db')
            ->table(Orders::TABLE) // 'orders'
            ->select(
                Orders::PK,                    // 'id'
                Orders::TABLE . '.created_at', // 'orders.created_at'
                'total',
                app('db')->raw('sum(`quantity`) as `outfits`')
            )
            ->join(
                OrderOutfit::TABLE, // 'order_outfit'
                Orders::PK,           // 'id'
                Orders::FK            // 'order_id'
            )
            ->where(Users::FK, $_SESSION[AuthController::AUTHENTICATED] ?? null) // 'user_id'
            ->groupBy(Orders::PK) // 'id'
            ->orderBy(Orders::PK, 'desc') // 'id'
            ->get();
        return view('orders.index', compact(
            'orders',
            'title'
        ));
    }

    public function create()
    {
        $title = $this->_titleOrder;
        $total = 0;
        if (isset($_SESSION[self::SHOPPING_CART])) {
            $outfitIds = array_keys($_SESSION[self::SHOPPING_CART]);
            $outfits = app('db')
                ->table(Outfits::TABLE) // 'outfits'
                ->select(
                    Outfits::PK, // 'id'
                    'name',
                    'price'
                )
                ->whereIn(Outfits::PK, $outfitIds) // 'outfits'
                ->orderBy('name')
                ->get();
            for ($i = 0, $iMax = count($outfits); $i < $iMax; ++$i) {
                $id = $outfits[$i]->id;
                $outfits[$i]->quantity = $_SESSION[self::SHOPPING_CART][$id];
                $total += $outfits[$i]->subtotal = $outfits[$i]->quantity * $outfits[$i]->price;
            }
        } else {
            $outfits = [];
        }
        return view('orders.create', compact(
            'outfits',
            'total',
            'title'
        ));
    }

    public function store()
    {
        try {
            $date = new DateTime();
            if (isset($_SESSION[AuthController::AUTHENTICATED]) && isset($_SESSION[self::SHOPPING_CART])) {
                $outfitIds = array_keys($_SESSION[self::SHOPPING_CART]);
                $outfits = app('db')
                    ->table(Outfits::TABLE) // 'outfits'
                    ->select(
                        Outfits::PK, // 'id'
                        'price'
                    )
                    ->whereIn(Outfits::PK, $outfitIds) // 'outfits'
                    ->get();
                // Insert row in table `orders`.
                $orderId = app('db')
                    ->table(Orders::TABLE) // 'orders'
                    ->insertGetId([
                        'created_at' => $date,
                        Users::FK => $_SESSION[AuthController::AUTHENTICATED], // 'user_id'
                    ]);
                $ordersOutfits = [];
                $total = 0;
                foreach ($outfits as $outfit) {
                    $total += $outfit->price * $_SESSION[self::SHOPPING_CART][$outfit->id];
                    $ordersOutfits[] = [
                        Orders::FK => $orderId,          // 'order_id'
                        Outfits::FK => $outfit->id, // 'outfit_id'
                        'created_at' => $date,
                        'price' => $outfit->price,
                        'quantity' => $_SESSION[self::SHOPPING_CART][$outfit->id],
                    ];
                }
                // Insert new rows in table `order_outfit`.
                app('db')
                    ->table(OrderOutfit::TABLE) // 'order_outfit'
                    ->insert($ordersOutfits);
                app('db')
                    ->table(Orders::TABLE) // 'orders'
                    ->where(Orders::PK, $orderId) // 'id'
                    ->update([
                        'updated_at' => $date,
                        'total' => $total,
                    ]);
            }
            $_SESSION[self::SHOPPING_CART] = []; // Clear shopping cart.
        } catch (Exception $error) {
            return redirect()->route('orders.create');
        }
        return redirect()->route('orders.index');
    }

    /**
     * @param int $orderId
     * @return View
     */
    public function show(int $orderId): View
    {
        $title = "Order ${orderId}";
        $order = app('db')
            ->table(Orders::TABLE) // 'orders'
            ->select(
                Orders::PK, // 'id'
                'created_at',
                'total'
            )
            ->where(Orders::PK, $orderId) // 'id'
            ->first();
        $outfits = app('db')
            ->table(OrderOutfit::TABLE) // 'order_outfit'
            ->select(
                Outfits::TABLE_PK,            // 'outfit_id'
                'name',
                'quantity',
                OrderOutfit::TABLE . '.price', // 'order_outfit.price'
                app('db')->raw(
                    sprintf( // '`quantity` * `order_outfit`.`price` as `subtotal`'
                        '`quantity` * `%s`.`price` as `subtotal`',
                        OrderOutfit::TABLE // 'order_outfit'
                    )
                )
            )
            ->join(
                Outfits::TABLE,   // 'outfits'
                Outfits::FK,      // 'outfit_id'
                Outfits::TABLE_PK // 'outfits.id'
            )
            ->where(
                Orders::FK, // 'order_id'
                $order->id
            )
            ->orderBy('name')
            ->get();
        return view('orders.show', compact(
            'order',
            'outfits',
            'title'
        ));
    }

    /**
     * @param int $outfitId
     * @return RedirectResponse
     */
    public function add(int $outfitId)
    {
        if (!isset($_SESSION[self::SHOPPING_CART])) {
            $_SESSION[self::SHOPPING_CART] = []; // Create empty shopping cart.
        }
        if (!isset($_SESSION[self::SHOPPING_CART][$outfitId])) {
            $_SESSION[self::SHOPPING_CART][$outfitId] = 0; // Add outfit entry to shopping cart.
        }
        $_SESSION[self::SHOPPING_CART][$outfitId] += 1; // Add a outfit.
        return redirect()->route('outfits.index');
    }

    /**
     * @return RedirectResponse
     */
    public function clear()
    {
        $_SESSION[self::SHOPPING_CART] = []; // Clear shopping cart.
        return redirect()->route('outfits.index');
    }
}
