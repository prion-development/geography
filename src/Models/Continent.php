<?php

namespace PrionDevelopment\Geography\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Continent extends Model
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
        $this->table = config('prion-geography.database.tables.continents');
    }

    /**
     * @param Builder $query
     * @param string $continent
     *
     * @return Builder
     */
    public function scopeContinent(Builder $query, string $continent)
    {
        $continent = $this->formatContinent($continent);
        return $query->where('name', $continent);
    }

    public static function getContinent(string $continent)
    {
        $continent = (new Continent)->formatContinent($continent);

        if (! config('prion-geography.use_cache')) {
            return Continent::continent($continent)->limit(1)->first();
        }

        /** @var $cache Cache */
        $cache = app('cache');
        $key = 'continent:string:' . $continent;
        $ttl = config('prion-geography.cache_ttl');

        return Cache::remember($key, $ttl, function () use ($continent) {
            return Continent::continent($continent)->limit(1)->first();
        });
    }

    public function formatContinent(string $continent): ?string
    {
        $continent = strtolower($continent);
        $continent = ucwords($continent);
        return $continent;
    }
}
