<?php

// Composerでインストールしたライブラリを一括読み込み
require_once __DIR__ . '/vendor/autoload.php';

// アクセストークンを使いCurlHTTPClientをインスタンス化
//$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('4AuXRJ4JMOerQsUZoCM9CnXSWJT9WsaBeAcyVtZg9GELjqTHpfZAc3DL3513UxZlNTX7QRkE40dFB3pVr38broO7P3EIVTykXhY48KQxb+oH3OPK91QJhIceLMR1UKi0FvcRJjdU0fHZ/Uzt2+L5OwdB04t89/1O/w1cDnyilFU='));

// CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
//$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('db717189a807df509bf393f788337322')]);
// LINE Messaging APIがリクエストに付与した署名を取得
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];

// 署名が正当かチェック。正当であればリクエストをパースし配列へ
$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
// 配列に格納された各イベントをループで処理
foreach ($events as $event) {
  // テキストを返信
  $bot->replyText($event->getReplyToken(), 'TextMessage');
}

// テキストを返信。引数はLINEBot、返信先、テキスト
function replyTextMessage($bot, $replyToken, $text) {
  // 返信を行いレスポンスを取得
  // TextMessageBuilderの引数はテキスト
  $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text));
  // レスポンスが異常な場合
  if (!$response->isSucceeded()) {
    // エラー内容を出力
    error_log('Failed! '. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}
?>
