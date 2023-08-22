<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class ClientService
{
    private ClientRepository $repository;

    public function __construct()
    {
        $this->repository = new ClientRepository();
    }

    public function findAll()
    {
        return $this->repository->all();
    }

    public function find(String|int $id)
    {
        $product = $this->repository->find($id);

        if ($product === null) {
            return false;
        }

        return $product;
    }

    public function create($request)
    {
        try {
            return $this->repository->create($request->all())->refresh();

        } catch (ModelNotFoundException $e) {

            Log::error("Error create client, ClientService");

            return false;
        }

    }

    public function update($id, $request)
    {
        $productVerify = $this->find($id);

        if(!$productVerify) {
            return ['Error' => 'Client not found'];
        }

        try {
            return $this->repository->update($id, $request->all())->refresh();

        } catch (ModelNotFoundException $e) {

            Log::warning("Error update client id : {$id}, ClientService");

            return ['Error' => 'failed to update client'];
        }

    }

    public function search(Request $request)
    {
        $clientModel = $this->repository->ClientModel();
        $query =  $clientModel::query();

        if ($request->input('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->input('cpf')) {
            $query->where('cpf', 'like', '%' . $request->input('cpf') . '%');
        }

        if ($request->input('data')) {
            $query->where('data', 'like', '%' . $request->input('data') . '%');
        }

        if ($request->input('sex')) {
            $query->where('sex', 'like', '%' . $request->input('sex') . '%');
        }

        if ($request->input('address')) {
            $query->where('address', 'like', '%' . $request->input('address') . '%');
        }

        if ($request->input('state')) {
            $state = $request->input('state') == 'null' ? '' : $request->input('state');
            $query->where('state', 'like', '%' . $state . '%');
        }

        if ($request->input('city')) {
            $city = $request->input('city') == 'null' ? '' : $request->input('city');
            $query->where('city', 'like', '%' . $city . '%');
        }

        return $query->get();
    }

    public function destroy($id): bool
    {
        $delete = $this->repository->destroy($id);

        if (!$delete) {

            Log::warning("Error delete client id : {$id}, ClientService");

            return false;
        }

        return true;
    }
}
