<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Log;

class VerifyWoocommerce
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      /*  $signature = Request::header('x-wc-webhook-signature');

        $payload = Request::getContent();

        $calculated_hmac = base64_encode(hash_hmac('sha256', $payload, env('WOOCOMMERCE_WEBHOOK'), true));

        if($signature != $calculated_hmac) {
            return false;
        }
*/
        return $next($request);
    }
}
