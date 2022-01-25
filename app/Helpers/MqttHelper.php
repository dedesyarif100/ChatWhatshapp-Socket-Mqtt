<?php

namespace App\Helpers;

use PhpMqtt\Client\Exceptions\MqttClientException;
use PhpMqtt\Client\Exceptions\ConnectionNotAvailableException;
use PhpMqtt\Client\Facades\MQTT;

class MqttHelper {
    public static function subscribe($topic, $qos = 0)
    {
        try {
            $mqtt = MQTT::connection();
            $mqtt->subscribe($topic, function (string $topic, string $message) {
                print_r(json_decode($message));
            }, $qos);
            $mqtt->loop(true);
        } catch (MqttClientException $e) {
            echo $e->getMessage();
        } catch (ConnectionNotAvailableException $e) {
            echo $e->getMessage();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function publish($topic, $message)
    {
        // dd($message);
        try {
            $mqtt = MQTT::connection();
            $mqtt->publish($topic, $message);
            // dd($cek);
        } catch (MqttClientException $e) {
            return $e->getMessage();
        } catch (ConnectionNotAvailableException $e) {
            echo $e->getMessage();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
