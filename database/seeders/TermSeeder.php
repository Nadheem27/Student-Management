<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
			[
				'name' => 'One',
                'created_at' => now(),
                'updated_at' => now(),
			],[
				'name' => 'Two',
                'created_at' => now(),
                'updated_at' => now(),
			],[
				'name' => 'Third',
                'created_at' => now(),
                'updated_at' => now(),
			]
		);

        Term::insert($data);
    }
}
