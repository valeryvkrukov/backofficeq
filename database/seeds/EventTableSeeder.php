<?php

use App\Helpers\Nric;
use App\Models\Event\Event;
use App\Models\Event\EventLanguage;
use App\Models\Event\EventRole;
use App\Models\Event\EventStatus;
use App\Models\Event\EventType;
use App\Models\Event\MemberSSA;
use App\Models\Event\Participant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventTypeNames = ['Culture', 'Meeting', 'Study'];
        $eventTypes = [];
        $eventRoles = [];
        $eventRolesList = [
            ['value' => 'Performer', 'abbv' => 'PFR'],
            ['value' => 'Trainer', 'abbv' => 'DISP'],
            ['value' => 'Chief Trainer', 'abbv' => 'DISP'],
            ['value' => 'Assistant Chief Trainer', 'abbv' => 'DISP'],
            ['value' => 'Cheorographer', 'abbv' => 'DISP'],
            ['value' => 'Assistant Cheorographer', 'abbv' => 'DISP'],
            ['value' => 'Display IC', 'abbv' => 'DISP'],
            ['value' => 'Admin', 'abbv' => 'ADM'],
            ['value' => 'Admin IC', 'abbv' => 'ADM'],
            ['value' => 'Staff Support', 'abbv' => 'ADM'],
            ['value' => 'Logistic', 'abbv' => 'LOG'],
            ['value' => 'Logistics IC', 'abbv' => 'LOG'],
            ['value' => 'Chairperson', 'abbv' => 'CCM'],
            ['value' => 'Assistant Chairperson', 'abbv' => 'CCM'],
            ['value' => 'Security'],
            ['value' => 'Security IC'],
            ['value' => 'Medical', 'abbv' => 'MED'],
            ['value' => 'Medical IC', 'abbv' => 'MED'],
            ['value' => 'Hospitality', 'abbv' => 'HOS'],
            ['value' => 'Hospitality IC', 'abbv' => 'HOS'],
            ['value' => 'Others'],
            ['value' => 'Participant'],
        ];
        $languages = [];
        $statuses = [];

        foreach (['en' => 'English', 'zh' => 'Chinese'] as $code => $lang) {
            $languages[] = EventLanguage::create([
                'code' => $code,
                'value' => $lang,
            ]);
        }

        foreach (['Processing', 'Accepted', 'Rejected', 'Reserved', 'Pending', 'Withdrawn'] as $status) {
            $statuses[] = EventStatus::create([
                'code' => strtolower($status),
                'value' => $status
            ]);
        }

        foreach ($eventTypeNames as $type) {
            $eventTypes[] = EventType::create([
                'code' => strtolower($type),
                'value' => $type,
            ]);
        }

        foreach ($eventRolesList as $code => $role) {
            $eventRoles[] = EventRole::create([
                'code' => str_replace(' ', '-', strtolower($role['value'])),
                'value' => $role['value'],
                'abbv' => isset($role['abbv']) ? $role['abbv'] : null,
            ]);
        }

        $faker = Faker\Factory::create();
        $languages = collect($languages);
        $statuses = collect($statuses);
        $types = collect($eventTypes);
        $eventRoles = collect($eventRoles);
        $members = MemberSSA::all();

        foreach ($members as $member) {
            $date = $faker->dateTimeBetween('-2 months', '+6 months');
            $event = Event::create([
                'uniquecode' => $faker->uuid,
                'eventdate' => $date,
                'name' => $faker->catchPhrase,
                'description' => $faker->realText(100),
                'pdpanric' => $faker->boolean(50),
                'pdpatelmobileemail' => $faker->boolean(50),
                'pdpaaddress' => $faker->boolean(50),
                'memregistration' => $faker->boolean(50),

                // TEMPORARY
                'location' => '',
                'createby' => '',
            ]);

            $participants = [];
            $_members = $members->random($faker->numberBetween(10, 15));
            foreach ($_members as $_member) {
                $participant = $_member->participant()->create([
                    'uniquecode' => $faker->uuid,
                ]);
                $eventRoles->random()->save([$participant->id]);
                $participants[] = $participant->id;
            }
            $statuses->random()->save([$event->id]);
            $event->eventLang()->attach($languages->random()->id);
            $event->eventType()->attach($types->random()->id);
            $event->participants()->sync($participants);
        }

        Log::info("[Migration - Seeding] Event table seeded!");
    }
}
