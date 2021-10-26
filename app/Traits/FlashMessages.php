<?php 

namespace App\Traits;

trait FlashMessages 
{
    protected $errorMessages = [];
    protected $infoMessages = [];
    protected $successMessages = [];
    protected $warningMessages = [];
    

    protected function setFlashMessage($message, $type) {
        $model = array('infoMessages');
        switch ($type) {
            case 'info':
                $this->model = 'infoMessages';
                break;
            
            case 'error':
                $this->model = 'errorMessages';
                break;
                
            case 'success':
                $this->model = 'successMessages';
                break;
            
            case 'warning':
                $this->model = 'warningMessages';
                break;
        }

        if (is_array($message)) {
            foreach ($message as $key => $value) {
                array_push($model, $value);
            }
        } else {
            // pr. errorMessages => 'wrong credentials'
            array_push($model, $message);
        }
    }

    // used for getting diferent type of messages based on key word (getFlashMessage['error']) 
    protected function getFlashMessage() {
        return [
            'error' => $this->errorMessages,
            'info' => $this->infoMessages,
            'warning' => $this->warningMessages,
            'success' => $this->successMessages,
        ];
    }

    /**
     * LARAVEL DOCS
     * Flash data is primarily useful for short-lived status messages
     * flash is used for next requests, after that request is changed or reloaded that session will desipire, that's how I processed this! 
     */

    protected function showFlashMessages() {
        session()->flash('error', $this->errorMessages);
        session()->flash('info', $this->infoMessages);
        session()->flash('success', $this->successMessages);
        session()->flash('warning', $this->warningMessages);
    }
}