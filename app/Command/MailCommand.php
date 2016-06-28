<?php namespace App\Command;

use App\Services\Mailer;
use Symfony\Component\Console\Input\InputArgument;

class MailCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('mail')
            ->setDescription('Sending mails')
            ->addArgument(
                'to',
                InputArgument::OPTIONAL,
                '¿A quien?'
            )->addArgument(
                'type',
                InputArgument::OPTIONAL,
                '¿que template?'
            );
    }

    protected function fire()
    {
        $to = $this->input->getArgument('to');
        $type = $this->input->getArgument('type');

        if ($type == 'confirm') {
            Mailer::sendConfirm($to);
        }elseif ($type == 'reset') {
            Mailer::sendReset($to);
        }

    }
}
