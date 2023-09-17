<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'allow_guests'];

    public function scopeFilter($query, Request $request)
    {
        return $query
            ->when($request->name, fn ($builder, $name) => $builder->where('name', "LIKE", "%$name%"))
            ->when($request->status, fn ($builder, $status) => $builder->where('status', $status));
    }

    public function scopeOrder($query, Request $request)
    {
        return $query->when(
            $request->order,
            function ($builder, $order) use ($request) {
                $direction = $request->dir == 'desc' ? 'DESC' : 'ASC';
                switch ($order) {
                    // Here you can add custom logic cases
                    default:
                        $order = in_array($order, \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable())) ? $order : 'id';
                        return $builder->orderBy($order, $direction);
                        break;
                }
            },
            fn ($builder) => $builder->orderBy('created_at', 'DESC')
        );
    }

    public function fields()
    {
        return $this->hasMany(CompetitionField::class);
    }


    public function submissions()
    {
        return $this->hasMany(CompetitionSubmittion::class);
    }
}
