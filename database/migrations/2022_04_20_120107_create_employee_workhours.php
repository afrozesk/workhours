<?php

use App\Models\EmployeeModel;
use App\Models\EmployeeWorkHoursModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateEmployeeWorkhours.
 */
class CreateEmployeeWorkhours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create((new EmployeeWorkHoursModel())->getTable(), function (Blueprint $table): void {
            $table->integer('employee_id')
                  ->unsigned()
                  ->comment('employee id');

            $table->date('date')
                  ->comment('shift date');

            $table->tinyInteger('start_hour')
                  ->comment('shift start hour');

            $table->tinyInteger('end_hour')
                  ->comment('shift end hour');

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
        Schema::dropIfExists((new EmployeeWorkHoursModel())->getTable());
    }
}
