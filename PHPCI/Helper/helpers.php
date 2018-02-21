<?php
function config($key)
{
  $config = \b8\Config::getInstance();
  return $config->get($key);
}