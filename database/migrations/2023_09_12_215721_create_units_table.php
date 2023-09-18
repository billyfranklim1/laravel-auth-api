<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CORE\{
    UnitGroup,
    UnitType
};

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('unit', 100)->unique();
            $table->string('address', 200)->nullable();
            $table->string('number', 6)->nullable();
            $table->string('complement', 50)->nullable();
            $table->string('neighborhood', 50)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('city', 250)->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('size', 10)->nullable();
            $table->string('cnes', 20)->unique()->nullable();
            $table->string('cnpj', 20)->unique()->nullable();
            $table->string('opening_hours', 100)->nullable();
            $table->boolean('has_psc');
            $table->foreignIdFor(UnitGroup::class)->constrained()->onDelete('NO ACTION');
            $table->foreignIdFor(UnitType::class)->constrained()->onDelete('NO ACTION');
            $table->timestamps(2);
            $table->softDeletes('deleted_at', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
};
