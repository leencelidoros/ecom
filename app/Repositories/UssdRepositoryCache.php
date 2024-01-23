<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class UssdRepositoryCache
{
    public static function process($ussdSession, $ussdString, $msisdn, $userExists)
    {
        if ($ussdString === null && $userExists == 1) {
            return self::showMenuRegistered($ussdSession, $ussdString);
        } elseif ($ussdString === null && $userExists == 0) {
            return self::showMenu($ussdSession, $ussdString);
        }
        $data = $ussdSession['action'];
        $dataType = json_decode($data, true);
        //check if the type is choice on input
        if (in_array('choice', $dataType)) {
            $options = $dataType['options'];
            if (array_key_exists($ussdString, $options)) {
                return self::{$options[$ussdString]}($ussdSession, $ussdString, $msisdn);
            }
            $modified_text = str_replace("CON ", "", $dataType['text']);
            return "CON Invalid choice\n{$modified_text}";
        }
        //check if the type is choice on input
        if (in_array('fromDB', $dataType)) {
            $values = collect($dataType['values'])->toArray();
            $options = collect($dataType['options'])->toArray();
            if (array_key_exists($ussdString, $options)) {
                return self::{$options[$ussdString]}($ussdSession, $ussdString, $msisdn);
            }
            if (!in_array($ussdString, $values)) {
                $modified_text = str_replace("CON ", "", $dataType['text']);
                return "CON Invalid choice\n{$modified_text}";
            }
        }
        $options = $dataType['options'];
        if (array_key_exists($ussdString, $options)) {
            return self::{$options[$ussdString]}($ussdSession, $ussdString, $msisdn);
        }
        $function = $dataType['function'];
        return self::{$function}($ussdSession, $ussdString, $msisdn);
    }

    //Displays  Menu

    /**
     * This menu is only for non-registered members
     */
    public static function showMenu($ussdSession, $ussdString)
    {
        Redis::set($ussdSession['msisdn'] . 'menu', 'showMenu');
        $text = "CON Welcome to Bitwise.\n1.Register\n2.Contact Us\n3. Send Us Feedback \n4. Quit \n5.";
        $data = [
            'msisdn' => $ussdSession['msisdn'],
            'session_id' => $ussdSession['session_id'],
            'ussd_string' => $ussdString,
            'action' => json_encode([
                'type' => 'choice',
                'name' => 'showMenu',
                'text' => $text,
                'options' => [
                    '1' => 'Register',
                    '2' => 'ContactUs',
                    '3' => 'SendFeedback',
                    '4' => 'Quit',
                
                    ]
                ]),
            ];
        Redis::set($ussdSession['session_id'] . 'ussdSession', json_encode($data));

        return $text;
    }

    /**
     * This menu is only for registered members
     */
    public static function showMenuRegistered($ussdSession, $ussdString)
    {
        Redis::set($ussdSession['msisdn'] . 'menu', 'showMenuRegistered');
        $text = "CON Welcome to Bitwise.\n1.View Profile\n2.Contact Us\n3. Send Us Feedback \n4. Quit \n5.";
              
        $data = [
            'msisdn' => $ussdSession['msisdn'],
            'session_id' => $ussdSession['session_id'],
            'ussd_string' => $ussdString,
            'action' => json_encode([
                'type' => 'choice',
                'name' => 'showMenuRegistered',
                'text' => $text,
                'options' => [
                    '1' => 'ViewProfile',
                    '2' => 'ContactUs',
                    '3' => 'SendFeedback',
                    '4' => 'Quit',
                ]
            ]),
        ];
        Redis::set($ussdSession['session_id'] . 'ussdSession', json_encode($data));

        return $text;
    }

    public static function Register($ussdSession, $ussdString)
    {
        $text = "CON Please enter your Full Name\n00. Home";
        $data = [
            'msisdn' => $ussdSession['msisdn'],
            'session_id' => $ussdSession['session_id'],
            'ussd_string' => $ussdString,
            'action' => json_encode([
                'type' => 'input',
                'function' => 'insertName',
                'name' => 'Register',
                'text' => $text,
                'options' => [
                    '00' => Redis::get($ussdSession['msisdn'].'menu')
                ]
            ]),
        ];
        Redis::set($ussdSession['session_id'] . 'ussdSession', json_encode($data));
        return $text;
    }
    public static function InsertName($ussdSession, $ussdString)
    {
        $text = "CON Please enter your Email\n00. Home";
        $data = [
            'msisdn' => $ussdSession['msisdn'],
            'session_id' => $ussdSession['session_id'],
            'ussd_string' => $ussdString,
            'action' => json_encode([
                'type' => 'input',
                'function' => 'insertEmail',
                'name' => 'InsertName',
                'text' => $text,
                'options' => [
                    '00' => Redis::get($ussdSession['msisdn'].'menu')
                ]
            ]),
        ];
        Redis::set($ussdSession['session_id'] . 'ussdSession', json_encode($data));
        Redis::set($ussdSession['session_id'] . 'name',$ussdString );
        return $text;
    }
    public static function InsertEmail($ussdSession, $ussdString)
    {
        $text = "CON Please enter your Location\n00. Home";
        $data = [
            'msisdn' => $ussdSession['msisdn'],
            'session_id' => $ussdSession['session_id'],
            'ussd_string' => $ussdString,
            'action' => json_encode([
                'type' => 'input',
                'function' => 'insertLocation',
                'name' => 'InsertEmail',
                'text' => $text,
                'options' => [
                    '00' => Redis::get($ussdSession['msisdn'].'menu')
                ]
            ]),
        ];
        Redis::set($ussdSession['session_id'] . 'ussdSession', json_encode($data));
        Redis::set($ussdSession['session_id'] . 'email',$ussdString );
        return $text;
    }
    public static function insertLocation($ussdSession, $ussdString)
    {
        $text = "END Registration Successful\n00. Home";
        Redis::set($ussdSession['session_id'] . 'email',$ussdString );
        Log::info( Redis::get($ussdSession['session_id'] . 'email' ));
        Log::info( Redis::get($ussdSession['session_id'] . 'name' ));
        Log::info( Redis::get($ussdSession['session_id'] . 'location' ));

         return $text;
     
    }
    public static function contactUs($ussdSession)
    {
        return "END Contact Us via:\nEmail:info@bitwise.co.ke \nPhone:0100000000 \n00 .Home";
    }
    public static function SendFeedback($ussdSession, $ussdString)
    {
        Redis::set($ussdSession['msisdn']);
        $text = "CON We value your feedback.\nPlease enter your feedback\n00. Home";
        $data = [
            'msisdn' => $ussdSession['msisdn'],
            'session_id' => $ussdSession['session_id'],
            'ussd_string' => $ussdString,
            'action' => json_encode([
                'type' => 'input',
                'function' => 'insertFeedback',
                'name' => 'sendFeedback',
                'text' => $text,
                'options' => [
                    '00' => Redis::get($ussdSession['msisdn'].'menu')
                ]
            ]),
        ];
        Redis::set($ussdSession['session_id'] . 'ussdSession', json_encode($data));

        return $text;
    }
    public static function insertFeedback($ussdSession, $ussdString, $msisdn)
    {
        if (!$ussdString || is_numeric($ussdString) && $ussdString != 0) {
            return "CON Invalid. Feedback required.\nPlease enter your feedback\n0. Cancel\n00. Home";
        }
        Feedback::create([
            'church_id' => $church['id'],
            'category_id' => FeedbackSubCategory::where('uuid',Redis::get($ussdSession['msisdn'] . 'feedbackSubCategory'))->first()->id,
            'phone' => $msisdn,
            'message' => $ussdString,
            'sent_on' => now()->format('Y-m-d H:i:s')
        ]);
        self::clearCache($ussdSession['msisdn'], $ussdSession);
        return "END Your feedback has been recorded. Thank You.";
    }

    
    
}