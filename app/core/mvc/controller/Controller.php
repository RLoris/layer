<?php
/**
 * Created by IntelliJ IDEA.
 * User: Home
 * Date: 24-09-18
 * Time: 15:41
 */
namespace layer\core\mvc\controller;

use layer\core\config\Configuration;
use layer\core\exception\ForwardException;
use layer\core\http\HttpHeaders;
use layer\core\http\IHttpHeaders;
use layer\core\http\Request;
use layer\core\http\Response;
use layer\core\mvc\model\ViewModel;
use layer\core\Router;
use Exception;
use layer\core\utils\Logger;

abstract class Controller {

    /**
     * @var Request $request
     */
    protected $request;
    /**
     * @var Response $response
     */
    protected $response;
    /**
     * Controller constructor.
     */
    public function __construct()
    {

    }

    public abstract function index();

    /**
     * @param string $internalUrl
     * @param int $httpCode
     * @throws ForwardException
     */
    protected final function forward($internalUrl, $httpCode = HttpHeaders::MovedTemporarily){
        Logger::write("[".$httpCode."] Forwarding request to new location: ".$internalUrl);
        throw new ForwardException($httpCode, $internalUrl);
    }

    protected final function redirect($url, $timeout = 0) {
        Logger::write(' Redirecting to '.$url);
        header( "refresh:".$timeout.";url=".$url);
        exit();
    }
}