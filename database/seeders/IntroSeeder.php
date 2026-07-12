<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventType;
use App\Models\Event;

class IntroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $events = [
            'Wedding','Birthdays','Graduations'
        ];

        foreach ($events as $event) {
        EventType::create([
            "name"=> $event,
        ]);
        }

        Event::create([
    "event_type_id"=> "1",
    "app_name"=>"aa",
    "bride_name"=>"Anlin",
    "groom_name"=>"Abel",
    "wedding_title"=>"Abel & Anlin",
    "background_music"=>"music.mp3",
    "event_date"=>"05-09-2026",
    "cover_image"=>"https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1920&q=80"
      ]);

        
    }
}
