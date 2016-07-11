<?php

namespace App\Command;


use Buuum\Ftp\Connection;
use Buuum\Ftp\FtpWrapper;
use Buuum\Git;
use Buuum\Zip\Zip;

class FtpCommand extends AbstractCommand
{

    protected $environment_name;
    protected $environment;
    /**
     * @var FtpWrapper
     */
    protected $ftp;

    /**
     * @var Git
     */
    protected $git;

    protected function configure()
    {
        $this
            ->setName('ftp')
            ->setDescription('upload changes on server');
    }

    protected function fire()
    {
        $time = microtime(true);

        $option = $this->selectOption();
        $this->environment = $this->setEnvironment();

        $this->$option();

        $this->success(microtime(true) - $time);

    }

    protected function upload()
    {
        $this->setFtp();
        $this->setGit();

        $commits = $this->git->getCommits();
        $commits = array_keys($commits);
        $commits_server = $this->getCommits();

        $diffs = (array_diff($commits, $commits_server));

        if (count($diffs) <= 0) {
            $this->success('Todo esta actualizado!');
        } else {

            $base_path = $this->container->get('config')->get('paths.root');

            $files = $this->git->getDiff(count($diffs));

            $files = $this->parseGitFiles($files);

            $update = !empty($files);

            if (!empty($files['delete'])) {
                $this->comment('elementos a borrar');
                foreach ($files['delete'] as $file) {
                    $this->ftp->delete($file);
                    $this->success("$file > eliminado");
                }
            }

            if (!empty($files['add'])) {

                $zip_path = __DIR__ . '/../../temp/deploy.zip';
                $zip = Zip::create($zip_path);

                $this->comment('elementos a subir');

                foreach ($files['add'] as $file) {
                    $zip->add($base_path . '/' . $file, $file);
                    $this->success("$file > adjuntado");
                }

                $zip->close();

                $this->ftp->put('httpdocs/Zip.php', __DIR__ . '/../../vendor/buuum/zip/src/Zip/Zip.php');
                $this->ftp->put('deploy.zip', $zip_path);
                unlink($zip_path);

                $temp_unzip_path = __DIR__ . '/_un';
                file_put_contents($temp_unzip_path, $this->getPlantillaUnzip());
                $this->ftp->put('httpdocs/unzip.php', $temp_unzip_path);
                unlink($temp_unzip_path);

                // descomprimimos el zip en servidor
                $host = 'http://' . $this->environment['host'] . '/unzip.php';
                file_get_contents($host);


            }

            if($update)
            {
                // update commits
                $temp_commits_path = __DIR__ . '/_c';
                $this->createCommits($temp_commits_path);
                $this->ftp->put('commits/commits.json', $temp_commits_path);
                unlink($temp_commits_path);

                $this->success("Todo esta actualizado.");
            }

        }

    }

    protected function sync()
    {
        $this->setFtp();
        $this->setGit();

        $temp_commits_path = __DIR__ . '/_c';
        $this->createCommits($temp_commits_path);
        $this->ftp->put('commits/commits.json', $temp_commits_path);
        unlink($temp_commits_path);
    }

    protected function updatevendor()
    {

        $this->setFtp();
        $this->setGit();

        $path = $this->container->get('config')->get('paths.root');

        $option = $this->selectOptionVendor($path);

        $zip_path = __DIR__ . '/../../temp/deploy.zip';
        $zip = Zip::create($zip_path);

        if ($option != 'actualizar todo') {
            $files = $this->rglob($path . '/vendor/' . $option . '*');

            foreach ($files as $n => $file) {
                $rfile = str_replace($path . '/', '', $file);
                if(!is_dir($file)){
                    $zip->add($file, $rfile);
                }
            }

            $files = $this->rglob($path . '/vendor/composer/*');

            foreach ($files as $n => $file) {
                $rfile = str_replace($path . '/', '', $file);
                if(!is_dir($file)){
                    $zip->add($file, $rfile);
                }
            }

            $zip->add($path . '/vendor/autoload.php', 'vendor/autoload.php');

        } else {
            $files = $this->rglob($path . '/vendor/*');
            foreach ($files as $n => $file) {
                $rfile = str_replace($path . '/', '', $file);
                if(!is_dir($file)){
                    $zip->add($file, $rfile);
                }
            }
        }

        $zip->close();

        $this->ftp->put('httpdocs/Zip.php', __DIR__ . '/../../vendor/buuum/zip/src/Zip/Zip.php');
        $this->ftp->put('deploy.zip', $zip_path);
        unlink($zip_path);

        $temp_unzip_path = __DIR__ . '/_un';
        file_put_contents($temp_unzip_path, $this->getPlantillaUnzip());
        $this->ftp->put('httpdocs/unzip.php', $temp_unzip_path);
        unlink($temp_unzip_path);

        // descomprimimos el zip en servidor
        $host = 'http://' . $this->environment['host'] . '/unzip.php';
        file_get_contents($host);


        $this->success($option);

    }

    protected function selectOptionVendor($path)
    {
        $paths = glob($path . '/vendor/*', GLOB_MARK | GLOB_ONLYDIR | GLOB_NOSORT);
        $folders = [];
        foreach ($paths as $_path) {
            $folders[] = str_replace($path . '/vendor/', '', $_path);
        }
        $folders[] = 'actualizar todo';
        return $this->choiceQuestion('¿Que quieres actualizar?', $folders);
    }

    protected function demo()
    {

        $this->setFtp();

        // change config.php with environment required
        $temp_config_path = __DIR__ . '/_conf.php';
        $config_path = $this->container->get('config')->get('paths.config');
        $arr = include $config_path;

        $arr['environment'] = $this->environment_name;

        file_put_contents($temp_config_path, "<?php return " . var_export($arr, true) . ";");
        $this->ftp->put('app/config.php', $temp_config_path);
        unlink($temp_config_path);

    }

    protected function start()
    {
        $this->setFtp();
        $this->setGit();
        if ($commits = $this->getCommits()) {
            $this->error('ya esta iniciado el proyecto en el servidor');
        } else {
            $this->success('iniciamos el proyecto en el servidor');
            $base_path = $this->container->get('config')->get('paths.root');
            $files = $this->rglob($base_path . '/*');

            $files = $this->ignoreFiles($files);

            // create a zip
            $zip_path = __DIR__ . '/../../temp/deploy.zip';
            $zip = Zip::create($zip_path);

            foreach ($files as $n => $file) {
                $rfile = str_replace($base_path . '/', '', $file);
                $zip->add($file, $rfile);
            }

            $zip->add($base_path . '/.htaccess', '.htaccess');
            $zip->add($base_path . '/httpdocs/.htaccess', 'httpdocs/.htaccess');
            $zip->add($base_path . '/httpdocs/.maintenance.php', 'httpdocs/.maintenance.php');

            $zip->close();

            $this->ftp->put('httpdocs/Zip.php', __DIR__ . '/../../vendor/buuum/zip/src/Zip/Zip.php');
            $this->ftp->put('deploy.zip', $zip_path);
            unlink($zip_path);

            $temp_unzip_path = __DIR__ . '/_un';
            file_put_contents($temp_unzip_path, $this->getPlantillaUnzip());
            $this->ftp->put('httpdocs/unzip.php', $temp_unzip_path);
            unlink($temp_unzip_path);

            // initalize temp and log folder with 0777
            $this->ftp->mkdir('temp');
            $this->ftp->chmod(0777, 'temp');
            $this->ftp->mkdir('log');
            $this->ftp->chmod(0777, 'log');

            // initialize commits/commits.json
            $temp_commits_path = __DIR__ . '/_c';
            $this->createCommits($temp_commits_path);
            $this->ftp->put('commits/commits.json', $temp_commits_path);
            unlink($temp_commits_path);

            // change config.php with environment required
            $temp_config_path = __DIR__ . '/_conf.php';
            $config_path = $this->container->get('config')->get('paths.config');
            $arr = include $config_path;

            $arr['environment'] = $this->environment_name;

            file_put_contents($temp_config_path, "<?php return " . var_export($arr, true) . ";");
            $rfile = str_replace(dirname($config_path) . '/', '', $temp_config_path);
            $this->ftp->put(dirname($rfile) . '/config.php', $temp_config_path);
            unlink($temp_config_path);

            // descomprimimos el zip en servidor
            $host = 'http://' . $this->environment['host'] . '/unzip.php';
            file_get_contents($host);


        }
    }

    protected function viewchanges()
    {

        $this->setGit();
        $this->setFtp();

        $commits = $this->git->getCommits();
        $commits = array_keys($commits);
        $commits_server = $this->getCommits();

        $diffs = (array_diff($commits, $commits_server));

        if (count($diffs) <= 0) {
            $this->success('Todo esta actualizado');
        } else {
            $this->comment("Hay " . count($diffs) . " commits para actualizar");
            $this->comment('Los archivos a actualizar son:');
            $this->comment(print_r($this->git->getDiff(count($diffs))));
        }


    }

    protected function selectOption()
    {
        return $this->choiceQuestion('Selecciona la acción a realizar.', [
            'viewchanges',
            'upload',
            'sync',
            'start',
            'updatevendor',
            'demo'
        ]);
    }

    protected function setEnvironment()
    {
        $environments = $this->container->get('config')->get('environments');
        $environments_list = array_keys($environments);
        $this->environment_name = $this->choiceQuestion("¿Que environment usamos?\n", $environments_list);

        return $environments[$this->environment_name];
    }

    protected function setGit()
    {
        $repository_path = $this->container->get('config')->get('paths.root');
        $this->git = new Git($repository_path);
    }

    protected function setFtp()
    {

        $host = $this->environment['ftp']['host'];
        $username = $this->environment['ftp']['user'];
        $password = $this->environment['ftp']['password'];

        $connection = new Connection($host, $username, $password);

        try {
            $connection->open();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            die;
        }

        $this->ftp = new FtpWrapper($connection);

    }

    protected function getCommits()
    {
        $temp = $this->container->get('config')->get('paths.storage');
        $temp .= '/commits.json';
        $this->comment($temp);

        if (@$this->ftp->get($temp, 'commits/commits.json')) {
            $commits = json_decode(file_get_contents($temp));
            unlink($temp);
            return $commits;
        }

        return false;
    }

    protected function rglob($pattern = '*', $flags = 0, $path = false)
    {
        if (!$path) {
            $path = dirname($pattern) . DIRECTORY_SEPARATOR;
        }
        $pattern = basename($pattern);
        $paths = glob($path . '*', GLOB_MARK | GLOB_ONLYDIR | GLOB_NOSORT);
        $files = glob($path . $pattern, $flags);
        foreach ($paths as $path) {
            $files = array_merge($files, $this->rglob($pattern, $flags, $path));
        }
        return $files;
    }

    protected function ignoreFiles($files)
    {
        $files_upload = [];
        $base_path = $this->container->get('config')->get('paths.root');

        $ignore_folders = [
            '.sass-cache',
            'bower_components',
            'node_modules',
            'temp',
            'log'
        ];

        $ignore_files = [
            '.gitignore',
            'bower.json',
            'composer.json',
            'composer.lock',
            'Gruntfile.coffee',
            'package.json',
            'README.md'
        ];

        foreach ($files as $file) {

            $ignore = false;

            if (is_dir($file)) {
                continue;
            }

            foreach ($ignore_folders as $ignore_folder) {
                if (strpos($file, $base_path . '/' . $ignore_folder) !== false) {
                    $ignore = true;
                    break;
                }
            }
            if ($ignore) {
                continue;
            }

            foreach ($ignore_files as $ignore_file) {
                if (strpos($file, $base_path . '/' . $ignore_file) !== false) {
                    $ignore = true;
                    break;
                }
            }
            if ($ignore) {
                continue;
            }

            $files_upload[] = $file;

        }

        return $files_upload;
    }


    private function createCommits($temp_commits_path)
    {

        $commits = $this->git->getCommits();
        $commits = array_keys($commits);
        $coms = [];
        foreach ($commits as $commit) {
            $coms[] = $commit;
        }
        file_put_contents($temp_commits_path, json_encode($coms));
    }

    private function getPlantillaUnzip()
    {

        $var = <<<EOF
        <?php
        require __DIR__ . '/Zip.php';

        \$zip = \Buuum\Zip\Zip::open(__DIR__.'/../deploy.zip');
        \$zip->extract(__DIR__.'/..');
        \$zip->close();

        unlink(__DIR__.'/../deploy.zip');
        unlink(__DIR__.'/Zip.php');
        unlink(__DIR__.'/unzip.php');
EOF;

        return $var;

    }

    private function parseGitFiles($files)
    {
        $files_ = [];
        foreach ($files as $file) {
            $type = substr($file, 0, 1);
            $file = trim(substr($file, 1));
            if ($type == 'M' || $type == 'A') {
                $files_['add'][] = $file;
            } elseif ($type == 'D') {
                $files_['delete'][] = $file;
            }
        }
        return $files_;
    }
}
