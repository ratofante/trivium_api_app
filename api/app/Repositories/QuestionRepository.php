<?php

namespace App\Repositories;

use App\Exceptions\GeneralJsonException;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionRepositoy extends BaseRepository
{
    /**
     * @param array
     * @return mixed;
     */
    public function create($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $created = Question::create([
                'question' => data_get($attributes, 'question'),
                'answer' => data_get($attributes, 'answer'),
                'opt_1' => data_get($attributes, 'opt_1'),
                'opt_2' => data_get($attributes, 'opt_2'),
                'opt_3' => data_get($attributes, 'opt_3'),
                'score' => data_get($attributes, 'score', 50),
                'category_id' => data_get($attributes, 'category_id'),
                'user_id' => data_get($attributes, 'user_id'),
            ]);

            throw_if(!$created, GeneralJsonException::class, 'Error al crear pregunta');

            return $created;
        });
    }

    public function update($question, $attributes)
    {
        return DB::transaction(function () use ($question, $attributes) {
            $update = $question->update([
                'question' => data_get($attributes, 'question', $question->question),
                'answer' => data_get($attributes, 'answer', $question->answer),
                'opt_1' => data_get($attributes, 'opt_1', $question->opt_1),
                'opt_2' => data_get($attributes, 'opt_2', $question->opt_2),
                'opt_3' => data_get($attributes, 'opt_3', $question->opt_3),
                'score' => data_get($attributes, 'score', $question->score),
                'category_id' => data_get($attributes, 'category_id', $question->category_id),
                'user_id' => data_get($attributes, 'user_id', $question->user_id),
            ]);

            throw_if(!$update, GeneralJsonException::class, 'Error al actualizar pregunta');

            return $question;
        });
    }

    public function forceDelete($question)
    {
        return DB::transaction(function () use ($question) {
            $deleted = $question->forceDelete();

            throw_if(!$deleted, GeneralJsonException::class, 'Error al eliminar pregunta');

            return $deleted;
        });
    }
}
