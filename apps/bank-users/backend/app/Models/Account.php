<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Encrypt;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'account';

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'user_id', 'amount', 'account_number', 'created_at', 'updated_at', 'deleted_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function format()
    {
        $amount = number_format($this->amount, 2);
        return [
            'id' => Encrypt::encryptValue($this->id),
            'name' => $this->user->name,
            'email' => $this->user->email,
            'title' => "$this->account_number ($ $amount)",
            'amount' => $this->amount,
            'account_number' => $this->account_number,
            'created_at' => $this->created_at,
        ];
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Account::select('account.*', 'users.*', 'account.id as id')
            ->join('users', 'account.user_id', '=', 'users.id')
            ->where('email', auth()->user()->email)
            // ->where('account.user_id', 'like', $search)
            // ->orWhere('account.amount', 'like', $search)
            // ->orWhere('users.name', 'like', $search)
            // ->orWhere('users.name', 'like', $search)
            // ->orWhere('users.phone', 'like', $search)

            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("account.$sortBy", $sort)
            ->get()
            ->map(fn ($history) => $history->format());
    }

    public static function counterPagination($search)
    {
        return Account::select('account.*', 'users.*', 'account.id as id')
            ->join('users', 'account.user_id', '=', 'users.id')
            ->where('email', auth()->user()->email)
            // ->where('account.user_id', 'like', $search)
            // ->orWhere('account.amount', 'like', $search)
            // ->orWhere('users.name', 'like', $search)
            // ->orWhere('users.name', 'like', $search)
            // ->orWhere('users.phone', 'like', $search)

            ->count();
    }
}
