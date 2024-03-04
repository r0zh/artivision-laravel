<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {
    use HasFactory;

    protected $table = 'image';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', // 'user_id' is a foreign key to the 'id' column in the 'users' table
        'seed',
        'name',
        'path',
        'positivePrompt',
        'negativePrompt',
        'public',
    ];

    public function user() {
        return $this->belongsTo(User::class)->first();
    }
}
