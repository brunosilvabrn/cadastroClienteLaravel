<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    protected Client $model;

    public function __construct()
    {
        $this->model = new Client();
    }

    public function ClientModel()
    {
        return $this->model;
    }

    public function all()
    {
        return $this->model->all();
    }


    public function find(String|int $id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $client = $this->find($id);
        $client->update($data);

        return $client->refresh();
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }
}
