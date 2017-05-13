<?php

use Illuminate\Database\Seeder;

class AddSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$skill_array = ['C', 'C++', 'C#', 'PHP'];
    	foreach($skill_array as $skill){
    		$new_skill = \App\ProgrammingLanguage::firstOrNew(['name' => $skill]);
    		$new_skill->save();
    	}

    }
}
