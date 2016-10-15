<?php
namespace Wambo\Frontend\Controller;

use Ramsey\Uuid\Uuid;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
use Slim\Views\Twig;

class AdminController
{
    /** @var Twig $renderer */
    private $renderer;

    /**
     * @param Twig $renderer
     */
    public function __construct(
        Twig $renderer
    ) {
        $this->renderer = $renderer;
    }

    public function config(Response $response)
    {
        return $this->renderer->render($response, 'admin/config.twig', [

        ]);
    }

    public function upload(Request $request, Response $response)
    {
        if(!$request->isPost()) {
            return;
        }

        foreach($request->getUploadedFiles() as $file) {
            $id = Uuid::uuid4();
           /** @var UploadedFile $file */
            $fileName = $id->toString() . '.jpg';
            $relativeFilePath = "/web/images/" . $fileName;
            $file->moveTo(WAMBO_ROOT_DIR . $relativeFilePath);

            return json_encode(['image' => $fileName]);
        }
    }

    public function addProduct(Request $request, Response $response)
    {
        if($request->isPost()){

            $slug = substr(Uuid::uuid4(), 0, 8);
            $title = $request->getParam('title');
            $image = $request->getParam('image');

            $catalog_raw = file_get_contents(WAMBO_ROOT_DIR . '/data/catalog.json');
            $catalog = json_decode($catalog_raw);

            $catalog[] = [
                'sku' => $slug,
                'price' => [
                    'amount' => 123,
                    'currency' => 'EUR'
                ],
                "image" => $image,
                "slug" => $slug,
                "title" =>  $title,
                "summary" => $title,
                "description" => "Our fancy  product No. wambo is ..."
            ];

            file_put_contents(WAMBO_ROOT_DIR . '/data/catalog.json', json_encode($catalog, JSON_PRETTY_PRINT));




            return $response->withRedirect('/product/' . $slug);
        }

        return $this->renderer->render($response, 'admin/add_poduct.twig', [

        ]);
    }
}