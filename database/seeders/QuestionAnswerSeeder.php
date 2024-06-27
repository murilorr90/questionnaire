<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questionsAnswers = [
            [
                'name' => 'Do you have difficulty getting or maintaining an erection?',
                'answers' => [
                    ['name' => 'Yes', 'next_question_id' => 2],
                    ['name' => 'No', 'exclude_products' => [1, 2, 3, 4]]
                ]
            ],
            [
                'name' => 'Have you tried any of the following treatments before?',
                'answers' => [
                    ['name' => 'Viagra or Sildenafil', 'next_question_id' => 3],
                    ['name' => 'Cialis or Tadalafil', 'next_question_id' => 4],
                    ['name' => 'Both', 'next_question_id' => 5],
                    ['name' => 'None of the above', 'exclude_products' => [2, 4]]
                ]
            ],
            [
                'name' => 'Was the Viagra or Sildenafil product you tried before effective?',
                'answers' => [
                    ['name' => 'Yes', 'next_question_id' => 6, 'exclude_products' => [2, 3, 4]],
                    ['name' => 'No', 'next_question_id' => 6, 'exclude_products' => [1, 2, 3]]
                ]
            ],
            [
                'name' => 'Was the Cialis or Tadalafil product you tried before effective?',
                'answers' => [
                    ['name' => 'Yes', 'next_question_id' => 6, 'exclude_products' => [1, 2, 4]],
                    ['name' => 'No', 'next_question_id' => 6, 'exclude_products' => [1, 3, 4]]
                ]
            ],
            [
                'name' => 'Which is your preferred treatment?',
                'answers' => [
                    ['name' => 'Viagra or Sildenafil', 'next_question_id' => 6, 'exclude_products' => [1, 3, 4]],
                    ['name' => 'Cialis or Tadalafil', 'next_question_id' => 6, 'exclude_products' => [1, 2, 3]],
                    ['name' => 'None of the above', 'next_question_id' => 6, 'exclude_products' => [1, 3]]
                ]
            ],
            [
                'name' => 'Do you have, or have you ever had, any heart or neurological conditions?',
                'answers' => [
                    ['name' => 'Yes', 'exclude_products' => [1, 2, 3, 4]],
                    ['name' => 'No', 'next_question_id' => 7]
                ]
            ],
            [
                'name' => 'Do any of the listed medical conditions apply to you?',
                'answers' => [
                    ['name' => 'Significant liver problems (such as cirrhosis of the liver) or kidney problems', 'exclude_products' => [1, 2, 3, 4]],
                    ['name' => 'Currently prescribed GTN, Isosorbide mononitrate, Isosorbide dinitrate , Nicorandil (nitrates) or Rectogesic ointment', 'exclude_products' => [1, 2, 3, 4]],
                    ['name' => 'Abnormal blood pressure (lower than 90/50 mmHg or higher than 160/90 mmHg)', 'exclude_products' => [1, 2, 3, 4]],
                    ['name' => 'Condition affecting your penis (such as Peyronie\'s Disease, previous injuries or an inability to retract your foreskin)', 'exclude_products' => [1, 2, 3, 4]],
                    ['name' => 'I don\'t have any of these conditions', 'next_question_id' => 8]
                ]
            ],
            [
                'name' => 'Are you taking any of the following drugs?',
                'answers' => [
                    ['name' => 'Alpha-blocker medication such as Alfuzosin, Doxazosin, Tamsulosin, Prazosin, Terazosin or over-the-counter Flomax', 'exclude_products' => [1, 2, 3, 4]],
                    ['name' => 'Riociguat or other guanylate cyclase stimulators (for lung problems)', 'exclude_products' => [1, 2, 3, 4]],
                    ['name' => 'Saquinavir, Ritonavir or Indinavir (for HIV)', 'exclude_products' => [1, 2, 3, 4]],
                    ['name' => 'Cimetidine (for heartburn)', 'exclude_products' => [1, 2, 3, 4]],
                    ['name' => 'I don\'t take any of these drugs']
                ]
            ],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($questionsAnswers as $questionsData) {
            $createdQuestion = Question::create(['name' => $questionsData['name']]);
            foreach ($questionsData['answers'] as $answerData) {
                $excludedProducts = isset($answerData['exclude_products']) ? $answerData['exclude_products'] : [];
                unset($answerData['exclude_products']);
                $createdAnswer = $createdQuestion->answers()->create($answerData);
                foreach($excludedProducts as $productId) {
                    $createdAnswer->productExclusions()->create(['product_id' => $productId]);
                }
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
