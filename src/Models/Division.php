<?php

namespace PrionDevelopment\Geography\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Division extends Model
{
    use HasFactory;

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
        $this->table = config('prion-geography.database.tables.divisions');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function scopeName(Builder $builder, string $name)
    {
        return $builder->where('name', $name);
    }

    /**
     * @param Builder $builder
     * @param Country|int|string $country
     *
     * @return Builder
     */
    public function scopeCountry(Builder $builder, $country): Builder
    {
        if ($country instanceof Country) {
            return $builder->where('country', $country->id);
        }

        return $builder->where('country', $country);
    }

    public function getCountryNameAttribute()
    {
        return optional($this->country)->name;
    }

    public static function fromNameAndType(string $name, DivisionType $divisionType)
    {
        return Cache::remember("division:name_type:{$name}_{$divisionType->id}", 15, function () use ($name, $divisionType ) {
            return Division::name($name)->where('division_type_id', $divisionType->id)->limit(1)->first();
        });
    }

    public static function fromSlug(string $divisionSlug, Country $country)
    {
        return Cache::remember("division:slug:{$divisionSlug}_{$country->id}", 15, function () use ($divisionSlug, $country ) {
            return Division::slug($divisionSlug)->country($country)->limit(1)->first();
        });
    }
}
