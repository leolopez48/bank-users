<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Encrypt;

class History extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'history';

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'concept', 'sender_id', 'receiver_id', 'amount', 'created_at', 'updated_at', 'deleted_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function format()
    {
        return [
            'id' => Encrypt::encryptValue($this->id),
            'concept' => $this->concept,
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return History::select('history.*', 'users.*', 'users.*', 'history.id as id')
            ->join('users', 'history.sender_id', '=', 'users.id')
            ->where('sender_id', auth()->user()->id)
            ->orWhere('receiver_id', auth()->user()->id)
            // ->where('history.concept', 'like', $search)
            // ->orWhere('history.sender_id', 'like', $search)
            // ->orWhere('history.receiver_id', 'like', $search)
            // ->orWhere('history.amount', 'like', $search)
            // ->orWhere('users.name', 'like', $search)
            // ->orWhere('users.email', 'like', $search)
            // ->orWhere('users.phone', 'like', $search)

            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("history.$sortBy", $sort)
            ->get();
    }

    public static function counterPagination($search)
    {
        return History::select('history.*', 'users.*', 'users.*', 'history.id as id')
            ->join('users', 'history.sender_id', '=', 'users.id')

            ->where('history.concept', 'like', $search)
            ->orWhere('history.sender_id', 'like', $search)
            ->orWhere('history.receiver_id', 'like', $search)
            ->orWhere('history.amount', 'like', $search)
            ->orWhere('users.name', 'like', $search)
            ->orWhere('users.email', 'like', $search)
            ->orWhere('users.phone', 'like', $search)

            ->count();
    }
}
