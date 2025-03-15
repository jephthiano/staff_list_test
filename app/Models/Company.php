<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string'; // UUIDs are strings
    public $incrementing = false; // Disable auto-incrementing ID

    protected $fillable = ['name', 'email', 'phone', 'address', 'company_category_id'];

    
    public function category()
    {
        return $this->belongsTo(CompanyCategory::class, 'company_category_id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'company_id');
    }
}
