<?php namespace App\Command;

use Buuum\Template\Template;
use Symfony\Component\Console\Input\InputArgument;

class GruntCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('grunt')
            ->setDescription('Set bower paths components')
            ->addArgument(
                'type',
                InputArgument::OPTIONAL,
                '¿Que accion quieres realizar?'
            )->addArgument(
                'folder',
                InputArgument::OPTIONAL,
                '¿que carpeta?'
            )->addArgument(
                'file',
                InputArgument::OPTIONAL,
                '¿que archivo?'
            );
    }

    protected function fire()
    {
        $type = $this->input->getArgument('type');
        if ($type == 'bower') {
            $this->change();
        } elseif ($type == 'template') {
            $folder = $this->input->getArgument('folder');
            $file = $this->input->getArgument('file');

            $paths = $this->container->get('paths');
            $path = $paths['views'] . '/' . $folder . '/public';

            new Template($path, $file);

            $this->success('template ' . $folder . ' - ' . $file);
        } elseif ($type == 'templatechars') {
            $folder = $this->input->getArgument('folder');
            $file = $this->input->getArgument('file');

            $paths = $this->container->get('paths');
            $path = $paths['views'] . '/' . $folder . '/public';

            new Template($path, $file, true);
            $this->success('templatechars ' . $folder . ' - ' . $file);
        } elseif ($type == 'updateversion') {
            $file = __DIR__ . '/../../version.json';
            $config = json_decode(file_get_contents($file), true);
            $config['version'] = $config['version'] + 0.01;
            file_put_contents($file, json_encode($config, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        }
        $this->success("Success! You've ran the task!");
    }

    public function change()
    {

        $fontplugins = array(

            // bootstrap glyphicons
            'bootstrap'    => array(
                'files_change' => array(
                    'dist/css/bootstrap.min.css'
                ),
                'replaces'     => array(
                    '../fonts' => 'plugins/bootstrap/dist/fonts'
                )
            ),

            // font awesome icons
            'font-awesome' => array(
                'files_change' => array(
                    'css/font-awesome.css'
                ),
                'replaces'     => array(
                    '../fonts' => 'plugins/font-awesome/fonts'
                ),
                // 'rename_folder' => 'fontawesome'
            ),

            // font awesome icons
            'summernote' => array(
                'files_change' => array(
                    'dist/summernote.css'
                ),
                'replaces'     => array(
                    'font/' => 'plugins/summernote/dist/font/'
                ),
                // 'rename_folder' => 'fontawesome'
            ),

            // images datatables //
            'datatables'   => array(
                'files_change' => array(
                    'media/css/jquery.dataTables.css'
                ),
                'replaces'     => array(
                    '../images' => 'plugins/datatables/media/images'
                )
            ),

            'chosen' => array(
                'files_change' => array(
                    'chosen.css'
                ),
                'replaces'     => array(
                    'chosen-sprite' => 'plugins/chosen/chosen-sprite'
                )
            ),


        );

        $this->changePaths($fontplugins);
    }

    private function changePaths($fontplugins)
    {

        $paths = $this->container->get('paths');
        $path = $paths['public'] . '/assets/plugins/';

        foreach ($fontplugins as $folder => $plugin) {

            $folder_ = $path . $folder . '/';
            foreach ($plugin['files_change'] as $filec) {
                if (file_exists($folder_ . $filec)) {
                    $output = file_get_contents($folder_ . $filec);
                    foreach ($plugin['replaces'] as $replace => $new) {
                        $output = str_replace($replace, $new, $output);
                    }
                    file_put_contents($folder_ . $filec, $output);
                }
            }

            if (!empty($plugin['rename_folder'])) {
                rename($path . $folder, $path . $plugin['rename_folder']);
            }

        }

    }
}
