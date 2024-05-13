<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'AdID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Title',
        'Description',
        'AdPhoto',
        'UserID',
        'CategoryID',
        'Status',
        // Добавьте другие поля, которые можно заполнить массово
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // Добавьте поля, которые не должны быть включены в сериализованные массивы модели
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // Добавьте поля, которые должны быть приведены к определенным типам
    ];

    // Определите связи с другими моделями, если они есть
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }
}