<?php

namespace App\Enums\Call;

enum Status: int
{
    case NEW_STATUS = 0;
    case READ_STATUS = 1;

    public function text()
    {
        switch ($this->value) {
            case 0 :
                $status = 'новое';
                break;
            case 1 :
                $status = 'прочитано';
                break;
            default:
                $status = '';
        }
        return $status;
    }
}
