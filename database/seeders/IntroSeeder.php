<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventType;
use App\Models\Event;
use App\Models\GoogleSheetSetting;

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

      $sheet = GoogleSheetSetting::create(['event_id'=>1,'spreadsheet_id'=>'https://docs.google.com/spreadsheets/d/e/2PACX-1vTnZ2x_0RY84rQCBh0370B2FLYKvJ3Yi38Ae_eaReMOu-y4sMDvpW5IFwjSBrjc3vif4SGlGq_zLi5S/pub?gid=1493156283&single=true&output=csv']);

    }
}
