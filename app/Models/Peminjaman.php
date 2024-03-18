<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $guarded = ['id'];

    // Many to One ke Kostum
    public function kostum(): BelongsTo
    {
        return $this->belongsTo(Kostum::class, 'kostum_id');
    }
}
