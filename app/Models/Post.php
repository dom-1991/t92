<?php

namespace App\Models;

use App\Helpers\Common;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'body', 'image', 'ip'];

    public function reactions ()
    {
        return $this->hasMany(Reaction::class);
    }

    public function getIsActionAttribute()
    {
        $ip = Common::getClientIp();
        $today = Carbon::now()->format('Y-m-d') . ' 00:00:00';
        if ($this->reactions->where('ip', $ip)->where('created_at', '>=', $today)->count()) {
            return true;
        }

        return false;
    }
}
