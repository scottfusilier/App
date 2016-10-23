<?php
namespace App\Controller;

class ExampleDataController extends DataController
{
    protected $permissioned = [
        'example'
    ];

    protected function accessControl($method)
    {
        return ($this->Auth->hasUser() || !in_array($method, $this->permissioned));
    }

    public function example(Array $args)
    {
        $data = new \stdClass;
        $data->success = true;
        $data->data = ['I am data'];

        echo json_encode($data);
    }

    public function open(Array $args)
    {
        echo '<p>open for consumption</p>';
    }
}
