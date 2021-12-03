<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTables extends Migration
{
    use \PrionDevelopment\Geography\Traits\DatabaseMigrationTimestamps;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('continents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_full');
            $table->string('iso', 2);
            $table->string('iso_long', 3);
            $table->string('iso_numeric', 3);
            $table->unsignedBigInteger('continent_id')->nullable();

            $table->foreign('continent_id')
                ->references('id')->on('continents')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('country_regions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("Sections of the country containing multiple divisions. For example, Southwest, Northeast, etc");
            $table->unsignedBigInteger('country_id')->nullable();

            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('cascade');
        });

        Schema::create('division_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("State, Territory, Province");
        });

        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbreviation');
            $table->unsignedBigInteger('country_region_id')->nullable();
            $table->unsignedBigInteger('division_type_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();

            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('cascade');
            $table->foreign('country_region_id')
                ->references('id')->on('country_regions')
                ->onDelete('cascade');
            $table->foreign('division_type_id')
                ->references('id')->on('division_type_id')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('locality_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("City, town, etc");
        });

        Schema::create('localities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('locality_type_id')->nullable();

            $table->foreign('division_id')
                ->references('id')->on('divisions')
                ->onDelete('cascade');
            $table->foreign('locality_type_id')
                ->references('id')->on('localities')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('postcodes', function (Blueprint $table) {
            $table->id();
            $table->string('postcode');
            $table->unsignedBigInteger('locality_id')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();

            $table->foreign('locality_id')
                ->references('id')->on('localities')
                ->onDelete('cascade');
            $table->foreign('division_id')
                ->references('id')->on('divisions')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postcodes');
        Schema::dropIfExists('localities');
        Schema::dropIfExists('locality_types');
        Schema::dropIfExists('division_types');
        Schema::dropIfExists('divisions');
        Schema::dropIfExists('country_regions');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('continents');
    }
}
