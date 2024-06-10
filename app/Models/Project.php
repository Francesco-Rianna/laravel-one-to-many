<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\ProjectController;
use App\Models\Type;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','client_name','summary','cover_image','type_id'];
    public function type() {
        return $this->belongsTo(Type::class);
    }
}
