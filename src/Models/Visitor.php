<?php
namespace Pm\VisitorTracker\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'session_id', 'user_id', 'ip_address', 'user_agent', 'is_bot', 'referrer',
        'utm_source', 'utm_medium', 'utm_campaign',
        'country', 'city',
        'gclid', 'msclkid', 'fbclid',
    ];
}
