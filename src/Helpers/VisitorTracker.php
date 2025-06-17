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
        if (preg_match('/bot|crawler|spider|monitor/i', $userAgent)) {
            $bot = 1;
            if(config('visitortracker.track_bots') == false){
                return;
            }
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
        $url = Request::fullUrl();


        // Alleen bezoekers uit bepaalde landen toestaan
        $allowedCountries = config('visitortracker.allowed_countries');
        $country = $location?->countryName ?? 'Onbekend';

        if (!empty($allowedCountries) && !in_array($country, $allowedCountries)) {
            return; // Land niet toegestaan, stop hier.
        }


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
            'full_url'      => $url,
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
