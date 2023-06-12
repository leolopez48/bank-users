<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\History;
use App\Models\User;

use Illuminate\Http\Request;
use Encrypt;

class HistoryController extends Controller
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
            $itemsPerPage =  History::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $history = History::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        $history = Encrypt::encryptObject($history, "id");

        $total = History::counterPagination($search);

        return response()->json([
            "message" => "Registros obtenidos correctamente.",
            "data" => $history,
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
        $history = new History;

        $receiver = Account::where('account_number', $request->receiver)->first();

        if (is_null($receiver)) {
            return response()->json([
                "message" => "Cuenta de usuario receptor no encontrada.",
                "data" => null,
            ], 400);
        }

        $sender = Account::where('account_number', $request->sender['account_number'])->first();

        if (is_null($sender)) {
            return response()->json([
                "message" => "Cuenta de usuario del emisor no encontrada.",
                "data" => null,
            ], 400);
        }

        if ($request->amount > $sender->amount) {
            return response()->json([
                "message" => "El monto a enviar es mayor que el saldo disponible en la cuenta.",
                "data" => null,
            ], 400);
        }

        $history->concept = $request->concept;
        $history->sender_id = auth()->user()->id;
        $history->receiver_id = $receiver->user_id;
        $history->amount = $request->amount;

        $history->save();

        // Updating the amount history
        $sender->amount -= $request->amount;
        $sender->save();

        // Updating the amount history
        $receiver->amount += $request->amount;
        $receiver->save();

        return response()->json([
            "message" => "Registro creado correctamente.",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\History  history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Encrypt::decryptArray($request->all(), 'id');

        $history = History::where('id', $data['id'])->first();
        $history->concept = $request->concept;
        $history->sender_id = User::where('email', $request->email)->first()->id;
        $history->receiver_id = User::where('email', $request->email)->first()->id;
        $history->amount = $request->amount;
        $history->deleted_at = $request->deleted_at;

        $history->save();

        return response()->json([
            "message" => "Registro modificado correctamente.",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = Encrypt::decryptValue($request->id);

        History::where('id', $id)->delete();

        return response()->json([
            "message" => "Registro eliminado correctamente.",
        ]);
    }


    public function transferHistory()
    {
        $history = History::where('sender_id', auth('api')->user()->id)
            ->orWhere('receiver_id', auth('api')->user()->id)
            ->get()
            ->map(fn ($history) => $history->format());

        return response()->json([
            "message" => "Histórico obtenido correctamente.",
            // 'data' => auth('api')->user(),
            "data" => $history,
        ]);
    }
}
