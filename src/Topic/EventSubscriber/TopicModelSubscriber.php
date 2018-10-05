<?php

namespace App\Topic\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Gos\Bundle\WebSocketBundle\DataCollector\PusherDecorator ;
use App\Topic\TopicModelInterface;



class TopicModelSubscriber implements EventSubscriber
{
    protected $pusher;
    public function __construct(PusherDecorator $pusher)
    {
        $this->pusher = $pusher;
    }

    public function getSubscribedEvents()
    {
        return [
            'postPersist',
            'postUpdate',
            'preRemove'
        ];
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof TopicModelInterface) {
            $this->doPush("deleted",$entity->toTopicModelArray(),$entity->getTopicModelName());  
        }
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof TopicModelInterface) {
                $this->doPush("updated",$entity->toTopicModelArray(),$entity->getTopicModelName());
        }
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof TopicModelInterface) {
            $this->doPush("created",$entity->toTopicModelArray(),$entity->getTopicModelName());
        }
        
    }

    protected function doPush($action,$model,$name){
        try{
            $this->pusher->push(['from'=>'server','action'=>$action,'model'=>$model], 'topic_model', ['model'=>$name]);
        }catch(\Exception $e){

        }
    }
}
