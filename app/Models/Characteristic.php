<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Characteristic extends Model
{
    public $timestamps = true;
    protected $fillable = [
       'name',
       'game_id',
       'description',
    ];

    public function game() : BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
