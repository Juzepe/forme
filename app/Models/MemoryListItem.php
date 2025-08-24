<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemoryListItem extends Model
{
    use HasUuids;

    protected $fillable = [
        'memory_list_id',
        'content',
        'position',
    ];

    public function memoryList(): BelongsTo
    {
        return $this->belongsTo(MemoryList::class);
    }
}
