<?php
/**
 * User: ricardo
 * Date: 23/04/18
 * Time: 07:40 PM
 */

namespace App\Repository\client;


interface ClientInterface {

    public function findAllClients();

    public function createClient($clientValues);

    public function updateClient($clientValues);

    public function deleteClient($id);

}