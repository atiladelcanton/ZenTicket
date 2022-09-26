<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

abstract class ModelTestCase extends TestCase
{
    abstract protected function model(): Model;
    abstract protected function traits(): array;
    abstract protected function fillables(): array;
    abstract protected function casts(): array;

    public function testIfUseTraits()
    {
        $traitsNeed = $this->traits();

        $traitsUsed = array_keys(class_uses($this->model()));

        $this->assertEquals($traitsNeed, $traitsUsed);
    }

    public function testFillables()
    {
        $expected = $this->fillables();

        $fillable = $this->model()->getFillable();

        $this->assertEquals($expected, $fillable);
    }

    public function testHasCasts()
    {
        $excepectedCasts = $this->casts();

        $casts = $this->model()->getCasts();

        $this->assertEquals($excepectedCasts, $casts);
    }
}
