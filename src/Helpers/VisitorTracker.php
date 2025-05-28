<?php
namespace Pm\VisitorTracker\Helpers;

use Pm\VisitorTracker\Models\Visitor;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Str;

class VisitorTracker
{
    public static function track(): void
    {

        $bot = 0;
        $userAgent = request()->header('User-Agent');
        if (Str::contains(strtolower($userAgent), ['bot', 'crawler', 'spider', 'monitor'])) {
            $bot = 1;
        }

        if (Session::has('visitor_tracked')) return;

        $ip = Request::ip();
        $referrer = Request::header('referer');
        $utmSource = Request::query('utm_source');
        $utmMedium = Request::query('utm_medium');
        $utmCampaign = Request::query('utm_campaign');
        $location = Location::get($ip);
        $sessionId = Session::getId();
        $gclid   = Request::query('gclid');
        $msclkid = Request::query('msclkid');
        $fbclid  = Request::query('fbclid');

        if ($gclid) {
            Session::put('gclid', $gclid);
        }

        if ($msclkid) {
            Session::put('msclkid', $msclkid);
        }

        if ($fbclid) {
            Session::put('fbclid', $fbclid);
        }




        Visitor::create([
            'session_id'    => $sessionId,
            'ip_address'    => $ip,
            'user_agent'    => $userAgent,
            'is_bot'        => $bot,
            'referrer'      => $referrer,
            'utm_source'    => $utmSource,
            'utm_medium'    => $utmMedium,
            'utm_campaign'  => $utmCampaign,
            'country'       => $location?->countryName ?? 'Onbekend',
            'city'          => $location?->cityName ?? 'Onbekend',
            'gclid'         => $gclid,
            'msclkid'       => $msclkid,
            'fbclid'        => $fbclid,
        ]);

        Session::put('visitor_tracked', true);
    }
}
