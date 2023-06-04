<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'service';

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'name', 'amount', 'created_at', 'updated_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Service::select('service.*', 'service.id as id')
        
		->where('service.name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("service.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return Service::select('service.*', 'service.id as id')
        
		->where('service.name', 'like', $search)

        ->count();
    }
}
