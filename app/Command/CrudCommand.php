<?php namespace App\Command;

use Buuum\Template\Template;
use Symfony\Component\Console\Input\InputArgument;

class CrudCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('crud')
            ->setDescription('Generate base CRUD')
            ->addArgument(
                'type',
                InputArgument::OPTIONAL,
                '¿Que quires crear (form, route, validation, handler, controller)?'
            );
    }

    protected function fire()
    {
        $type = $this->input->getArgument('type');

        $modelgroup = $this->question("¿En que carpeta esta el modelo?\n");
        $model = $this->question("¿Que modelo quieres crear?\n");

        $model_lower = strtolower($model);
        if (!empty($modelgroup)) {
            $modelgroup .= "\\";
        }

        if ($type == 'routes' || $type == 'all'){
            $message = $this->getPlantilla('routes.ph', $modelgroup, $model, $model_lower, '', '');
            $this->comment($message);
        }

        if ($type == 'validation' || $type == 'all') {
            $dir_to_save = __DIR__ . '/../Validation';
            file_put_contents($dir_to_save . '/' . $model . '.php',
                $this->getPlantilla('Validation.ph', $modelgroup, $model, $model_lower, '', ''));
        }

        if ($type == 'forms' || $type == 'all') {
            $scope = $this->question("¿En que scope quieres crear los formularios?\n");

            $dir_to_save = __DIR__ . '/../Form/' . $model;
            mkdir($dir_to_save, 0777, true);

            file_put_contents($dir_to_save . '/FormAdd.php',
                $this->getPlantilla('FormAdd.ph', $modelgroup, $model, $model_lower, '', ''));

            file_put_contents($dir_to_save . '/FormEdit.php',
                $this->getPlantilla('FormEdit.ph', $modelgroup, $model, $model_lower, '', ''));

            file_put_contents($dir_to_save . '/FormDelete.php',
                $this->getPlantilla('FormDelete.ph', $modelgroup, $model, $model_lower, '', ''));

            $dir_to_save = __DIR__ . '/../Views/' . $scope . '/_gen/views/forms/' . $model_lower;
            mkdir($dir_to_save, 0777, true);

            file_put_contents($dir_to_save . '/add.haml',
                $this->getPlantilla('add.haml', $modelgroup, $model, $model_lower, '', ''));

            file_put_contents($dir_to_save . '/edit.haml',
                $this->getPlantilla('edit.haml', $modelgroup, $model, $model_lower, '', ''));

            file_put_contents($dir_to_save . '/delete.haml',
                $this->getPlantilla('delete.haml', $modelgroup, $model, $model_lower, '', ''));


        }

        if ($type == 'handler' || $type == 'all') {
            $dir_to_save = __DIR__ . '/../Handler';
            file_put_contents($dir_to_save . '/' . $model . 'Handler.php',
                $this->getPlantilla('Handler.ph', $modelgroup, $model, $model_lower, '', ''));
        }


        if ($type == 'controller' || $type == 'all') {

            $scope = $this->question("¿En que scope quieres crear los controladores?\n");
            $fields = $this->question("¿que campos tiene el modelo?\n");

            $fields = explode(' ', $fields);
            $fields_ = [];
            foreach ($fields as $field) {
                $fields_[] = "'$field'";
            }
            $fields_ = implode(',', $fields_);

            $dir_to_save = __DIR__ . '/../Controller/' . $scope . '/' . $model;
            mkdir($dir_to_save, 0777, true);

            file_put_contents($dir_to_save . '/Home.php',
                $this->getPlantilla('Home.ph', $modelgroup, $model, $model_lower, $scope, $fields_));
            file_put_contents($dir_to_save . '/Add.php',
                $this->getPlantilla('Add.ph', $modelgroup, $model, $model_lower, $scope, $fields_));
            file_put_contents($dir_to_save . '/Edit.php',
                $this->getPlantilla('Edit.ph', $modelgroup, $model, $model_lower, $scope, $fields_));
            file_put_contents($dir_to_save . '/Delete.php',
                $this->getPlantilla('Delete.ph', $modelgroup, $model, $model_lower, $scope, $fields_));
        }


        $this->success("Success! You've ran the task $model!");
    }

    public function getPlantilla($type, $modelgroup, $model, $model_lower, $scope, $fields_)
    {
        $home = file_get_contents(__DIR__ . "/../../temp/plantillas/crud/$type");
        return str_replace(['{{model_group}}', '{{model}}', '{{model_lower}}', '{{scope}}', '{{fields}}'],
            [$modelgroup, $model, $model_lower, $scope, $fields_], $home);
    }

}
