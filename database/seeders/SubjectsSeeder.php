<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'name' => 'Mathematics',
                'description' => 'Algebra, Calculus, Geometry, Statistics, and other mathematical concepts'
            ],
            [
                'name' => 'Physics',
                'description' => 'Mechanics, Thermodynamics, Electromagnetism, Quantum Physics, and more'
            ],
            [
                'name' => 'Chemistry',
                'description' => 'Organic, Inorganic, Physical Chemistry, and Biochemistry'
            ],
            [
                'name' => 'Biology',
                'description' => 'Cell Biology, Genetics, Ecology, Human Biology, and Life Sciences'
            ],
            [
                'name' => 'English',
                'description' => 'Literature, Grammar, Writing, Reading Comprehension, and Language Arts'
            ],
            [
                'name' => 'Computer Science',
                'description' => 'Programming, Data Structures, Algorithms, Software Development'
            ],
            [
                'name' => 'History',
                'description' => 'World History, Local History, Historical Analysis, and Social Studies'
            ],
            [
                'name' => 'Geography',
                'description' => 'Physical Geography, Human Geography, Maps, and Environmental Studies'
            ],
            [
                'name' => 'Economics',
                'description' => 'Microeconomics, Macroeconomics, Business Studies, and Finance'
            ],
            [
                'name' => 'Psychology',
                'description' => 'Cognitive Psychology, Social Psychology, Developmental Psychology'
            ],
            [
                'name' => 'Art',
                'description' => 'Drawing, Painting, Digital Art, Art History, and Creative Expression'
            ],
            [
                'name' => 'Music',
                'description' => 'Music Theory, Instrument Lessons, Composition, and Music History'
            ],
            [
                'name' => 'French',
                'description' => 'French Language, Grammar, Conversation, and Literature'
            ],
            [
                'name' => 'Spanish',
                'description' => 'Spanish Language, Grammar, Conversation, and Literature'
            ],
            [
                'name' => 'Arabic',
                'description' => 'Arabic Language, Grammar, Conversation, and Literature'
            ],
            [
                'name' => 'Philosophy',
                'description' => 'Logic, Ethics, Metaphysics, and Critical Thinking'
            ],
            [
                'name' => 'Sociology',
                'description' => 'Social Theory, Research Methods, and Social Issues'
            ],
            [
                'name' => 'Political Science',
                'description' => 'Government, International Relations, and Political Theory'
            ]
        ];

        foreach ($subjects as $subject) {
            Subject::firstOrCreate(
                ['name' => $subject['name']],
                ['description' => $subject['description']]
            );
        }
    }
}
