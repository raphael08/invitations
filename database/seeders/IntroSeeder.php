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
    "app_name"=>"hj",
    "bride_name"=>"Janeth",
    "groom_name"=>"Hans",
    "wedding_title"=>"Hans & Janeth",
    "background_music"=>"music.mp3",
    "event_date"=>"15-11-2026",
    "cover_image"=>"https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1920&q=80"
      ]);

      $sheet = GoogleSheetSetting::create(['event_id'=>1,'spreadsheet_id'=>'https://docs.google.com/spreadsheets/d/e/2PACX-1vSKx_piis4_kPy3obNJrDWVwmPPhGw8rtm2eAGDT-ZiWx72mWC0qTuiSct6cLfX70Otku6dLwYEZI81/pub?output=csv']);

    }
}
