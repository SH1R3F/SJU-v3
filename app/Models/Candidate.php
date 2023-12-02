<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['candidate_id'];


    public function scopeFilter($query, Request $request)
    {
        return $query
            // Filter Full Name [ar, en]
            ->when($request->name, function ($builder, $name) {
                return $builder->whereHas('candidate', function ($query) use ($name) {
                    return $query
                        ->where(DB::raw("CONCAT(IFNULL(CONCAT(fname_ar, ' '), ''), IFNULL(CONCAT(sname_ar, ' '), ''), IFNULL(CONCAT(tname_ar, ' '), ''), lname_ar)"), 'LIKE', "%$name%")
                        ->orWhere(DB::raw("CONCAT(IFNULL(CONCAT(fname_en, ' '), ''), IFNULL(CONCAT(sname_en, ' '), ''), IFNULL(CONCAT(tname_en, ' '), ''), lname_en)"), 'LIKE', "%$name%");
                });
            });
    }

    public function scopeOrder($query, Request $request)
    {
        return $query->when(
            $request->order,
            function ($builder, $order) use ($request) {
                $direction = $request->dir == 'desc' ? 'DESC' : 'ASC';
                switch ($order) {
                    case 'candidate':
                        return $builder->orderBy(function ($q) {
                            return $q->from('members')
                                ->whereRaw("`candidates`.candidate_id = `members`.id")
                                ->selectRaw(
                                    app()->getLocale() == 'ar' ?
                                        "CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar)" :
                                        "CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en)"
                                );
                        }, $direction);
                        break;
                    case 'votes':
                        return $builder->orderBy(function ($q) {
                            return $q->from('votes')
                                ->whereRaw("`votes`.candidate_id = `candidates`.id")
                                ->selectRaw('COUNT(id)');
                        }, $direction);
                        break;
                    default:
                        $order = in_array($order, \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable())) ? $order : 'id';
                        return $builder->orderBy($order, $direction);
                        break;
                }
            },
            fn ($builder) => $builder->orderBy('created_at', 'DESC')
        );
    }

    public function candidate()
    {
        return $this->belongsTo(Member::class, 'candidate_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
