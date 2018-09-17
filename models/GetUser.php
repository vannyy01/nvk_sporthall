<?php
/**
 * Created by PhpStorm.
 * User: vanny
 * Date: 01.05.2018
 * Time: 19:15
 */

namespace app\models;


interface GetUser
{
    public function getFullUserName(bool $withLogin): string;
}