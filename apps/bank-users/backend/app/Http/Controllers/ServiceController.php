<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\History;
use App\Models\Service;

use Illuminate\Http\Request;
use Encrypt;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemsPerPage = $request->itemsPerPage ?? 10;
        $skip = ($request->page - 1) * $request->itemsPerPage;

        // Getting all the records
        if (($request->itemsPerPage == -1)) {
            $itemsPerPage =  Service::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $service = Service::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        $service = Encrypt::encryptObject($service, "id");

        $total = Service::counterPagination($search);

        return response()->json([
            "message" => "Registros obtenidos correctamente.",
            "data" => $service,
            "total" => $total,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = new Service;

        $service->name = $request->name;
        $service->amount = $request->amount;

        $service->save();

        return response()->json([
            "message" => "Registro creado correctamente.",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Encrypt::decryptArray($request->all(), 'id');

        $service = Service::where('id', $data['id'])->first();
        $service->name = $request->name;
        $service->amount = $request->amount;

        $service->save();

        return response()->json([
            "message" => "Registro modificado correctamente.",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = Encrypt::decryptValue($request->id);

        Service::where('id', $id)->delete();

        return response()->json([
            "message" => "Registro eliminado correctamente.",
        ]);
    }

    public function payService(Request $request)
    {
        $id = Encrypt::decryptValue($request->service['id']);
        // dd($id);
        $service = Service::find($id);
        // dd($service);

        $sender = Account::where('account_number', $request->sender['account_number'])->first();

        if ($service->amount > $sender->amount) {
            return response()->json([
                "message" => "El monto a enviar es mayor que el saldo disponible en la cuenta.",
                "data" => null,
            ], 400);
        }

        $history = new History();

        $history->concept = "Pago de servicio de $service->name";
        $history->sender_id = auth()->user()->id;
        $history->amount = $service->amount;

        $history->save();

        // Updating the amount history
        $sender->amount -= $service->amount;
        $sender->save();

        return response()->json([
            "message" => "Pago realizado correctamente.",
        ]);
    }
}
