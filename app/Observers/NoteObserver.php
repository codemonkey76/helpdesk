<?php

namespace App\Observers;

use App\Models\Note;
use Illuminate\Support\Facades\Cache;

class NoteObserver
{
    public function getCacheTag(Note $note)
    {
        $tag = '';

        if ($note->noteable_type === 'organization') {
            $tag = 'organizations.' . $note->noteable_id . '.notes';
        }
        return $tag;
    }
    public function created(Note $note)
    {
        Cache::tags([$this->getCacheTag($note)])->flush();
    }

    public function updated(Note $note)
    {
        Cache::tags([$this->getCacheTag($note)])->flush();
    }

    public function deleted(Note $note)
    {
        Cache::tags([$this->getCacheTag($note)])->flush();
    }
}
