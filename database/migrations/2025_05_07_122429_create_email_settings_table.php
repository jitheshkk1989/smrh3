<?php
// database/migrations/xxxx_xx_xx_create_email_settings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->id();
            $table->string('smtp_host')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('smtp_user')->nullable();
            $table->string('smtp_pass')->nullable();
            $table->string('from_address')->nullable();
            $table->string('from_name')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_settings');
    }
}
