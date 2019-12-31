<?php

class AppNotification extends Notify {

    
    public function send()
    {
        $notificationdb= new Notification();
        $notificationdb->`insert`($this->notification);
        
    }

}
