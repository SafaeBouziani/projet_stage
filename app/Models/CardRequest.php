<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CardInfo;


class CardRequest extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Specify the table associated with the model if different from the default
    protected $table = 'card_requests';

    // Specify the fillable attributes for mass assignment
    protected $fillable = [
        'user_id',
        'card_info_id',
        'status',
    ];

    // If you're using timestamps
    public $timestamps = true;

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the CardInfo model
    public function cardInfo()
    {
        return $this->belongsTo(CardInfo::class);
    }
}
