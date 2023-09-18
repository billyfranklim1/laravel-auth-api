<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\{
    CORE\User,
    CORE\Unit,
    Webclin\Patient
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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique();
            $table->foreignIdFor(Patient::class)->constrained()->onDelete('NO ACTION');
            $table->foreignIdFor(User::class)->constrained()->onDelete('NO ACTION');
            $table->foreignIdFor(Unit::class)->constrained()->onDelete('NO ACTION');
            $table->timestamps(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_records');
    }
};
