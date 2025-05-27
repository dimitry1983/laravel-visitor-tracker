<?php
namespace Pm\VisitorTracker\Helpers;

use Pm\VisitorTracker\Models\Visitor;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;

class VisitorTracker
{
    public static function track(): void
    {
        if (Session::has('visitor_tracked')) return;

        $ip = Request::ip();
        $referrer = Request::header('referer');
        $utmSource = Request::query('utm_source');
        $utmMedium = Request::query('utm_medium');
        $utmCampaign = Request::query('utm_campaign');
        $location = Location::get($ip);
        $sessionId = Session::getId();

        Visitor::create([
            'session_id'    => $sessionId,
            'ip_address'    => $ip,
            'referrer'      => $referrer,
            'utm_source'    => $utmSource,
            'utm_medium'    => $utmMedium,
            'utm_campaign'  => $utmCampaign,
            'country'       => $location?->countryName ?? 'Onbekend',
            'city'          => $location?->cityName ?? 'Onbekend',
        ]);

        Session::put('visitor_tracked', true);
    }
}
