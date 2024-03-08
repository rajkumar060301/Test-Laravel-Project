<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

      // Start Get id address form this cURL
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.ipgeolocation.io/ipgeo?apiKey=a5c4886398ec4acdb6cba53fb4ce22d1',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $decode_ip = json_decode($response, true);
        
        
        $ip_address = $decode_ip['ip'];
        $url_coded = rawurlencode($ip_address);
        // End 
        

        // Start Get form all location details form ip address
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.ipgeolocation.io/ipgeo?apiKey=a5c4886398ec4acdb6cba53fb4ce22d1&ip='.$url_coded,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response1 = curl_exec($curl);

        curl_close($curl);

        $decode_ip_address = json_decode($response1,true);
        $country_name = $decode_ip_address['country_name']; 
        // End 


        // Add condition if any visitor form somalia bloack that user
        if($country_name=="Somalia"){
            return redirect('/abort');
        }
        // End

  
        return $next($request);
    }
}
