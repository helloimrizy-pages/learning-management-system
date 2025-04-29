<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subject;
use App\Models\Task;

class LmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $teacher1 = User::factory()->create([
            'name' => 'Horvath Gyozo',
            'email' => 'horvathgyozo@example.com',
            'password' => bcrypt('password'),
            'role' => 'teacher'
        ]);
    
        $teacher2 = User::factory()->create([
            'name' => 'Gregory Morse',
            'email' => 'gregorymorse@example.com',
            'password' => bcrypt('password'),
            'role' => 'teacher'
        ]);
    
        $subject1 = Subject::create([
            'user_id' => $teacher1->id,
            'name' => 'Advanced Web Programming',
            'description' => 'Advanced topics in web programming, e.g., Laravel',
            'code' => 'IP-24fKVHWPEG',
            'credit' => 5,
        ]);
    
        $subject2 = Subject::create([
            'user_id' => $teacher2->id,
            'name' => 'Concurrent Programming',
            'description' => 'Concurrent vs parallel programming principles with Java',
            'code' => 'IP-18fKPROGEG',
            'credit' => 3,
        ]);
    
        Task::create([
            'subject_id' => $subject1->id,
            'name' => 'Server-side Home Project (Laravel)',
            'description' => 'Your task is to implement needed functions for learning management system (LMS).',
            'points' => 60,
        ]);
    
        Task::create([
            'subject_id' => $subject2->id,
            'name' => 'Assignment 1',
            'description' => 'Your task is to implement a multithreaded counter.',
            'points' => 10,
        ]);
    }
}
