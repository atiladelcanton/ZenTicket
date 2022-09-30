<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
ini_set('memory_limit', '1024M');
abstract class TestCase extends BaseTestCase
{

    use CreatesApplication;


}
