<?php
namespace app\commands;

use app\components\OrderNotice;
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
use yii\console\Controller;
use app\models\Order;

class NoticeController extends Controller
{
    public function actionOrder($id, $skip = "app\\components\\noticeProviders\\Sms")
    {
        echo "Start with $id\n";
        $order = Order::find()->where(['id'=>$id])->one();
        if (empty($order))
        {
            die("Order not found");
        }
        $notice = new OrderNotice([$skip]);
        $notice->notice($order);
        echo "Notice ok";
    }

    public function actionTestMessageSender() {
        $connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, false, false, false);

        $msg = new AMQPMessage('Hello World!');
        $channel->basic_publish($msg, '', 'hello');
        echo " [x] Sent 'Hello World!'\n";
        $channel->close();
        $connection->close();
    }

    public function actionTestMessageReader() {
        $connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

        $callback = function($msg) {
            echo " [x] Received ", $msg->body, "\n";
        };

        $channel->basic_consume('hello', '', false, true, false, false, $callback);

        while(count($channel->callbacks)) {
            $channel->wait();
        }
    }
}
