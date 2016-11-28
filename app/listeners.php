<?php

use Buuum\Event;

return function(Event $event){

    $event->addListener('email.send.confirm', function($event){
        var_dump($event);
    });

    $event->addListener('email.send.rememberme', [App\Controller\Admin\Blog\Category\Add::class, 'demo']);

};