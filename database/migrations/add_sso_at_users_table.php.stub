<?php

use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddSsoAtUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumns('users', ['provider_name', 'provider_id'])){
                $table->string('provider_name')->nullable();
                $table->uuid('provider_id')->nullable();
                $table->text('provider_token')->nullable();
                $table->text('provider_token_expired_at')->nullable();
                $table->text('provider_refresh_token')->nullable();
                $table->text('provider_refresh_token_expired_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'provider_name',
                'provider_id',
                'provider_token',
                'provider_token_expired_at',
                'provider_refresh_token',
                'provider_refresh_token_expired_at'
            ]);
        });
    }
}
