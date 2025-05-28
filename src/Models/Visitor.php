<?php
namespace Pm\VisitorTracker\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'session_id', 'user_id', 'ip_address', 'referrer',
        'utm_source', 'utm_medium', 'utm_campaign',
        'country', 'city',
        'gclid', 'msclkid', 'fbclid',
    ];
}
