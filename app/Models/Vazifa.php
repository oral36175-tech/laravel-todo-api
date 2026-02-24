<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vazifa extends Model
{
    use HasFactory;

    // Jadval nomi
    protected $table = 'vazifalar';

    // Ruxsat berilgan ustunlar
    // Eslatma: Agar 'izoh' ustuni bazada bo'lmasa, uni olib tashlang
    protected $fillable = ['nomi', 'bajarildi', 'user_id'];

    /**
     * Bu vazifa qaysi foydalanuvchiga tegishli?
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}