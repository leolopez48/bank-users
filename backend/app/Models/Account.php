<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'account';

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'user_id', 'amount', 'created_at', 'updated_at', 'deleted_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Account::select('account.*', 'users.*', 'account.id as id')
        ->join('users', 'account.user_id', '=', 'users.id')

		->where('account.user_id', 'like', $search)
		->orWhere('account.amount', 'like', $search)
		->orWhere('users.name', 'like', $search)
		->orWhere('users.name', 'like', $search)
		->orWhere('users.phone', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("account.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return Account::select('account.*', 'users.*', 'account.id as id')
        ->join('users', 'account.user_id', '=', 'users.id')

		->where('account.user_id', 'like', $search)
		->orWhere('account.amount', 'like', $search)
		->orWhere('users.name', 'like', $search)
		->orWhere('users.name', 'like', $search)
		->orWhere('users.phone', 'like', $search)

        ->count();
    }
}
