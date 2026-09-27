<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\UserResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'project_id'     => $this->project_id,
            'assigned_to'    => $this->assigned_to,
            'title_ar'       => $this->title_ar,
            'title_en'       => $this->title_en,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'priority'       => $this->priority,
            'status'         => $this->status,
            'due_date'       => $this->due_date,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
            'project' => new ProjectResource($this->whenLoaded('project')),
            'assignee' => new UserResource($this->whenLoaded('assignee')),
        ];
    }
}
