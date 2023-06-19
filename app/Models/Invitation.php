<?php

namespace App\Models;

use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'variables', 'status', 'file', 'preview', 'welcome_message', 'qr_position', 'qr_position_x', 'qr_position_y', 'qr_size'];

    protected $casts = [
        'variables' => 'array',
        'status' => 'boolean'
    ];

    /**
     * Filter categories in admin panel
     * @param \Illuminate\Http\Request  $request
     */
    public function scopeFilter($query, Request $request)
    {
        return $query
            ->when($request->name, function ($builder, $name) {
                return $builder->where('name', 'LIKE', "%$name%");
            })
            ->when($request->search, fn ($builder, $search) => $builder->where('name', 'LIKE', "%$search%"));
    }

    /**
     * Sort in admin panel
     *
     * @param \Illuminate\Http\Request  $request
     */
    public function scopeOrder($query, Request $request)
    {
        return $query->when(
            $request->order,
            function ($builder, $order) use ($request) {
                $direction = $request->dir == 'desc' ? 'DESC' : 'ASC';
                switch ($order) {
                    default:
                        $order = in_array($order, \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable())) ? $order : 'id';
                        return $builder->orderBy($order, $direction);
                        break;
                }
            },
            fn ($builder) => $builder->orderBy('id', 'DESC')
        );
    }

    /**
     * The relation to the invites it has
     */
    public function invites()
    {
        return $this->hasMany(Invite::class);
    }
}
