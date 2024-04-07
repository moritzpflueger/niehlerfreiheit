<?php

  use Kirby\Cms\Page;

  class VirtualEventPage extends Page {
    public function __construct($props) {
      parent::__construct(array_merge(['parent' => $props['parent']], $props));
    }
    protected $isCanceled = false;

    public function setIsCanceled($isCanceled) {
      $this->isCanceled = $isCanceled;
    }

    public function isCanceled() {
      return $this->isCanceled;
    }

    public function isRecurring() {
      return true; // This method allows us to identify virtual recurring event pages
    }    
  }  