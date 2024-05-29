<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchManager extends Model
{
    use HasFactory;
    protected $primaryKey = 'ManagerID';
    protected $fillable = ['Name', 'PositionID', 'BranchID', 'PhoneNumber'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'BranchID', 'BranchID');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'PositionID', 'PositionID');
    }
}
