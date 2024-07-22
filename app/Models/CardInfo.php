<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\cardRequest;

class CardInfo extends Model
{
    use HasFactory;

    // Specify the table associated with the model if different from the default
    protected $table = 'card_infos';

    // Specify the fillable attributes for mass assignment
    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone_number',
        'CIN',
        'institution',
        'position',
        'type',
        'photo',
    ];

    // If you're using timestamps
    public $timestamps = true;

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cardRequests()
    {
        return $this->hasMany(CardRequest::class);
    }
}

