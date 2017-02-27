<?php

namespace App\Command;

use Buuum\Backup;
use Buuum\StructDiff;

class DBCommand extends AbstractCommand
{

    protected $environment;
    protected $tmp_path;
    /**
     * @var Backup
     */
    protected $db_connection;

    protected function configure()
    {
        $this
            ->setName('db')
            ->setDescription('synch changes bewteen db');
    }

    protected function fire()
    {

        $paths = $this->container->get('paths');
        $this->tmp_path = $paths['storage'];

        $option = $this->selectOption();

        $time = microtime(true);

        $this->$option();

        $this->success(microtime(true) - $time);

    }

    protected function selectOption()
    {
        $functions = [
            'viewchanges' => 'ver cambios entre DB',
            'upload'      => 'subir cambios entr DB',
            'backup'      => 'crear DB backup'
        ];

        $question = $this->choiceQuestion('Selecciona la acción a realizar.', array_values($functions));
        return array_search($question, $functions);
    }

    protected function upload()
    {
        $diffs_up = $this->viewchanges();
        if(!empty($diffs_up)){
            $this->db_connection->executeSql(implode(';',$diffs_up));
            $this->success('Actualización completada.');
        }
    }

    protected function backup()
    {
        $config_environment = $this->selectDB('¿De que base de datos quieres hacer el backup?');
        $backup = new Backup($config_environment['host'], $config_environment['bbdd']['username'],
            $config_environment['bbdd']['password'], $config_environment['bbdd']['database']);
        $backup->backup();
        $backup->save(time() . '_' . $config_environment['bbdd']['database'], $this->tmp_path);
        $this->success('Backup realizado correctamente.');
    }

    protected function viewchanges()
    {
        $config_base = $this->selectDB('¿Que base de datos quieres coger como base?');
        $config_remote = $this->selectDB('¿Con que base datos quieres comparar?');

        $backup = new Backup($config_base['host'], $config_base['bbdd']['username'],
            $config_base['bbdd']['password'], $config_base['bbdd']['database']);
        $backup->backup('*', true, false);
        $backup->save('_tmp_local', $this->tmp_path);

        $this->db_connection = new Backup($config_remote['host'], $config_remote['bbdd']['username'],
            $config_remote['bbdd']['password'], $config_remote['bbdd']['database']);
        $this->db_connection->backup('*', true, false);
        $this->db_connection->save('_tmp_remote', $this->tmp_path);

        $local = file_get_contents($this->tmp_path . '/_tmp_local.sql');
        $remote = file_get_contents($this->tmp_path . '/_tmp_remote.sql');

        $differ = new StructDiff($local, $remote);

        $diffs_up = $differ->getUpdates($remote, $local);
        if(!empty($diffs_up)){
            $this->success("Cambios a realizar:\n");
            foreach($diffs_up as $diff){
                $this->comment($diff);
            }
        }else{
            $this->success('Las estructuras de las bbdds son iguales.');
        }

        unlink($this->tmp_path . '/_tmp_local.sql');
        unlink($this->tmp_path . '/_tmp_remote.sql');

        return $diffs_up;

    }

    protected function selectDB($question)
    {
        $environments = $this->container->get('config')->get('environments');
        $environments_list = [];
        $environments_by_host = [];
        foreach ($environments as $environment) {
            $environments_list[] = $environment['host'];
            $environments_by_host[$environment['host']] = $environment;
        }

        $environment_host = $this->choiceQuestion("$question\n", $environments_list);

        return $environments_by_host[$environment_host];
    }


}
