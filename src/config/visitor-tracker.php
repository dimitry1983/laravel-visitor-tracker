<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Track IP address
    |--------------------------------------------------------------------------
    |
    | Bepaal of het IP-adres van de bezoeker wordt opgeslagen.
    |
    */

    'track_ip' => true,

    /*
    |--------------------------------------------------------------------------
    | Gebruik Geo-locatie tracking (via stevebauman/location)
    |--------------------------------------------------------------------------
    */

    'track_location' => true,

    /*
    |--------------------------------------------------------------------------
    | Track referrer & UTM
    |--------------------------------------------------------------------------
    */

    'track_referrer' => true,
    'track_utm' => true,

    /*
    |--------------------------------------------------------------------------
    | Session key voor bezoeker
    |--------------------------------------------------------------------------
    */

    'session_key' => 'visitor_tracked',


    'track_bots' => true, // Zet op false als je bots niet wilt bijhouden

    // Voeg hier de toegestane landen toe, bijvoorbeeld ['Netherlands', 'Belgium']
    // Gebruik lege array [] om geen restrictie toe te passen
    'allowed_countries' => [],



];
