<?php

//---------------------------------------
function substitute($tpl='') {
    global $newstemplate, $imgtemplate, $moretemplate;
    
    $image = $imgtemplate;
    $more  = $moretemplate;
    
    $text = preg_replace('/\n/', "\n<br>", $text);
    $img = trim($img);
    
    if ($link) {
        $more = str_replace('<link>', $link, $more);
    } else {
        $more = '';
    }
    
    if ($img) {
        if (!$link) {
            $image = '<img src="<img>" alt="" border="0">';
        }
        $image = str_replace('<img>', $img, $image);
        $image = str_replace('<link>', $link, $image);
    } else {
        $image = '&nbsp;';
        $img   = '&nbsp;';
    }
    
    $tpl = str_replace('<newsdate>', $date, $tpl);
    $tpl = str_replace('<newstitle>', $title, $tpl);
    $tpl = str_replace('<newstext>', $text, $tpl);
    $tpl = str_replace('<num>', $num, $tpl);
    $tpl = str_replace('<more>', $more, $tpl);
    $tpl = str_replace('<image>', $image, $tpl);
    $tpl = str_replace('<newslink>', $link, $tpl);
    $tpl = str_replace('<img>', $img, $tpl);
    $tpl = str_replace('<user>', $user, $tpl);
    
    return $tpl;
}

//---------------------------------------
function getnews($newsfile='') {
    if (is_file($newsfile)) {
        $file = file($newsfile);
    } else {
        $file = [];
    }
    return $file;
}

//---------------------------------------
function dump($data, $name='')
{
    $buf = var_export($data, true);
    
    $buf = str_replace('\\r', '', $buf);
    $buf = preg_replace('/\=\>\s*\n\s*array/s', '=> array', $buf);
    
    echo '<pre>';
    
    if($name) {
        echo $name, '=';
    }
    
    echo $buf;
    echo '</pre>';
}



function page_url($url='', $page=1) {
//dump('page_url:');
//dump($url, '$url1');
//dump($page, '$page');

    $parts = parse_url($url);
//dump($parts, '$parts1');
    
//    $q = $parts['query'];
//dump($q, '$q');

    parse_str($parts['query'], $query);
//dump($query, '$query2');
    
    $query['page'] = $page;
//dump($query, '$query3');

    $query = http_build_query($query);
//dump($query, '$query4');

    $url = preg_replace("/\?.*$/", '', $url);

    $url .= '?' . $query;
//dump($url, '$url');

    return $url;
}

/**
    * Create HTML Page List
    * @param int $count Total number of items
    * @param int $perpage Number of items per page
    * @param int $page Current page number (=1 by default)
    * @param string $url
    * @return string Optional: Base URL for a page links
    *
    * Do In Controller:
    *    $page   = intval(@$_GET['page']);
    *    if(!$page) {$page = 1;}
    *    $offset = ($page - 1) * $perpage; // SQL OFFSET
    *    $limit  = $perpage;               // SQL LIMIT
    *    $rows   = select(..., $offset, $limit);
    *     ...
    *    echo  paging($count, $perpage, $page [, $url]);
*/
function paging($count, $perpage, $page = 1, $url = '')
{
//dump($count, '$count');
    
    // $perpage SQL LIMIT (per page limit)
    if (!$perpage) {
        $perpage = 20; // Reset the current per page limit
    }
//dump($perpage, '$perpage');
    
    // Reset the current page number
    if (!$page) {
        $page = 1;
    }
//dump($page, '$page');
    
    $totalPages = ceil($count / $perpage);
//dump($totalPages, '$totalPages');
    
    $offset = ($page - 1) * $perpage;              // SQL OFFSET
    
    if (!$url) {
        $url = $_SERVER['REQUEST_URI'];
    }


    $startPage = intval(($page - 1) / 10) * 10 +1;
    $ceilPage = ceil($startPage / 10);
    $floorPage = floor($startPage / 10);
    $floorTotal = floor($totalPages / 10);
    
    $endPage = $startPage + 9;
    if($endPage > $totalPages) {
        $endPage = $totalPages;
    }
    
    $html = '<!-- Button Bar w/icons -->' . "\n"
    //DEBUG . 'StartPage=' . $startPage . ', endPage=' . $endPage . ', ceilPage=' . $ceilPage . ', floorPage=' . $floorPage . ', floorTotal=' . $floorTotal . "\n"
    . 'Страницы:' . "\n"
    . '<ul class="page_list">' . "\n";
    
    if ($page > 1) {
        if ($floorPage > 0) {
            $html .= '<li><a href="' . page_url($url, 1) . '" title="Первая страница"><i class="fa fa-fast-backward"></i></a></li>' . "\n";
            
            $prev = $startPage - 1;
            $html .= '<li><a href="' . page_url($url, $prev) . '" title="Предыдущие 10 страниц"><i class="fa fa-caret-left"></i></a></li>' . "\n";
        }
    }
    
    for ($i = $startPage; $i <= $endPage; $i++) {
        $html .= '<li ' . ($i == $page ? 'class="current"' : '') . '>';
        $html .= '<a href="' . page_url($url, $i) . '">' . $i . "</a></li>\n";
    }
    
    if ($page < $totalPages) {
        $next = $endPage + 1;
        $html .= '<li><a href="' . page_url($url, $next) . '" title="Следующие 10 страниц"><i class="fa fa-caret-right"></i></a></li>' . "\n";
        
        if ($floorPage < $floorTotal) {
            $html .= '<li><a href="' . page_url($url, $totalPages) . '" title="Последняя страница"><i class="fa fa-fast-forward"></i></a></li>' . "\n";
        }
        
    } else {
        //        $html .= '<li><a><i class="fa fa-caret-right"></i></a></li>' . "\n";
    }
    
    $html .= '</ul>' . "\n";
    
    return $html;
}

/**
 * URL constants as defined in the PHP Manual under "Constants usable with
 * http_build_url()".
 *
 * @see http://us2.php.net/manual/en/http.constants.php#http.constants.url
 */
if (!defined('HTTP_URL_REPLACE')) {
    define('HTTP_URL_REPLACE', 1);
}
if (!defined('HTTP_URL_JOIN_PATH')) {
    define('HTTP_URL_JOIN_PATH', 2);
}
if (!defined('HTTP_URL_JOIN_QUERY')) {
    define('HTTP_URL_JOIN_QUERY', 4);
}
if (!defined('HTTP_URL_STRIP_USER')) {
    define('HTTP_URL_STRIP_USER', 8);
}
if (!defined('HTTP_URL_STRIP_PASS')) {
    define('HTTP_URL_STRIP_PASS', 16);
}
if (!defined('HTTP_URL_STRIP_AUTH')) {
    define('HTTP_URL_STRIP_AUTH', 32);
}
if (!defined('HTTP_URL_STRIP_PORT')) {
    define('HTTP_URL_STRIP_PORT', 64);
}
if (!defined('HTTP_URL_STRIP_PATH')) {
    define('HTTP_URL_STRIP_PATH', 128);
}
if (!defined('HTTP_URL_STRIP_QUERY')) {
    define('HTTP_URL_STRIP_QUERY', 256);
}
if (!defined('HTTP_URL_STRIP_FRAGMENT')) {
    define('HTTP_URL_STRIP_FRAGMENT', 512);
}
if (!defined('HTTP_URL_STRIP_ALL')) {
    define('HTTP_URL_STRIP_ALL', 1024);
}

if (!function_exists('http_build_url')) {

    /**
     * Build a URL.
     *
     * The parts of the second URL will be merged into the first according to
     * the flags argument.
     *
     * @param mixed $url     (part(s) of) an URL in form of a string or
     *                       associative array like parse_url() returns
     * @param mixed $parts   same as the first argument
     * @param int   $flags   a bitmask of binary or'ed HTTP_URL constants;
     *                       HTTP_URL_REPLACE is the default
     * @param array $new_url if set, it will be filled with the parts of the
     *                       composed url like parse_url() would return
     * @return string
     *
     * @author jakeasmith https://github.com/jakeasmith/http_build_url
     */
    function http_build_url($url, $parts = array(), $flags = HTTP_URL_REPLACE, &$new_url = array())
    {
        is_array($url) || $url = parse_url($url);
        is_array($parts) || $parts = parse_url($parts);

        isset($url['query']) && is_string($url['query']) || $url['query'] = null;
        isset($parts['query']) && is_string($parts['query']) || $parts['query'] = null;

        $keys = array('user', 'pass', 'port', 'path', 'query', 'fragment');

        // HTTP_URL_STRIP_ALL and HTTP_URL_STRIP_AUTH cover several other flags.
        if ($flags & HTTP_URL_STRIP_ALL) {
            $flags |= HTTP_URL_STRIP_USER | HTTP_URL_STRIP_PASS
                | HTTP_URL_STRIP_PORT | HTTP_URL_STRIP_PATH
                | HTTP_URL_STRIP_QUERY | HTTP_URL_STRIP_FRAGMENT;
        } elseif ($flags & HTTP_URL_STRIP_AUTH) {
            $flags |= HTTP_URL_STRIP_USER | HTTP_URL_STRIP_PASS;
        }

        // Schema and host are alwasy replaced
        foreach (array('scheme', 'host') as $part) {
            if (isset($parts[$part])) {
                $url[$part] = $parts[$part];
            }
        }

        if ($flags & HTTP_URL_REPLACE) {
            foreach ($keys as $key) {
                if (isset($parts[$key])) {
                    $url[$key] = $parts[$key];
                }
            }
        } else {
            if (isset($parts['path']) && ($flags & HTTP_URL_JOIN_PATH)) {
                if (isset($url['path']) && substr($parts['path'], 0, 1) !== '/') {
                    // Workaround for trailing slashes
                    $url['path'] .= 'a';
                    $url['path'] = rtrim(
                            str_replace(basename($url['path']), '', $url['path']),
                            '/'
                        ) . '/' . ltrim($parts['path'], '/');
                } else {
                    $url['path'] = $parts['path'];
                }
            }

            if (isset($parts['query']) && ($flags & HTTP_URL_JOIN_QUERY)) {
                if (isset($url['query'])) {
                    parse_str($url['query'], $url_query);
                    parse_str($parts['query'], $parts_query);

                    $url['query'] = http_build_query(
                        array_replace_recursive(
                            $url_query,
                            $parts_query
                        )
                    );
                } else {
                    $url['query'] = $parts['query'];
                }
            }
        }

        if (isset($url['path']) && $url['path'] !== '' && substr($url['path'], 0, 1) !== '/') {
            $url['path'] = '/' . $url['path'];
        }

        foreach ($keys as $key) {
            $strip = 'HTTP_URL_STRIP_' . strtoupper($key);
            if ($flags & constant($strip)) {
                unset($url[$key]);
            }
        }

        $parsed_string = '';

        if (!empty($url['scheme'])) {
            $parsed_string .= $url['scheme'] . '://';
        }

        if (!empty($url['user'])) {
            $parsed_string .= $url['user'];

            if (isset($url['pass'])) {
                $parsed_string .= ':' . $url['pass'];
            }

            $parsed_string .= '@';
        }

        if (!empty($url['host'])) {
            $parsed_string .= $url['host'];
        }

        if (!empty($url['port'])) {
            $parsed_string .= ':' . $url['port'];
        }

        if (!empty($url['path'])) {
            $parsed_string .= $url['path'];
        }

/*vot*/        if(is_array($url['query'])) {
/*vot*/            $url['query'] = http_build_query($url['query']);
/*vot*/        }
        if (!empty($url['query'])) {
            $parsed_string .= '?' . $url['query'];
        }

        if (!empty($url['fragment'])) {
            $parsed_string .= '#' . $url['fragment'];
        }

        $new_url = $url;

        return $parsed_string;
    }
}
