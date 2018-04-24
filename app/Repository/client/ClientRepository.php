<?php
/**
 * User: ricardo
 * Date: 23/04/18
 * Time: 07:40 PM
 */

namespace App\Repository\client;


use App\Models\Client;
use App\Models\LocationData;
use App\Models\PersonalData;
use App\Utils\Keys\common\StatusKeys;
use Illuminate\Support\Facades\DB;

class ClientRepository implements ClientInterface {

    private $client;

    function __construct(Client $client) {
        $this->client = $client;
    }

    public function findAllClients() {
        return DB::select('SELECT client.id,personal_data.name,personal_data.last_name,location_data.address,location_data.city as colonia,
        location_data.phone,location_data.cell_phone,location_data.email
        FROM client
        INNER JOIN location_data ON client.location_data_id = location_data.id
        INNER JOIN personal_data ON client.personal_data_id = personal_data.id
        WHERE client.status_id = 1');
    }

    public function createClient($clientValues) {
        $location_data = new LocationData();
        $location_data->address = $clientValues['address'];
        $location_data->city = $clientValues['colonia'];
        $location_data->phone = $clientValues['phone'];
        $location_data->cell_phone = $clientValues['cell_phone'];
        $location_data->email = $clientValues['email'];

        $location_data->save();

        $personal_data = new PersonalData();

        $personal_data->name = $clientValues['name'];
        $personal_data->last_name = $clientValues['last_name'];

        $personal_data->save();

        $client = new Client();
        $client->status_id = StatusKeys::STATUS_ACTIVE;
        $client->personal_data_id = $personal_data->id;
        $client->location_data_id = $location_data->id;

        $client->save();

        return $client->id;
    }

    public function updateClient($clientValues) {
        $client = $this->client->findById($clientValues['id']);
        if (!$client) {
            throw new \Exception("El cliente no se encontro");
        }
        $client->locationData->address = $clientValues['address'];
        $client->locationData->city = $clientValues['colonia'];
        $client->locationData->phone = $clientValues['phone'];
        $client->locationData->cell_phone = $clientValues['cell_phone'];
        $client->locationData->email = $clientValues['email'];

        $client->personalData->name = $clientValues['name'];
        $client->personalData->last_name = $clientValues['last_name'];

        $client->push();
    }

    public function deleteClient($id) {
        $client = $this->client->findById($id);
        if (!$client) {
            throw new \Exception("El cliente no se encontro");
        }
        $client->status_id = StatusKeys::STATUS_INACTIVE;

        $client->save();
    }

}