# PeerIndex API for PHP

Usage:

    $key = 'YOUR_API_KEY_HERE';
    $twitterName = 'iainmullan';

    $pi = new PeerIndex($key);
    $pi->show($twitterName);