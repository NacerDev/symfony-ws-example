<?php

namespace App\Topic;

interface TopicModelInterface
{
    /**
     * Returns the topic model name.
     *
     * @return string The topic model name
     */
    public function getTopicModelName();

    
    /**
     * Returns an array representing the topic model.
     *
     * @return array
    */
    public function toTopicModelArray();
}