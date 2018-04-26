<?php
/**
 * User: ricardo
 * Date: 24/04/18
 * Time: 08:18 PM
 */

namespace App\Repository\sale;


use App\Models\Sale;
use App\Utils\Keys\common\ApplicationKeys;
use App\Utils\Keys\common\StatusKeys;
use Illuminate\Support\Facades\DB;

class SaleRepository implements SaleInterface {

    private $sale;

    function __construct(Sale $sale) {
        $this->sale = $sale;
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
}