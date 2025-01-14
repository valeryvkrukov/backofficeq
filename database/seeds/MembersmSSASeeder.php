<?php

use Illuminate\Database\Seeder;

class MembersmSSASeeder extends Seeder
{
    public function run()
    {
        factory(App\Models\MembersmSSA::class, 500)->create();

        Log::notice("[Migration - Seeding] SSA Members (Dummy Data) successfully seeded!");
    }
}
