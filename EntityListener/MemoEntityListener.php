<?php

namespace App\EntityListener;

use App\Entity\Memo;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class MemoEntityListener
{
    private SluggerInterface $slugger;
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Memo $memo, LifecycleEventArgs $event){
        $memo->computeSlug($this->slugger);
    }

    public function preUpdate(Memo $memo, LifecycleEventArgs $event){
        $memo->computeSlug($this->slugger);
    }
}