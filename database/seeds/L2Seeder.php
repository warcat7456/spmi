<?php

use Illuminate\Database\Seeder;

class L2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the path to your SQL file
        $sqlFilePath = database_path('seeds/l2_s-data.sql');

        // Check if the file exists
        if (file_exists($sqlFilePath)) {
            // Read the SQL file content
            $sqlContent = file_get_contents($sqlFilePath);

            // Execute the SQL statements
            DB::unprepared($sqlContent);
        } else {
            echo "SQL file not found at $sqlFilePath\n";
        }
    }
}
