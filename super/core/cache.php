<?php

namespace super\core;

interface cache
{

	public function __construct($configure);

	static public function &get($key);

	static public function set($key, $value, array $options=null);

	public function &__get($key);

	public function __set($key, $value);
}
