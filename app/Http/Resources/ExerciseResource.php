<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'level' => $this->level,
            'example_input' => $this->example_input,
            'example_output' => $this->example_output,
            'test_cases' => $this->test_cases,
            'is_free' => $this->is_free,
            'time_limit' => $this->time_limit,
            'memory_limit' => $this->memory_limit
        ];
    }
}
