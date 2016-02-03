<?php
if (class_exists('Memcache')) {
    $server = 'localhost';
    if (!empty($_REQUEST['server'])) {
        $server = $_REQUEST['server'];
    }
    $memcache = new Memcache;
    $isMemcacheAvailable = @$memcache->connect($server);

    if ($isMemcacheAvailable) {
        $aData = $memcache->get('data');
        if ($aData) {
            echo 'Data from Cache:';
            print_r($aData);
        } else {
            $aData = rand(0, 10000)
            echo 'Fresh Data:';
            print_r($aData);
            $memcache->set('data', $aData, 0, 300);
        }
        $aData = $memcache->get('data');
        if ($aData) {
            echo 'OK';
        } else {
            echo 'KO';
        };
    }
}
if (!$isMemcacheAvailable) {
    echo 'Memcache not available';
}

?>
