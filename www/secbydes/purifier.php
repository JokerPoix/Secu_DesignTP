<?php
require_once __DIR__ . '/htmlpurifier-4.19.0/library/HTMLPurifier.auto.php';

function purifyHTML($dirty_html) {
    $config = HTMLPurifier_Config::createDefault();
    $config->set('Cache.SerializerPath', __DIR__ . '/cache/htmlpurifier');

    $config->set('HTML.Allowed', 'p,br,strong,em,a[href],ul,ol,li');
    $config->set('AutoFormat.AutoParagraph', true);
    $config->set('AutoFormat.RemoveEmpty', true);

    $purifier = new HTMLPurifier($config);
    return $purifier->purify($dirty_html);
}
