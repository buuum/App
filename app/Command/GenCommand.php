<?php
namespace App\Command;


class GenCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('gen')
            ->setDescription('Generate base CRUD');
    }

    protected function fire()
    {
        $model = $this->question("¿Que modelo quieres generar? (case sensitive) \n");

        $folder = $this->question("¿En que carpeta esta el modelo? (case sensitive) \n");
        $type = $this->choiceQuestion('¿Que quieres crear?', [
            'model',
            'form',
            'route',
            'factory',
            'handler',
            'controller',
            'views',
            'all'
        ]);

        $model_name = $model;
        $folder_path = !empty($folder) ? '/' . $folder : '';


        if ($type == 'model' || $type == 'all') {
            $file_path = __DIR__ . '/../Model' . $folder_path . '/' . $model_name . 'Model.php';
            if (!file_exists($file_path)) {

                $table = $this->question("¿Que tabla tiene el modelo? \n");

                $plantilla = $this->getPlantilla('model');
                $plantilla = str_replace(['{{folder}}', '{{model}}', '{{table}}'],
                    [str_replace('/', '\\', $folder_path), $model_name, $table], $plantilla);
                @mkdir(dirname($file_path), 0777, true);
                file_put_contents($file_path, $plantilla);
            }
        }

        if ($type == 'handler' || $type == 'all') {
            $file_path = __DIR__ . '/../Handler' . $folder_path . '/' . $model_name . 'Handler.php';
            if (!file_exists($file_path)) {
                $plantilla = $this->getPlantilla('handler');
                $plantilla = str_replace(['{{folder}}', '{{model}}', '{{model_lower}}'],
                    [str_replace('/', '\\', $folder_path), $model_name, strtolower($model_name)], $plantilla);
                @mkdir(dirname($file_path), 0777, true);
                file_put_contents($file_path, $plantilla);
            }
            $file_path = __DIR__ . '/../Facades/Handler/' . $model_name . 'Handler.php';
            if (!file_exists($file_path)) {
                $plantilla = $this->getPlantilla('handler_facade');
                $plantilla = str_replace(['{{folder}}', '{{model}}'],
                    [str_replace('/', '\\', $folder_path), $model_name], $plantilla);
                @mkdir(dirname($file_path), 0777, true);
                file_put_contents($file_path, $plantilla);
            }
        }

        if ($type == 'factory' || $type == 'all') {
            $file_path = __DIR__ . '/../Factory' . $folder_path . '/' . $model_name . 'Factory.php';
            if (!file_exists($file_path)) {
                $plantilla = $this->getPlantilla('factory');
                $plantilla = str_replace(['{{folder}}', '{{model}}'],
                    [str_replace('/', '\\', $folder_path), $model_name], $plantilla);
                @mkdir(dirname($file_path), 0777, true);
                file_put_contents($file_path, $plantilla);
            }
            $file_path = __DIR__ . '/../Facades/Factory/' . $folder_path . '/' . $model_name . 'Factory.php';
            if (!file_exists($file_path)) {
                $plantilla = $this->getPlantilla('factory_facade');
                $plantilla = str_replace(['{{folder}}', '{{model}}'],
                    [str_replace('/', '\\', $folder_path), $model_name], $plantilla);
                @mkdir(dirname($file_path), 0777, true);
                file_put_contents($file_path, $plantilla);
            }
        }

        if ($type == 'form' || $type == 'all') {
            $form_path = __DIR__ . '/../Form' . $folder_path . '/' . $model_name . '/' . $model_name . 'Form.php';
            $filter_path = __DIR__ . '/../Form' . $folder_path . '/' . $model_name . '/' . $model_name . 'Filter.php';
            $validation_path = __DIR__ . '/../Form' . $folder_path . '/' . $model_name . '/' . $model_name . 'Validation.php';
            @mkdir(dirname($form_path), 0777, true);
            if (!file_exists($form_path)) {
                $plantilla = $this->getPlantilla('form');
                $plantilla = str_replace(['{{folder}}', '{{model}}'],
                    [str_replace('/', '\\', $folder_path), $model_name], $plantilla);
                file_put_contents($form_path, $plantilla);
            }
            if (!file_exists($filter_path)) {
                $plantilla = $this->getPlantilla('filter');
                $plantilla = str_replace(['{{folder}}', '{{model}}'],
                    [str_replace('/', '\\', $folder_path), $model_name], $plantilla);
                file_put_contents($filter_path, $plantilla);
            }
            if (!file_exists($validation_path)) {
                $plantilla = $this->getPlantilla('validation');
                $plantilla = str_replace(['{{folder}}', '{{model}}'],
                    [str_replace('/', '\\', $folder_path), $model_name], $plantilla);
                file_put_contents($validation_path, $plantilla);
            }
        }


        if ($type == 'route' || $type == 'all') {
            $scope = $this->question("¿En que scope quieres guardarlo? \n");
            $prefix = $this->question("¿Que prefijo tendran las rutas? \n");

            $file_path = __DIR__ . '/../Routes/' . strtolower($scope) . $folder_path . '/' . $model_name . '_route.php';
            if (!file_exists($file_path)) {
                $plantilla = $this->getPlantilla('route');
                $plantilla = str_replace(['{{folder}}', '{{model}}', '{{scope}}', '{{prefix}}'],
                    [str_replace('/', '\\', $folder_path), $model_name, $scope, $prefix], $plantilla);
                @mkdir(dirname($file_path), 0777, true);
                file_put_contents($file_path, $plantilla);
            }

            $file_path = __DIR__ . '/../Filter/' . $scope . '/' . $model_name . 'Filter.php';
            if (!file_exists($file_path)) {
                $plantilla = $this->getPlantilla('filter_route');
                $plantilla = str_replace(['{{folder}}', '{{model}}', '{{model_lower}}', '{{scope}}'],
                    [str_replace('/', '\\', $folder_path), $model_name, strtolower($model_name), $scope], $plantilla);
                @mkdir(dirname($file_path), 0777, true);
                file_put_contents($file_path, $plantilla);
            }

        }

        if ($type == 'controller' || $type == 'all') {
            if (empty($scope)) {
                $scope = $this->question("¿En que scope quieres guardarlo? \n");
            }
            if (empty($prefix)) {
                $prefix = $this->question("¿Que prefijo tienen las rutas? \n");
            }
            $add_file_path = __DIR__ . '/../Controller/' . $scope . $folder_path . '/' . $model_name . '/AddController.php';
            $edit_file_path = __DIR__ . '/../Controller/' . $scope . $folder_path . '/' . $model_name . '/EditController.php';
            $delete_file_path = __DIR__ . '/../Controller/' . $scope . $folder_path . '/' . $model_name . '/DeleteController.php';
            $home_file_path = __DIR__ . '/../Controller/' . $scope . $folder_path . '/' . $model_name . '/HomeController.php';
            $view_file_path = __DIR__ . '/../ViewsBuilder/' . $scope . '/Pages/' . $model_name . 'Page.php';
            $view_message_file_path = __DIR__ . '/../ViewsBuilder/' . $scope . '/Messages/' . $model_name . 'Message.php';

            @mkdir(dirname($add_file_path), 0777, true);
            @mkdir(dirname($view_file_path), 0777, true);

            if (!file_exists($add_file_path)) {
                $plantilla = $this->getPlantilla('controller_add');
                $plantilla = str_replace(['{{folder}}', '{{model}}', '{{scope}}', '{{prefix}}'],
                    [str_replace('/', '\\', $folder_path), $model_name, $scope, $prefix], $plantilla);
                file_put_contents($add_file_path, $plantilla);
            }

            if (!file_exists($edit_file_path)) {
                $plantilla = $this->getPlantilla('controller_edit');
                $plantilla = str_replace(['{{folder}}', '{{model}}', '{{scope}}', '{{model_lower}}', '{{prefix}}'],
                    [str_replace('/', '\\', $folder_path), $model_name, $scope, strtolower($model_name), $prefix],
                    $plantilla);
                file_put_contents($edit_file_path, $plantilla);
            }

            if (!file_exists($delete_file_path)) {
                $plantilla = $this->getPlantilla('controller_delete');
                $plantilla = str_replace(['{{folder}}', '{{model}}', '{{scope}}', '{{model_lower}}', '{{prefix}}'],
                    [str_replace('/', '\\', $folder_path), $model_name, $scope, strtolower($model_name), $prefix],
                    $plantilla);
                file_put_contents($delete_file_path, $plantilla);
            }

            if (!file_exists($home_file_path)) {
                $plantilla = $this->getPlantilla('controller_home');
                $plantilla = str_replace(['{{folder}}', '{{model}}', '{{scope}}', '{{model_lower}}', '{{prefix}}'],
                    [str_replace('/', '\\', $folder_path), $model_name, $scope, strtolower($model_name), $prefix],
                    $plantilla);
                file_put_contents($home_file_path, $plantilla);
            }

            if (!file_exists($view_file_path)) {

                $plantilla = $this->getPlantilla('viewbuilder');
                $plantilla = str_replace(['{{folder}}', '{{model}}', '{{scope}}', '{{prefix}}'],
                    [str_replace('/', '\\', $folder_path), $model_name, $scope, $prefix], $plantilla);
                file_put_contents($view_file_path, $plantilla);
            }

            if (!file_exists($view_message_file_path)) {

                $plantilla = $this->getPlantilla('viewbuildermessage');
                $plantilla = str_replace(['{{folder}}', '{{model}}', '{{scope}}', '{{prefix}}'],
                    [str_replace('/', '\\', $folder_path), $model_name, $scope, $prefix], $plantilla);
                file_put_contents($view_message_file_path, $plantilla);
            }
        }

        if ($type == 'views' || $type == 'all') {

            if (empty($scope)) {
                $scope = $this->question("¿En que scope quieres guardarlo? \n");
            }
            if (empty($prefix)) {
                $prefix = $this->question("¿Que prefijo tendran las rutas? \n");
            }

            $file_add_path = __DIR__ . '/../Views/' . $scope . '/_gen/views/pages/' . $prefix . '/add.haml';
            $file_edit_path = __DIR__ . '/../Views/' . $scope . '/_gen/views/pages/' . $prefix . '/edit.haml';
            $file_delete_path = __DIR__ . '/../Views/' . $scope . '/_gen/views/pages/' . $prefix . '/delete.haml';
            $file_list_path = __DIR__ . '/../Views/' . $scope . '/_gen/views/pages/' . $prefix . '/list.haml';

            $file_message_add_path = __DIR__ . '/../Views/' . $scope . '/_gen/views/messages/' . $prefix . '/success_add.haml';
            $file_message_edit_path = __DIR__ . '/../Views/' . $scope . '/_gen/views/messages/' . $prefix . '/success_edit.haml';

            @mkdir(dirname($file_add_path), 0777, true);
            @mkdir(dirname($file_message_add_path), 0777, true);

            if (!file_exists($file_add_path)) {
                $plantilla = $this->getPlantillaHaml('views/pages/add');
                $plantilla = str_replace(['{{model}}', '{{scope}}', '{{model_lower}}', '{{prefix}}'],
                    [$model_name, $scope, strtolower($model_name), $prefix],
                    $plantilla);
                file_put_contents($file_add_path, $plantilla);
            }

            if (!file_exists($file_edit_path)) {
                $plantilla = $this->getPlantillaHaml('views/pages/edit');
                $plantilla = str_replace(['{{model}}', '{{scope}}', '{{model_lower}}', '{{prefix}}'],
                    [$model_name, $scope, strtolower($model_name), $prefix],
                    $plantilla);
                file_put_contents($file_edit_path, $plantilla);
            }

            if (!file_exists($file_delete_path)) {
                $plantilla = $this->getPlantillaHaml('views/pages/delete');
                $plantilla = str_replace(['{{model}}', '{{scope}}', '{{model_lower}}', '{{prefix}}'],
                    [$model_name, $scope, strtolower($model_name), $prefix],
                    $plantilla);
                file_put_contents($file_delete_path, $plantilla);
            }

            if (!file_exists($file_list_path)) {
                $plantilla = $this->getPlantillaHaml('views/pages/list');
                $plantilla = str_replace(['{{model}}', '{{scope}}', '{{model_lower}}', '{{prefix}}'],
                    [$model_name, $scope, strtolower($model_name), $prefix],
                    $plantilla);
                file_put_contents($file_list_path, $plantilla);
            }

            if (!file_exists($file_message_add_path)) {
                $plantilla = $this->getPlantillaHaml('views/messages/success_add');
                $plantilla = str_replace(['{{model}}', '{{scope}}', '{{model_lower}}', '{{prefix}}'],
                    [$model_name, $scope, strtolower($model_name), $prefix],
                    $plantilla);
                file_put_contents($file_message_add_path, $plantilla);
            }

            if (!file_exists($file_message_edit_path)) {
                $plantilla = $this->getPlantillaHaml('views/messages/success_edit');
                $plantilla = str_replace(['{{model}}', '{{scope}}', '{{model_lower}}', '{{prefix}}'],
                    [$model_name, $scope, strtolower($model_name), $prefix],
                    $plantilla);
                file_put_contents($file_message_edit_path, $plantilla);
            }


        }

        $this->success("Success! You've ran the task $model_name => $type!");
    }

    public function getPlantilla($type)
    {
        return file_get_contents(__DIR__ . "/plantillas/$type.php.txt");
    }

    public function getPlantillaHaml($type)
    {
        return file_get_contents(__DIR__ . "/plantillas/$type.haml");
    }

}
