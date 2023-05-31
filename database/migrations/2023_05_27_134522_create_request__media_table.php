<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

            Schema::create('request__media', function (Blueprint $table) {
                $table->id();
                $table->boolean('is_approved')->nullable();

                $table->foreignId('sender')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();


                $table->foreignId('reciever')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('request__media');
        }
    };
