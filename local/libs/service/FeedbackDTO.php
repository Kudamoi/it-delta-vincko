<?php

class FeedbackDTO {
    public $userId;
    public $userName;

    public function __construct(Array $param)  {
        $this->pr1 = $param['pr1'];
    }
}
