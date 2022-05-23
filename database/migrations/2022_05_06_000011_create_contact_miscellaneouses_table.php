<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactMiscellaneousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_miscellaneouses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contact_id');
            $table->string('firstcontact')->nullable();
            $table->string('customernumber')->nullable();
            $table->date('weddingdate')->nullable();
            $table->string('commonsurname')->nullable();
            $table->string('knownby')->nullable();
            $table->string('language')->nullable();
            $table->string('publication_rights')->nullable();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
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
        Schema::dropIfExists('contact_miscellaneouses');
    }
}
