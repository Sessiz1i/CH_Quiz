<?php


namespace App;


class Flash
{

    protected function create($level, $title, $message, $button, $key = 'flash_message')
    {
        session()->flash($key, [
            'level' => $level,
            'title' => $title,
            'message' => $message,
            'button' => $button,
        ]);
    }
    public function success($title=null, $message=null,$button=null)
    {
        return $this->create('success', $title, $message,$button);
    }

    public function info($title=null, $message=null,$button=null)
    {
        return $this->create('info', $title, $message,$button);
    }

    public function warning($title=null, $message=null, $button=null)
    {
        return $this->create('warning', $title, $message, $button);
    }

    public function error($title=null, $message=null,$button=null)
    {
        return $this->create('error', $title, $message,$button);
    }

    public function overlay($level = 'success', $title=null, $message=null)
    {
        return $this->create('flash_message_overlay', $title, $message);
    }
}
