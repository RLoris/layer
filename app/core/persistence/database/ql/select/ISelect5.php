<?php
/**
 * Created by IntelliJ IDEA.
 * User: Home
 * Date: 15-12-18
 * Time: 13:29
 */

namespace layer\core\persistence\database\ql\select;


interface ISelect5
{

    public function orderBy() : ISelect6;

    public function limit() : ISelect7;

    public function offset();
}