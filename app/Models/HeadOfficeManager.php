<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadOfficeManager extends Model
{
    use HasFactory;
    protected $primaryKey = 'HeadManagerID';
    protected $fillable = ['Name', 'PositionID', 'PhoneNumber'];
}
