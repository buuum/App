<?php namespace App\Command;


class MailCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('mail')
            ->setDescription('Sending mails');
    }

    protected function fire()
    {

        $mailhandler = $this->container->get('mailhandler');
        $mailhandler->sendSpooledMessages();

        $this->comment('messages send');
    }
}
