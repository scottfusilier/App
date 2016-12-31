<?php
namespace App\Controller;

class ExampleDataController extends AppDataController
{
    protected $openACL = [ // open routes; no authentication required
        'data',
        'open'
    ];

    public function example(Array $args)
    {
        $data = new \stdClass;
        $data->success = true;
        $data->data = ['I am permissioned data'];

        echo json_encode($data);
    }

    public function open(Array $args)
    {
        $data = new \stdClass;
        $data->success = true;
        $data->data = ['I am data open for consumption'];

        echo json_encode($data);
    }
}
