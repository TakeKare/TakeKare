<?php

function is_external_link($link)
{
    if ((strpos($link, '://')))               return true;
    if ((strpos($link, 'javascript:') === 0)) return true;
    if ((strpos($link, 'mailto:') === 0))     return true;
    if ((!strncmp($link, '#', 1)))            return true;

    return false;
}

function cfg($name)
{
    return Configure::read($name);
}

function is_id($ID)
{
    return (is_int($ID) || (ctype_digit($ID) && $ID > 0) || (!empty($ID) && preg_match("/[0-9A-Z]*/", $ID)))
        ? true
        : false;
}

function slug($text)
{
    $from = array('ą','č','ę','ė','į','š','ų','ū','ž','Ą','Č','Ę','Ė','Į','Š','Ų','Ū','Ž',' ');
    $to   = array('a','c','e','e','i','s','u','u','z','A','C','E','E','I','S','U','U','Z','-');
    $text = strtolower(str_replace($from, $to, $text));
    $text = preg_replace('/[^a-zA-Z0-9\-]/', '',$text);
    $text = str_replace(array('----', '---', '--'), '-', $text);

    return $text;
}

function random_string($length = 32)
{
    $password = '';
    $possible = "123456789ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
    $i = 0;
    while ($i < $length)
    {
        $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
        if (!strstr($password, $char))
        {
            $password .= $char;
            $i++;
        }
    }
    return $password;
}

function file_extension($fileName)
{
    return array_pop(explode('.', $fileName));
}

function dim(&$var, $default = null)
{
    return empty($var)
        ? $var = $default
        : $var;
}

function array_filter_keys(array $source, array $keys)
{
    return array_intersect_key($source, array_flip($keys));
}

function get($url, $method = 'GET', $data = array(), $options = array())
{
    $cacheKey = Inflector::slug($url);
    if (($output = Cache::read($cacheKey, 'url')) !== false)
    {
        return $output;
    }

    $defaultOptions = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        //CURLOPT_TIMEOUT => 10,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_USERAGENT     => 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0',
        CURLOPT_HTTPHEADER    => array(
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.85',
            'Cache-Control: max-age=0',
            'Connection: keep-alive',
            'Keep-Alive: 300',
            //'ACCEPT-CHARSET: ISO-8859-1,UTF-8;Q=0.7,*;Q=0.7',
            'Accept-Language: en-US,en;q=0.5',
            'Pragma: ',
            //'Content-type: application/json',
        ),
    );

    foreach ($defaultOptions as $k => $v)
    {
        if (!isset($options[$k])) {
            $options[$k] = $v;
        }
    }

    $ch = curl_init();
    foreach ($options as $k => $v)
    {
        curl_setopt($ch, $k, $v);
    }

    if ($data)
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    if(!$output = curl_exec($ch))
    {
        throw new CakeException(curl_error($ch));
    }

    curl_close($ch);

    Cache::write($cacheKey, $output, 'url');

    return $output;
}