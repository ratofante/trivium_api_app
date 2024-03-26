<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $request['id'],
            'question' => $request['question'],
            'answer' => $request['answer'],
            'opt_1' => $request['opt_1'],
            'opt_2' => $request['opt_2'],
            'opt_3' => $request['opt_3'],
        ];
    }
}
