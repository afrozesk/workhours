<?php

use App\Models\EmployeeModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateEmployee.
 */
class CreateEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create((new EmployeeModel())->getTable(), function (Blueprint $table): void {
            $table->id()
                  ->comment('employee id');

            $table->string('name')
                  ->comment('employee name');

            $table->string('email')
                  ->unique()
                  ->comment('employee email unique');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists((new EmployeeModel())->getTable());
    }
}
