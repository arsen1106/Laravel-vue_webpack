<?php

use Illuminate\Database\Seeder;
use App\Question;
use App\Answer;

class InsertQuestionSeeder extends Seeder
{
    /**
     * Run the database seed's
     * @return void
     */
    public $quizes = [
        'What\'s Your Favorite Color?' => [
            'A' => 'Green',
            'B' => 'Teal',
            'C' => 'Blue',
            'D' => 'Orange',
            'E' => 'Pink',
            'F' => 'Purple',
        ],
        'What is Your Favorite Season?' => [
            'A' => 'Winter',
            'B' => 'Spring',
            'C' => 'Summer',
            'D' => 'Fall',
        ],
        'What Do You Do at Parties?' => [
            'A' => 'Bring food for everyone',
            'B' => 'Play DJ, I bring the music',
            'C' => 'I make friends with the house pets',
            'D' => 'I take selfies and make sure everyone knows I\'m there',
            'E' => 'I jump into party games',
            'F' => 'I try to start a conversation with someone',
        ],
        'My Ideal Workspace Is...' => [
            'A' => 'Wherever The Work Takes Me',
            'B' => 'An Art Studio',
            'C' => 'An Office',
            'D' => 'Anywhere I can get Wifi',
            'E' => 'My Own Storefront',
        ],
        'When Do You Get The Most Done?' => [
            'A' => 'Early Morning',
            'B' => 'Late at Night',
            'C' => 'Between Other Tasks',
            'D' => 'Whenever Inspiration Hits'
        ]

    ];
    public function run()
    {
        //
        foreach ( $this->quizes as $question => $answers ){
            $currentQuestion = Question::create([
                'question' => $question
            ]);
            if( $currentQuestion ){
                foreach ( $answers as $key => $option){
                    $questionAnswer = Answer::create([
                       'key' => $key,
                       'option' => $option,
                       'question_id' => $currentQuestion->id
                    ]);
                }
            }
        }
    }
}
