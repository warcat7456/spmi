<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Define the path to your SQL file
        $sqlFakultasPath = database_path('seeds/fakultas-data.sql');
        $sqlJenjangsPath = database_path('seeds/jenjangs-data.sql');
        $sqlProdisPath = database_path('seeds/prodis-data.sql');

        // Check if the file exists
        if (file_exists($sqlFakultasPath)) {
            // Read the SQL file content
            $sqlContentFakultas = file_get_contents($sqlFakultasPath);

            // Execute the SQL statements
            DB::unprepared($sqlContentFakultas);
        } else {
            echo "SQL file not found at $sqlFakultasPath\n";
        }
        // Check if the file exists
        if (file_exists($sqlJenjangsPath)) {
            // Read the SQL file content
            $sqlContentJenjangs = file_get_contents($sqlJenjangsPath);

            // Execute the SQL statements
            DB::unprepared($sqlContentJenjangs);
        } else {
            echo "SQL file not found at $sqlJenjangsPath\n";
        }
        // Check if the file exists
        if (file_exists($sqlFakultasPath) && file_exists($sqlJenjangsPath) && file_exists($sqlProdisPath)) {
            // Read the SQL file content
            $sqlContentProdis = file_get_contents($sqlProdisPath);

            // Execute the SQL statements
            DB::unprepared($sqlContentProdis);
        } else {
            echo "SQL file not found at $sqlProdisPath\n";
        }
    }
}
