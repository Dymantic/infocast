<?php


namespace App\FlashMessaging;


class FlashMessenger
{
    public function success($title, $text)
    {
        $this->flashMessage('success', $title, $text);
    }

    public function error($title, $text)
    {
        $this->flashMessage('error', $title, $text);
    }

    private function flashMessage($type, $title, $text)
    {
        session()->flash('flash_message', [
            'icon'   => $type,
            'title'  => $title,
            'text'   => $text,
            'timer'  => 2000,
            'button' => false
        ]);
    }
}