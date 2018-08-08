<?php
/**
 * User: ricardo
 * Date: 24/04/18
 * Time: 08:18 PM
 */

namespace App\Repository\sale;


use App\Models\Client;
use App\Models\LocationData;
use App\Models\PersonalData;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Utils\Keys\common\ApplicationKeys;
use App\Utils\Keys\common\NumberKeys;
use App\Utils\Keys\common\StatusKeys;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleRepository implements SaleInterface {

    private $sale;
    private $client;

    function __construct(Sale $sale, Client $client) {
        $this->sale = $sale;
        $this->client = $client;
    }

    public function createSale($arraySale) {
        //print_r($arraySale);
        $sale = new Sale();
        $sale->status_id = StatusKeys::STATUS_RESERVADO;
        $sale->user_id = Auth::user()->id;
        $clientId = $arraySale['client']['id'];
        // Termina el proceso si el cliente no existe
        if (!$this->client->existClientById($clientId)) {
            throw new \Exception("El cliente es invalido");
        }
        $sale->client_id = $clientId;
        $sale->created_at = Carbon::now();
        $sale->personal_data_id = $this->createPersonalData($arraySale);
        $sale->location_data_id = $this->createLocationData($arraySale);
        $dateEvent = explode('/', $arraySale['fechaEvento']);
        $date = Carbon::createFromDate((int) $dateEvent[2], (int) $dateEvent[1], (int) $dateEvent[0]);
        $sale->event_date = $date;
        $sale->event_time = $arraySale['horaEvento'];
        $total = $this->getTotalSaleByProducts($arraySale['products']);
        $taxes = floatval($total * ApplicationKeys::PORCENT_TAXES_MEXICO);
        $sale->total = $total;
        $sale->taxes = $taxes;
        $sale->subtotal = floatval($total - $taxes);
        $sale->comments = $arraySale['comments'];
        $sale->total_discount = null;
        $sale->amount_pay = null;

        $sale->save();

        // Guarda las formas de pago
        //$this->savePaymentMethods($sale, $arraySale['paymentMethods']);

        // Crea los detalles de la venta
        $this->createSaleDetails($sale->id, $arraySale);

        return $sale->id;
    }

    private function createPersonalData($arraySale) {
        $personalData = new PersonalData();
        $personalData->name = $arraySale['client']['name'];
        $personalData->last_name = $arraySale['client']['last_name'];

        $personalData->save();

        return $personalData->id;
    }

    private function createLocationData($arraySale) {
        $locationData = new LocationData();
        $locationData->address = $arraySale['client']['address'];
        $locationData->postal_code = $arraySale['client']['postal_code'];
        $locationData->city = $arraySale['client']['city'];
        $locationData->phone = $arraySale['client']['phone'];
        $locationData->cell_phone = $arraySale['client']['cell_phone'];
        $locationData->email = $arraySale['client']['email'];

        $locationData->save();

        return $locationData->id;
    }

    private function createSaleDetails($saleId, $arraySale) {
        foreach ($arraySale['products'] as $product) {
            $saleDetail = new SaleDetail();
            $saleDetail->status_id = StatusKeys::STATUS_ACTIVE;
            $saleDetail->sale_id = $saleId;
            $saleDetail->product_id = $product['id'];
            $saleDetail->quantity = NumberKeys::NUMBER_ONE;
            $saleDetail->product_price = $product['sale_price'];
            $saleDetail->apply_wholesale = null;
            $saleDetail->discount = null;

            $saleDetail->save();
        }
    }

    private function getTotalSaleByProducts($products) {
        $total = NumberKeys::NUMBER_ZERO;
        foreach ($products as $product) {
            $total += (floatval(NumberKeys::NUMBER_ONE) * floatval($product['sale_price']));
        }
        return $total;
    }

    public function findAllSalesByDates($startDate, $endDate, $typeDate) {
        $sql = "SELECT sale.id,sale.status_id,sale.user_id,DATE_FORMAT(sale.created_at, '".ApplicationKeys::PATTERN_FORMAT_DATE."') AS created_at,
        DATE_FORMAT(sale.event_date, '".ApplicationKeys::PATTERN_FORMAT_DATE."') AS event_date,TIME_FORMAT(sale.event_time, '".ApplicationKeys::PATTERN_FORMAT_TIME."') AS event_time,
        sale.subtotal,sale.total_discount,sale.total,sale.comments,
        personal_data.name,personal_data.last_name
        FROM sale
        INNER JOIN client ON sale.client_id = client.id
        INNER JOIN personal_data ON client.personal_data_id = personal_data.id";
        if ($typeDate == 1) {
            $sql.= " WHERE date(sale.created_at) BETWEEN '".$startDate."' AND '".$endDate."'";
        } else {
            $sql.= " WHERE date(sale.event_date) BETWEEN '".$startDate."' AND '".$endDate."'";
        }
        $sql.=" AND sale.status_id != ".StatusKeys::STATUS_INACTIVE."
        ORDER BY sale.event_date,sale.event_time";
        return DB::select($sql);
    }

    public function changeStatusReservation($id, $status_id) {
        $sale = $this->sale->findById($id);
        if(! $sale){
            throw new \Exception("No se encontro la venta");
        }
        $sale->status_id = $status_id;

        $sale->save();
    }

    public function deleteReserva($id) {
        $sale = $this->sale->findById($id);
        if(! $sale){
            throw new \Exception("No se encontro la venta");
        }
        $sale->status_id = StatusKeys::STATUS_INACTIVE;

        $sale->save();
    }
}