<?php

namespace Charcoal\Attachment\Object;

/**
 * Link Attachment Type
 *
 * Uses the title and link properties for defining an external URI.
 */
class Link extends Attachment
{
    /**
     * Retrieve an abridged variant to the given URI.
     *
     * @return string
     */
    public function abridgedLink()
    {
        $uri = $this->link();

        $i = 30;
        $j = 12;

        if (mb_strlen($uri) <= $i) {
            return $uri;
        }

        $host = rtrim(parse_url($uri, PHP_URL_HOST), '/');
        $path = '/'.ltrim(parse_url($uri, PHP_URL_PATH), '/');

        if ($host === getenv('HTTP_HOST')) {
            $i = 50;
            $j = 22;

            $host = '';
        } else {
            if (mb_strlen($host) > $i && mb_strlen($path) > $i) {
                return $this->abridgeStr($uri, 50, 22);
            }

            $host = $this->abridgeStr($host, 20, 7);
        }

        $path = $this->abridgeStr($path, $i, $j);

        return $host.$path;
    }

    /**
     * Retrieve an abridged variant to the given URI.
     *
     * @param string  $str The string to possibly truncate.
     * @param integer $l   Optional. The soft-limit of the string.
     * @param integer $a   Optional. The hard-limit to keep from the beginning of the string.
     * @param integer $z   Optional. The hard-limit to keep from the end of the string.
     * @return string
     */
    protected function abridgeStr($str, $l = 30, $a = 12, $z = 12)
    {
        if (mb_strlen($str) > $l) {
            $str = (($a > 0) ? mb_substr($str, 0, $a) : '').'&hellip;'.(($z > 0) ? mb_substr($str, -$z) : '');
        }

        return $str;
    }
}
