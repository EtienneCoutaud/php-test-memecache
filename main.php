<?php
if (class_exists('Memcache')) {
    $server = 'memcached';
    if (!empty($_REQUEST['server'])) {
        $server = $_REQUEST['server'];
    }
    $memcache = new Memcache;
    $isMemcacheAvailable = $memcache->connect($server);

    $action=$argv[1];

    if ($isMemcacheAvailable) {
        if (strcmp($action, 'set') == 0)
	{
	  $aData = rand(0, 100000);
	  print_r($aData);
	  $memcache->set('data', $aData);
	  exit(0);
	}
	if (strcmp($action, 'get') == 0)
	{
	  $aData = $memcache->get('data');
	  print_r($aData);
	  exit(0);
	}
    }
}
if (!$isMemcacheAvailable) {
    echo 'Memcache not available';
}

?>
