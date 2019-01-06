<?php

namespace App\Exceptions;

use Exception;

class PermissionException extends Exception
{
    public function render(){
        return redirect()->back()->with('danger',$this->getMessage());
    }
}
