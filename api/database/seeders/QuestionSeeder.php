<?php

namespace Database\Seeders;

use App\Models\Question;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $this->truncate('questions');

        $questionsCategoriesGroup = include(database_path('data/initial_questions.php'));

        foreach ($questionsCategoriesGroup as $category) {
            foreach ($category as $question => $field) {
                Question::create([
                    'question' => $field['question'],
                    'answer' => $field['answer'],
                    'opt_1' => $field['opt_1'],
                    'opt_2' => $field['opt_2'],
                    'opt_3' => $field['opt_3'],
                    'category_id' => $field['category_id'],
                    'score' => $field['score']
                ]);
            }
        }

        $this->enableForeignKeys();
    }
}
