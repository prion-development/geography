<?php

namespace PrionDevelopment\Geography\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Country extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *f
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
        $this->table = config('prion-geography.database.tables.countries');
    }

    public function scopeName(Builder $builder, string $name): Builder
    {
        return $builder->where('name', $name);
    }

    public function scopeIso(Builder $builder, string $iso): Builder
    {
        return $builder->where('iso', $iso);
    }

    public function scopeSlug(Builder $builder, string $slug): Builder
    {
        return $builder->where('slug', $slug);
    }

    /**
     * Pull a Country from a String
     *
     * @param $iso
     *
     * @return \App\Models\Address\Country
     */
    public static function fromIso($iso): Country
    {
        return Cache::remember("country:iso:{$iso}", 15, function () use ($iso) {
            return Country::iso($iso)->limit(1)->first();
        });
    }

    /**
     * Pull a Country from Slug
     *
     * @param $iso
     *
     * @return Country
     */
    public static function fromSlug($slug): Country
    {
        return Cache::remember("country:slug:{$slug}", 15, function () use ($slug) {
            return Country::slug($slug)->limit(1)->first();
        });
    }
}
