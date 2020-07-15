<?php

use rloris\layer\core\http\IHttpMethods;

require_once(APP_PATH . 'src/lib/addendum/annotations.php');

// TODO : divide class in different files

abstract class MVCAnnotation extends Annotation
{
    private function grepRouteTemplateParameters() {
        $params = [];
        preg_match_all('/{#?(\w+)\??}/', $this->routeTemplate, $params);
        return count($params) >= 1 ? array_slice($params, 1)[0] : [];
    }

    public function verifyRouteTemplate() {
        if(preg_match('/^[a-zA-Z0-9\/{}?#]+$/', $this->routeTemplate)) {
            $res = $this->routeTemplate;
            foreach ($this->grepRouteTemplateParameters() as $param) {
                // (\w+)
                $res = preg_replace("/{#".$param."}/", "(?<".$param.">\d+)", $res);
                $res = preg_replace("/{\/?#".$param."\?}/", "?(?<".$param.">\d*)", $res);
                $res = preg_replace("/{".$param."}/", "(?<".$param.">[^/]+)" , $res);
                $res = preg_replace("/{\/?".$param."\?}/", "?(?<".$param.">[^/]*)" ,$res);
            }
            return $res;
        }
        return null;
    }

    public function getFilters() {
        return array_map('strtolower', $this->filters);
    }
}

/** @Target("class") */
class Filter extends Annotation
{
    /**
     * @var string $name
     */
    public $name = null;
    /**
     * @var bool $mapped
     */
    public $mapped = true;

    public function verifyName() {
        if(preg_match('/^[a-zA-Z0-9]+$/',$this->name))
                return $this->name;
        else
                return null;
    }
}

/** @Target("class") */
class GlobalFilter extends Filter
{

}

/** @Target("class") */
class Controller extends MVCAnnotation
{
    /**
     * @var string
     */
    public $routeTemplate;
    /**
     * @var bool
     */
    public $mapped = true;
    /**
     * @var string[]
     */
    public $filters = [];
    /**
     * @var string
     */
    public $defaultAction = 'index';
    /**
     * @var string
     */
    public $layoutName = null;
}

/** @Target("method") */
class Action extends MVCAnnotation
{
    /**
     * @var string
     */
    public $routeTemplate;
    /**
     * @var string[]
     */
    public $methods = [IHttpMethods::POST, IHttpMethods::GET];
    /**
     * @var bool
     */
    public $mapped = true;
    /**
     * @var string[]
     */
    public $filters = [];
    /**
     * @var string
     */
    public $viewName = null;
    /**
     * @var string
     */
    public $layoutName = null;
    /**
     * @param $method
     * @return bool
     */
    public function hasRequestMethod($method)
    {
       return in_array(strtolower($method),$this->methods);
    }

    public function verifyMethods()
    {
        $this->methods = array_map('strtolower', $this->methods);
        sort($this->methods);
        return array_uintersect($this->methods, IHttpMethods::ALL, function ($v1, $v2) {
            return strcasecmp($v1, $v2);
        });
    }
    
}

/** @Target("class") */
class ErrorController extends Annotation {
    /**
     * @var string
     */
    public $layoutName = null;
}

/** @Target("method") */
class ErrorAction extends Annotation {
    /**
     * @var string[]
     */
    public $errorCodes = [];
    /**
     * @var bool
     */
    public $mapped = true;
    /**
     * @var string
     */
    public $viewName = null;
    /**
     * @var string
     */
    public $layoutName = null;
}

/** @Target("class") */
class DefaultController extends Controller {

}

/** @Target("class") */
class ApiController extends MVCAnnotation
{
    /**
     * @var string
     */
    public $routeTemplate;
    /**
     * @var bool
     */
    public $mapped = true;
    /**
     * @var string[]
     */
    public $filters = [];
    /**
     * @var string $responseType
     */
    public $responseType = 'JSON';
    /**
     * @var string
     */
    public $defaultAction = '/';
}

/** @Target("method") */
class ApiAction extends MVCAnnotation
{
    /**
     * @var string
     */
    public $routeTemplate;
    /**
     * @var string[]
     */
    public $methods = [IHttpMethods::GET];
    /**
     * @var bool
     */
    public $mapped = true;
    /**
     * @var string[]
     */
    public $filters = [];
    /**
     * @var string $responseType
     */
    public $responseType = 'JSON';

    public function verifyMethods() {
        $this->methods = array_map('strtolower', $this->methods);
        sort($this->methods);
        return array_uintersect($this->methods, IHttpMethods::ALL, function ($v1, $v2) {
            return strcasecmp($v1, $v2);
        });
    }
}


/** @Target("class") */
class ApiErrorController extends Annotation {}

/** @Target("method") */
class ApiErrorAction extends Annotation {
    /**
     * @var string[]
     */
    public $errorCodes = [];
    /**
     * @var bool
     */
    public $mapped = true;
}

/** @Target("method") */
class Sitemap extends Annotation {

    /**
     * @var float
     */
    public $sitemapPriority = 0.5;
    /**
     * @var string
     */
    public $sitemapChangefreq = 'Always';

    public function getSitemapPriority()
    {
        if($this->sitemapPriority == null)
            return null;
        if($this->sitemapPriority >= 0.0 && $this->sitemapPriority <= 1.0)
        {
            return $this->sitemapPriority;
        }
        else
        {
            return 0.5;
        }
    }

    public function getSitemapChangefreq()
    {
        if($this->sitemapChangefreq == null)
            return null;
        $changefreq = strtolower($this->sitemapChangefreq);
        if(in_array($changefreq, ['always', 'never', 'hourly', 'daily', 'weekly', 'monthly', 'yearly']))
        {
            return ucfirst($changefreq);
        }
        return null;
    }
}



