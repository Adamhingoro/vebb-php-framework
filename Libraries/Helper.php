<?php

function url_to($address)
{
  if(is_array($address))
  {
    return WEB_ADDRESS . URL_PREFIX . "/"  . implode($address , "/");
  }
  else {
    return WEB_ADDRESS . URL_PREFIX . "/"  . $address;
  }
}

function redirect_to($address)
{
  if(is_array($address))
  {
    header("Location: " .URL_PREFIX . "/"  . implode($address , "/"));
  }
  else {
    header("Location: " .URL_PREFIX . "/"  . $address );
  }
}