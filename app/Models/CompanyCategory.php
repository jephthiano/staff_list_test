<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // ✅ Add this for UUID support

class CompanyCategory extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string'; // UUIDs are strings
    public $incrementing = false; // Disable auto-incrementing ID

    protected $fillable = ['name', 'description'];

    public function company()
    {
        return $this->hasMany(Company::class, 'company_category_id');
    }
}
