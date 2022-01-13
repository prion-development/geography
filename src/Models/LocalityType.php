<?php

namespace PrionDevelopment\Geography\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LocalityType extends Model
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
        $this->table = config('prion-geography.database.tables.locality_types');
    }

    public function scopeName(Builder $builder, string $name)
    {
        return $builder->where('name', $name);
    }

    /**
     * Pull a Locality Type from a String
     *
     * @param $iso
     *
     * @return LocalityType
     */
    public static function fromName($name): LocalityType
    {
        return Cache::remember("locality_type:name:{$name}", 15, function () use ($name) {
            $localityType = LocalityType::name($name)->limit(1)->first();

            if (empty($localityType)) {
                $localityType = LocalityType::create([
                    'name' => $name
                ]);
            }

            return $localityType;
        });
    }
}
