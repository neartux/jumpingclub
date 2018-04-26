<?php
/**
 * User: ricardo
 * Date: 24/04/18
 * Time: 08:12 PM
 */

namespace App\Http\Controllers;


use App\Repository\sale\SaleInterface;
use App\Utils\common\CommonsUtils;
use Illuminate\Http\Request;

class ReservationController extends Controller {

    private $sale;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SaleInterface $sale) {
        $this->middleware('auth');
        $this->sale = $sale;
    }

    public function reservationList() {
        return view('/admin/reservation/reservationlist');
    }

    public function findAllReservation(Request $request) {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        return response()->json($this->sale->findAllSalesByDates(CommonsUtils::stringToDate($startDate), CommonsUtils::stringToDate($endDate), 1));
    }

}