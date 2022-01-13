<?php

namespace PrionDevelopment\Geography\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class DivisionType extends Model
{
    use HasFactory;

    /** @var bool */
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('prion-geography.database.tables.division_types');
    }


    public function scopeName(Builder $builder, $divisionType): Builder
    {
        return $builder->where('name', $divisionType);
    }

    /**
     * Pull a Division Type from a String
     *
     * @param $divisionType
     *
     * @return DivisionType
     */
    public static function fromName($divisionType): DivisionType
    {
        return Cache::remember("division_type:name:{$divisionType}", 15, function () use ($divisionType) {
            return DivisionType::name($divisionType)->limit(1)->first();
        });
    }
}
