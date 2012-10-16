# PeerIndex API for PHP

Usage:

    $key = 'YOUR_API_KEY_HERE';
    $twitterName = 'iainmullan';

    $pi = new PeerIndexAPI($key);
    $user = pi->show($twitterName);
    echo $user['name'].': '.$user['peerindex'];
