<?php

class ParentClass
{
    private function __construct()
    {
        echo "Parent constructor";
    }
}

class ChildClass extends ParentClass
{
    public function __construct()
    {
        echo "Child constructor";
    }
}

$kuku = new ChildClass();
