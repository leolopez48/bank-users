<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;

use Illuminate\Http\Request;
use Encrypt;
use Str;

class AccountController extends Controller
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
            $itemsPerPage =  Account::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $account = Account::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        // $account = Encrypt::encryptObject($account, "id");

        $total = Account::counterPagination($search);

        return response()->json([
            "message" => "Registros obtenidos correctamente.",
            "data" => $account,
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
        $account = new Account;

        $account->user_id = auth()->user()->id;
        $account->amount = $request->amount;

        $accountExists = true;
        do {
            // Random number of 16 digits
            $randomAccount = mt_rand(pow(10, 15), pow(10, 16) - 1);

            if (is_null(Account::where('account_number', $randomAccount)->first())) {
                $account->account_number = $randomAccount;
                $accountExists = false;
            }
        } while ($accountExists);

        $account->save();

        return response()->json([
            "message" => "Registro creado correctamente.",
        ]);
    }

    public function generateAccount()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Encrypt::decryptArray($request->all(), 'id');

        $account = Account::where('id', $data['id'])->first();
        $account->user_id = User::where('email', $request->email)->first()->id;
        $account->amount = $request->amount;
        $account->deleted_at = $request->deleted_at;

        $account->save();

        return response()->json([
            "message" => "Registro modificado correctamente.",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = Encrypt::decryptValue($request->id);

        Account::where('id', $id)->delete();

        return response()->json([
            "message" => "Registro eliminado correctamente.",
        ]);
    }
}
