<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function rules($id = '')
    {
        return [
            'name' => "required|min:3|max:100|unique:products,name,{$id},id",
            'description' => 'required|min:3|max:1500',
        ];
    }

    public function rulesSearch()
    {
        return [
            'key-search' => 'required',
        ];
    }

    public function search($data, $totalPage)
    {
        return $this->where('name', $data['key-search'])
                        ->orWhere('description', 'LIKE', "%{$data['key-search']}%")
                        ->paginate($totalPage);
    }

}
