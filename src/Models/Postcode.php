<?php

namespace PrionDevelopment\Geography\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postcode extends Model
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
        $this->table = config('prion-geography.database.tables.postcodes');
    }

    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function country(): BelongsTo
    {
        return $this->division()->first()->country();
    }

    /**
     * Pull the
     *
     * @return string|null
     */
    public function getCountryNameAttribute(): ?string
    {
        return optional($this->division)->country->name;
    }

    public function getDivisionNameAttribute(): ?string
    {
        return optional($this->division)->name;
    }
}
