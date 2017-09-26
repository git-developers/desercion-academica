<?php

namespace BackendBundle\Services;

use Gos\Bundle\WebSocketBundle\Topic\TopicInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;
use Gos\Bundle\WebSocketBundle\Router\WampRequest;
use Gos\Bundle\WebSocketBundle\Topic\PushableTopicInterface;

//DOCUMENT :: https://github.com/GeniusesOfSymfony/WebSocketBundle/blob/master/Resources/docs/Pusher.md
//DOCUMENT :: https://github.com/GeniusesOfSymfony/WebSocketBundle
// se instalo :: sudo dnf install zeromq
//sudo touch /etc/php.d/zmq.ini
//echo 'extension=zmq.so' >> /etc/php.d/zmq.ini

//INSTALAR :: http://zeromq.org/bindings:php
//sudo dnf install php-devel
// se instalo :: sudo dnf install zeromq
//sudo dnf install  zeromq-devel

//********
//SALIA ERROR :: PHP Warning:  PHP Startup: Unable to load dynamic library '/usr/lib64/php/modules/zmq.so' - /usr/lib64/php/modules/zmq.so: cannot open shared object file: No such file or directory in Unknown on line 0
//IMPORTANTE :: sudo pecl install zmq-beta // configuration option "php_ini" is not set to php.ini location - You should add "extension=zmq.so" to php.ini


class GoogleDriveTopic implements TopicInterface, PushableTopicInterface
{

    public function onPush(Topic $topic, WampRequest $request, $data, $provider) {
        $topic->broadcast($data);
    }

    /**
     * This will receive any Subscription requests for this topic.
     *
     * @param ConnectionInterface $connection
     * @param Topic $topic
     * @param WampRequest $request
     * @return void
     */
    public function onSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
        //this will broadcast the message to ALL subscribers of this topic.
        $topic->broadcast(['msg' => $connection->resourceId . " has joined " . $topic->getId()]);
    }

    /**
     * This will receive any UnSubscription requests for this topic.
     *
     * @param ConnectionInterface $connection
     * @param Topic $topic
     * @param WampRequest $request
     * @return void
     */
    public function onUnSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
        //this will broadcast the message to ALL subscribers of this topic.
        $topic->broadcast(['msg' => $connection->resourceId . " has left " . $topic->getId()]);
    }

    /**
     * This will receive any Publish requests for this topic.
     *
     * @param ConnectionInterface $connection
     * @param Topic $topic
     * @param WampRequest $request
     * @param $event
     * @param array $exclude
     * @param array $eligible
     * @return mixed|void
     */
    public function onPublish(ConnectionInterface $connection, Topic $topic, WampRequest $request, $event, array $exclude, array $eligible)
    {
        /*
            $topic->getId() will contain the FULL requested uri, so you can proceed based on that

            if ($topic->getId() === 'acme/channel/shout')
               //shout something to all subs.
        */

        $topic->broadcast([
            'msg' => $event,
        ]);
    }

    /**
     * Like RPC is will use to prefix the channel
     * @return string
     */
    public function getName()
    {
        return 'googledrive.topic';
    }
}