<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    private function rulesValidate(Request $request): \Illuminate\Validation\Validator
    {
        return validator::make($request->all(), [
            'name'         => ['string', 'required'],
            'cpf'          => ['string', 'required'],
            'data'         => ['date', 'required'],
            'sex'          => ['string', 'required'],
            'address'      => ['string', 'required'],
            'state'        => ['string', 'required'],
            'UF'           => ['string', 'required'],
            'city'         => ['string', 'required'],
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('search');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ClientService $service, Request $request): JsonResponse
    {
        $validate = $this->rulesValidate($request);

        if ($validate->fails()) {
            return response()->json(['Error' => $validate->errors()], 422);
        }

        $create = $service->create($request);

        if (!$create) {
            return response()->json(['Error' => 'failed to create client'], 500);
        }

        return response()->json($create, 201);
    }

    public function list(ClientService $service): JsonResponse
    {
        $clients = $service->findAll();
        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('cadastrar');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientService $service, $id)
    {
        $client = $service->find($id);

        return response()->json($client);
    }

    public function search(ClientService $service,Request $request)
    {
        $results = $service->search($request);

        return response()->json($results);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, ClientService $service)
    {
        $validate = $this->rulesValidate($request);

        if ($validate->fails()) {
            return response()->json(['Error' => $validate->errors()], 422);
        }

        $edit = $service->update($id, $request);

        if (isset($edit['Error'])) {
            return response()->json(['Error' => $edit['Error']], 500);
        }

        return response()->json([$edit]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientService $service, $id)
    {
        $delete = $service->destroy($id);

        if (!$delete) {
            return response()->json(['Error' => 'Error deleting client'], 500);
        }

        return response()->json(['Success' => 'Client deleted successfully'], 201);
    }
}
