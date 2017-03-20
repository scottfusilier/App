<?php
namespace App\Controller;

use App\Template\BasicTemplate as Template;
use App\View\Basic as View;

class BasicController extends AppController
{
    public function index($request, $response, $args)
    {
        $params = array_merge($args,$request->getQueryParams());
        return $this->render($response,Template::get()->render(View\BasicView::get()->setVars(['data' => json_encode($params)])));
    }

    public function secret($request, $response, $args)
    {
        return $this->render($response,Template::get()->render(View\BasicView::get()->setVars(['data' => json_encode(['secret'=>'oats'])])));
    }

    public function download($request, $response, $args)
    {
        $file = __DIR__ . '/example-0.10.3.zip';

        if (!file_exists($file)) {
            throw new \RuntimeException('file does not exist');
        }

        $fh = fopen($file, 'rb');

        $stream = new \GuzzleHttp\Psr7\Stream($fh);

        return $response->withHeader('Content-Type', 'application/force-download')
                        ->withHeader('Content-Type', 'application/octet-stream')
                        ->withHeader('Content-Type', 'application/download')
                        ->withHeader('Content-Description', 'File Transfer')
                        ->withHeader('Content-Transfer-Encoding', 'binary')
                        ->withHeader('Content-Disposition', 'attachment; filename="' . basename($file) . '"')
                        ->withHeader('Expires', '0')
                        ->withHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                        ->withHeader('Pragma', 'public')
                        ->withBody($stream);
    }
}
