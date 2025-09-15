<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FixUsersLevelEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Delete users with Manager or Teknisi level
        DB::statement("DELETE FROM users WHERE level IN ('Manager', 'Teknisi')");
        
        // Change column to VARCHAR temporarily
        DB::statement("ALTER TABLE users MODIFY COLUMN level VARCHAR(20) NOT NULL");
        
        // Update any remaining invalid values to Admin
        DB::statement("UPDATE users SET level = 'Admin' WHERE level NOT IN ('Admin', 'Superadmin')");
        
        // Change back to ENUM with only Admin and Superadmin
        DB::statement("ALTER TABLE users MODIFY COLUMN level ENUM('Admin', 'Superadmin') NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Restore original enum
        DB::statement("ALTER TABLE users MODIFY COLUMN level ENUM('Admin', 'Manager', 'Teknisi', 'Superadmin') NOT NULL");
    }
}