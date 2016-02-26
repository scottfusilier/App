<?php
namespace App\Model;

class ExampleModel extends AppModel
{
    public $idExample;
    public $ExampleName;

    protected function getIdField()
    {
        return 'idExample';
    }
}
