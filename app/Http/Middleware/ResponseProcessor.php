<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ResponseProcessor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $object   = $next($request);

        $response_code='';
        if(isset($object->original)){
            $original = $object->original;
            
            if(isset($original['errors'])){
                $message = '';
                $message_array = [];
                $i = 0;
                foreach ($original['errors'] as $key => $value) {
                    foreach ($value as $k => $val) {
                        if(!in_array($val,$message_array)){
                            $message_array[] = $val;
                            $tilde    = $i == 0 ? '':'~';
                            $message .= $tilde.$val;
                            $i++;
                        }
                    }
                }
                $original['message'] = $message;
                $original['success'] = false;
                unset($original['errors']);
            }
        
            $object->setContent(json_encode($original));
        }
        return $object;
    }
}
