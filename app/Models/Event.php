<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory , SoftDeletes,Notifiable,InteractsWithMedia;
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
        'location',
        'status_published',
        'available_seats',
        'automatic_acceptance',
        'price',
        'category_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
     }

     public function users()
     {
         return $this->belongsToMany(User::class, 'offer_users');
     }
     public function category(){
        return $this->belongsTo(Category::class);
     }

   
}
