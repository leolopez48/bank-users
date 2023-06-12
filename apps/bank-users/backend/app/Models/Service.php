<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encrypt;

class Service extends Model
{
    use HasFactory;

    protected $table = 'service';

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'name', 'amount', 'created_at', 'updated_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    public function format()
    {
        return [
            'id' => Encrypt::encryptValue($this->id),
            'name' => $this->name,
            'amount' => $this->amount,
        ];
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Service::select('service.*', 'service.id as id')
            ->where('service.name', 'like', $search)
            ->orWhere('service.amount', 'like', $search)
            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("service.$sortBy", $sort)
            ->get();
    }

    public static function counterPagination($search)
    {
        return Service::select('service.*', 'service.id as id')
            ->where('service.name', 'like', $search)
            ->orWhere('service.amount', 'like', $search)

            ->count();
    }
}
