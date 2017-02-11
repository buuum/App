<?php

namespace App\Controller\Adm\Blog\ImagePost;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Blog\ImagePostFactory;
use App\Form\Blog\ImagePost\ImagePostForm;
use App\ViewsBuilder\Adm\Messages\ImagePostMessage;
use App\ViewsBuilder\Adm\Pages\ImagePostPage;
use Buuum\S3;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddController extends Controller
{

    public function get()
    {
        return $this->renderView();
    }

    public function post()
    {
        $form = new ImagePostForm('add');
        $data = $form->filter($this->request->request->all());

        if (!$errors = $form->validate($data)) {
            // form success
            return $this->onFormSuccess($data);
        }

        // form error
        return $this->renderView($data, $errors);
    }

    public function onFormSuccess($data)
    {
        ImagePostFactory::get()->build($data);

        $this->flash->set('messages', [
            'class' => ImagePostMessage::class,
            'type'  => 'success_add_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('imagespost_list'));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new ImagePostPage($this->prepareData($data));
        return $pagina->add();
    }

    public function upload_image()
    {
        $files = $this->request->files->all();
        foreach ($files as $file) {
            /** @var UploadedFile $file */
            $file = $file[0];
            break;
        }

        $name = 'poker/' . time() . '_' . slugify(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $response = S3::putObject($file->getRealPath(), $name . '.' . $file->getClientOriginalExtension());

        //$tmp_file = __DIR__ . '/' . microtime(true) . '.' . $file->getClientOriginalExtension();
        //ImageManagerStatic::make($file->getRealPath())->crop(300, 200)->save($tmp_file);
        //S3::putObjectString(file_get_contents($tmp_file), 'min_' . $name . '.' . $file->getClientOriginalExtension());
        //unlink($tmp_file);

        return [
            'error'   => $response['error'],
            'message' => $response['message'],
            'url'     => $response['url']
        ];
    }
}
