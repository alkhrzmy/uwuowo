<?php
date_default_timezone_set('Asia/Jakarta');
echo 'hi!<br>';
echo 'there is nothing here';
echo '<br><br>';
echo date('d-m-y H:i:s');

require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');

$channelAccessToken = 'wHa40v0qC9n05F8Dub56uFPQ00ValX1kJf+XXqtG/ynxscjsCcCc7ZVH22bxXFAaU4GdMYxV3g8nXIb3+OtWE9Q8sbmR1eZynyqZhqa8k+Tl9DV+FBBb6KJHYNqJBzrFUQSRtdxn4hZZQg7gz6u+1AdB04t89/1O/w1cDnyilFU=';
$channelSecret = '0e9a51ef8fecf1f6d842411fa9bcae81';

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

$time=date('H:i');
echo '<br/>';


$userId = $client->parseEvents()[0]['source']['userId'];
$groupId = $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp = $client->parseEvents()[0]['timestamp'];
$type = $client->parseEvents()[0]['type'];

$message = $client->parseEvents()[0]['message'];
$messageid = $client->parseEvents()[0]['message']['id'];

$profil = $client->profil($userId);
$profileName = $profil->displayName;
$profileURL = $profil->pictureUrl;
$profileStatus = $profil->statusMessage;
$roomId = $client->parseEvents()[0]['source']['roomId'];

$pesan_datang = explode(" ", $message['text']);

$commandSingle = strtolower($message['text']);
$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}
$path = "https://alkhrzmy.online/bot/";
$IdAdmin = "U6492dbccec39e3db72af41aa3f0ebad5";

if($type == 'follow') {
    $getNamez = json_decode(file_get_contents($path.'/name.php?userId='.$userId),TRUE);
    $getName = $getNamez['displayName'];
    $responses['to'] = $IdAdmin;
    $responses['messages']['0']['type'] = "text";
    $responses['messages']['0']['text'] = $getName." telah menambahkan bot ini sebagai teman";
    $result = json_encode($responses);
    $result_json = json_decode($result, TRUE);
    $client->pushMessage($result_json);
    
    $responsess['replyToken'] = $replyToken;
    $responsess['messages']['0']['type'] = "text";
    $responsess['messages']['0']['text'] = "Halo ".$getName." invite ke group ya kak";
    $results = json_encode($responsess);
    $result_jsons = json_decode($results, TRUE);
    $client->replyMessage($result_jsons);
}

#----------POSTBACK------------#
$postbackData = $client->parseEvents()[0]['postback']['data'];
$postbackPesan = explode(" ", strtolower($postbackData));
$commandPostback = $postbackPesan[0];
$optionsPostback = $postbackPesan[1];
if (count($postbackPesan) > 2) {
	for ($i = 2; $i < count($postbackPesan); $i++) {
		$optionsPostback .= '+';
		$optionsPostback .= $postbackPesan[$i];
	}
}
#----------END----------#

function scv($keyword) {
    $uri = $keyword;
    $result = $uri;
    return $result;
}

$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}


function instagram($keyword) {
    $uri = "https://rest.farzain.com/api/ig_profile.php?id=" . $keyword . "&apikey=1MJ11rZNOM4XbZn8U0PTIsAJh";
  
    $response = Unirest\Request::get("$uri");
  
    $json = json_decode($response->raw_body, true);
    $parsed = array();
    $parsed['a1'] = $json['info']['username'];
    $parsed['a2'] = $json['info']['bio'];
    $parsed['a3'] = $json['count']['followers'];
    $parsed['a4'] = $json['count']['following'];
    $parsed['a5'] = $json['count']['post'];
    $parsed['a6'] = $json['info']['full_name'];
    $parsed['a7'] = $json['info']['profile_pict'];
    $parsed['a8'] = "https://www.instagram.com/" . $keyword;
    return $parsed;
}

function iginfo($keyword) {
	$uri = "http://api.zicor.ooo/instagram.php?username=" . $keyword;
	$response = Unirest\Request::get("$uri");
	$json = json_decode($response->raw_body, true);
	$result = "\nUsername: ";
	$result .= $json['username'];
	$result .= "\nFull name: ";
	$result .= $json['fullname'];
	$result .= "\nID: ";
	$result .= $json['id'];
	$result .= "\nFollower: ";
	$result .= $json['follower'];
	return $result;
}

function wib($keyword) {
    $uri = "https://time.siswadi.com/timezone/?address=Jakarta";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $parsed = array(); 
    $parsed['time'] = $json['time']['time'];
    $parsed['date'] = $json['time']['date'];
    return $parsed;
}
function wit($keyword) {
    $uri = "https://time.siswadi.com/timezone/?address=jayapura";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $parsed = array(); 
    $parsed['time'] = $json['time']['time'];
    $parsed['date'] = $json['time']['date'];
    return $parsed;
}
function wita($keyword) {
    $uri = "https://time.siswadi.com/timezone/?address=manado";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $parsed = array(); 
    $parsed['time'] = $json['time']['time'];
    $parsed['date'] = $json['time']['date'];
    return $parsed;
}
function praytime($keyword) {
	$uri = "http://api.zicor.ooo/praytime.php?location=" . $keyword;
	$respon = Unirest\Request::get("$uri");
	$pray = json_decode($respon->raw_body, true);
	$result = "\nDaerah: ";
	$result .= $keyword;
	$result .= "\nSubuh: ";
	$result .= $pray['pray_time']['subuh'];
	$result .= "\nDzuhur: ";
	$result .= $pray['pray_time']['dzuhur'];
	$result .= "\nAshar: ";
	$result .= $pray['pray_time']['ashar'];
	$result .= "\nMaghrib: ";
	$result .= $pray['pray_time']['maghrib'];
	$result .= "\nIsya: ";
	$result .= $pray['pray_time']['isha'];
	return $result;
}

function joox($keyword) {
	$uri = "http://api.zicor.ooo/joox.php?song=" . $keyword;
	$response = Unirest\Request::get("$uri");
	$json = json_decode($response->raw_body, true);
	$parsed = array();
	$parsed['a1'] = $json['singer'];
	$parsed['a2'] = $json['title'];
	$parsed['a3'] = $json['url'];
	$parsed['a4'] = $json['image'];
	return $parsed;
}

function img_gugel ($keyword) {  
    $uri = "https://rest.farzain.com/api/gambarg.php?id=" . $keyword . "&apikey=1MJ11rZNOM4XbZn8U0PTIsAJh";          
    $response = Unirest\Request::get("$uri"); 
    $json = json_decode($response->raw_body, true); 
    $parsed = array();
    $parsed['a1'] = $json['url'];
	
    return $parsed;
}

if ($message['type'] == 'text') {
	if ($command == '/img') {
		$result = img_gugel($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'image',
                    'originalContentUrl' => $result['a1'],
                    'previewImageUrl' => $result['a1']
                ),
            ),
        );
    }elseif($command == 'jadwal') {
    	$balas = array(
    	    'replyToken' => $replyToken,
            'messages' => array(
            	array(
            	    'type' => 'image',
                    'originalContentUrl' => 'https://cdn3.imggmi.com/uploads/2018/10/5/757bb314b2689320f2a8ace61182c363-full.jpg',
                    'previewImageUrl' => 'https://cdn3.imggmi.com/uploads/2018/10/5/757bb314b2689320f2a8ace61182c363-full.jpg',
                ),
            ),
        );
    }
}

function ytdown($keyword) {
	$uri = "https://www.saveoffline.com/process/?url=".$keyword."&type=json";
	$response = Unirest\Request::get("$uri");
	$json = json_decode($response->raw_body, true);
    $parsed = array();
    $parsed['aa'] = $json['thumbnail'];
    $parsed['bb'] = $json['title'];
    $parsed['a1'] = $json['urls'][0]['id'];
    $parsed['b1'] = $json['urls'][0]['label'];
    $parsed['a2'] = $json['urls'][1]['id'];
    $parsed['b2'] = $json['urls'][1]['label'];
    $parsed['a3'] = $json['urls'][2]['id'];
    $parsed['b3'] = $json['urls'][2]['label'];
    return $parsed;
}
function ytdown_mp3($keyword) {
	$uri = "https://rest.farzain.com/api/ytaudio.php?id=". $keyword ."&apikey=1MJ11rZNOM4XbZn8U0PTIsAJh";
	$response = Unirest\Request::get("$uri");
	$json = json_decode($response->raw_body, true);
    $parsed = array();
    $parsed['a1'] = $json['result']['m4a'];
    $parsed['a2'] = $json['result']['webm'];
    return $parsed;
}

function tts($keyword) { 
    $uri = "https://translate.google.com/translate_tts?ie=UTF-8&tl=id-ID&client=tw-ob&q=" . $keyword; 

    $response = Unirest\Request::get("$uri"); 
    $result = $uri; 
    return $result; 
}


if($message['type']=='text') {
    if ($command == '/say') {

        $result = tts($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
                'type' => 'audio',
                'originalContentUrl' => $result,
                'duration' => 60000,
                )
            )
        );
}
}

function urb_dict($keyword) {
    $uri = "http://api.urbandictionary.com/v0/define?term=" . $keyword;

    $response = Unirest\Request::get("$uri");


    $json = json_decode($response->raw_body, true);
    $result = $json['list'][0]['definition'];
    $result .= "\n\nExamples : \n";
    $result .= $json['list'][0]['example'];
    return $result;
}

#-------------------------[Open]-------------------------#
function film_syn($keyword) {
    $uri = "http://www.omdbapi.com/?t=" . $keyword . '&plot=full&apikey=d5010ffe';

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $parsed = array();
	$parsed['poster'] = $json['Poster'];
	$parsed['hasil']=$json['Title'].'
'.$json['Plot'];
    return $parsed;
}
#-------------------------[Close]-------------------------#
function ssweb($keyword) {
	$uri = "https://api.site-shot.com/?url=".$keyword."&width=1920&height=1920&5ba006ea23010.jpg";
	$result = $uri;
	return $result;
}
function soundcloud($keyword){
	$uri = "https://rest.farzain.com/api/soundcloud.php?id=". $keyword ."&apikey=ppqeuy";
	$response = Unirest\Request::get("$uri");
	$json = json_decode($response->raw_body, true);
    $parsed = array();
    $parsed['a'] = $json['result'][0]['id'];
    $parsed['b'] = $json['result'][0]['title'];
    $parsed['c'] = $json['result'][0]['img'];
    $parsed['d'] = $json['result'][0]['url_download'];
    $parsed['e'] = $json['result'][0]['url'];
    $parsed['a1'] = $json['result'][1]['id'];
    $parsed['b1'] = $json['result'][1]['title'];
    $parsed['c1'] = $json['result'][1]['img'];
    $parsed['d1'] = $json['result'][1]['url_download'];
    $parsed['e1'] = $json['result'][1]['url'];
    $parsed['a2'] = $json['result'][2]['id'];
    $parsed['b2'] = $json['result'][2]['title'];
    $parsed['c2'] = $json['result'][2]['img'];
    $parsed['d2'] = $json['result'][2]['url_download'];
    $parsed['e2'] = $json['result'][2]['url'];
    $parsed['a3'] = $json['result'][3]['id'];
    $parsed['b3'] = $json['result'][3]['title'];
    $parsed['c3'] = $json['result'][3]['img'];
    $parsed['d3'] = $json['result'][3]['url_download'];
    $parsed['e3'] = $json['result'][3]['url'];
    $parsed['a4'] = $json['result'][4]['id'];
    $parsed['b4'] = $json['result'][4]['title'];
    $parsed['c4'] = $json['result'][4]['img'];
    $parsed['d4'] = $json['result'][4]['url_download'];
    $parsed['e4'] = $json['result'][4]['url'];
    return $parsed;
}
#-------------------------[Open]-------------------------#
function film($keyword) {
    $uri = "http://www.omdbapi.com/?t=" . $keyword . '&plot=full&apikey=d5010ffe';

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $parsed = array();
	$parsed['title'] = $json['Title'];
	$parsed['released'] = $json['Released'];
	$parsed['genre'] = $json['Genre'];
	$parsed['actors'] = $json['Actors'];
	$parsed['bahasa'] = $json['Language'];
	$parsed['negara'] = $json['Country'];
    return $parsed;
}
#-------------------------[Close]-------------------------#

if ($type == 'join') {
	$jojo = array(
		'replyToken' => $replyToken,                                                        
		'messages' => array(
			array(
				'type' => 'flex',
				'altText' => 'alkhBot',
				'contents' =>
					array(
						'type' => 'bubble',
						'body' =>
							array(
								'type' => 'box',
								'layout' => 'vertical',
								'contents' =>
									array(
										0 =>
											array(
												'type' => 'text',
												'text' => '[Jam: '. $jam.']'
											),
										1 =>
											array(
												'type' => 'image',
												'url' => 'https://orig00.deviantart.net/8041/f/2012/293/6/3/experiment_xiv_by_damaimikaz-d5iedsj.jpg',
												'size' => 'full'
											),
										2 =>
											array(
												'type' => 'text',
												'text' => 'Thx udh di invite kesini:)'
											),
										3 =>
											array(
												'type' => 'text',
												'text' => 'Ketik /help untuk menu'
											),
										4 =>
											array(
												'type' => 'button',
												'style' => 'primary',
												'color' => '#0083FF',
												'action' =>
													array(
														'type' => 'uri',
														'label' => 'My Creator',
														
														'uri' => 'https://line.me/ti/p/t4tUbw-0Pz'
													)
											),
										5 =>
											array(
											    'type' => 'text',
											    'text' => 'atau klik dibawah ini',
											),
										6 =>
											array(
												'type' => 'button',
												'style' => 'primary',
												'color' => '#0000FF',
												'action' =>
													array(
														'type' => 'message',
														'label' => 'Help',
														'text' => '/help',
													),
											),
									)
							)
					)
			)
		)
	);
	$client->replyMessage($jojo);
}

if ($message['type'] == 'image') {
	#$list_jwb=array('','??_????','(???;)?????','?(?o?)?');
	#$jwb=array_rand($list_jwb);
	#$jawab=$list_jwb[$jwb];
	$balas = array(
	    'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => 'image detected' 
            ),
        ),
    );
}

if($type=='memberJoined') {
	$respon['replyToken'] = $replyToken;
	$respon['messages'][0]['type'] = 'text';
	$respon['messages'][0]['text'] = 'Welcome, '.$profileName.'!';
	$result = json_encode($respon);
    $result_json = json_decode($result, TRUE);
	$balas=$result_json;
}

function jodoh($keyword) {
	$list_kemungkinan= array(
		'[100%] 	cocok bangeet, langsung ke KUA! '.$keyword,
		'[30%] 	kayaknya disana masih banyak jodoh yang lain kak, hehe',
		'[95%] 	hmm, cocok sih.. tpi masih ada yang belum peka nih',
		'[90%] 	wow, cocok nih! '.$keyword,
		'[50%] 	duh, kayaknya dia lebih suka sama yang lain deh, sabar ya',
		'[85%] 	dikit lagi.. kamu kurang peka sih',
		'[80%] 	masih belum, kayaknya masih kurang perhatian deh',
		'[40%]	yah.. dianya suka sama oppa, mungkin yang lain',
		'[75%]	hati hati, ada pihak ke tiga nih.. hihi.. ',
		'[30%] 	kayaknya disana masih banyak jodoh yang lain kak, hehe',
		'[30%] 	kayaknya disana masih banyak jodoh yang lain kak, hehe',
	);
	$res = array_rand($list_kemungkinan);
	$result = $list_kemungkinan[$res];
	return $result;
}

function save($url) {
    $echo = file_get_contents("https://alkhrzmy.000webhostapp.com/img/index.php?url=".base64_encode($url));
    return $echo;
}

if($message['type']=='text') {
	if ($command == 'Me'||$command == 'me') {
		$balas = array(
			'replyToken' => $replyToken,
            'messages' => array(
                    array(
                'type' => 'flex',
                'altText' => ' Profile',
                'contents' => array (
                          'type' => 'bubble',
                          'hero' =>
                          array (
                            'type' => 'image',
                            'url' => save($profileURL),
                            'size' => 'full',
                            'aspectRatio' => '20:13',
                            'aspectMode' => 'cover',
                            'action' =>
                            array (
                              'type' => 'uri',
                              'uri' => save($profileURL),
                            ),
                          ),
                          'body' =>
                          array (
                            'type' => 'box',
                            'layout' => 'vertical',
                            'contents' =>
                            array (
                              0 =>
                              array (
                                'type' => 'text',
                                'text' => $profileName,
                                'weight' => 'bold',
                                'size' => 'xxl',
                              ),
                              1 =>
                              array (
                                'type' => 'box',
                                'layout' => 'baseline',
                                'margin' => 'md',
                                'contents' =>
                                array (
                                  0 =>
                                  array (
                                    'type' => 'text',
                                    'text' => 'Profile',
                                    'size' => 'md',
                                    'wrap' => true,
                                    'color' => '#999999',
                                    'margin' => 'md',
                                    'flex' => 0,
                                  ),
                                ),
                              ),
                              2 =>
                              array (
                                'type' => 'box',
                                'layout' => 'vertical',
                                'margin' => 'lg',
                                'spacing' => 'sm',
                                'contents' =>
                                array (
                                  0 =>
                                  array (
                                    'type' => 'box',
                                    'layout' => 'baseline',
                                    'spacing' => 'sm',
                                    'contents' =>
                                    array (
                                      0 =>
                                      array (
                                        'type' => 'text',
                                        'text' => 'Jenis :',
                                        'color' => '#aaaaaa',
                                        'size' => 'sm',
                                        'flex' => 2,
                                      ),
                                      1 =>
                                      array (
                                        'type' => 'text',
                                        'text' => 'Manusia',
                                        'wrap' => true,
                                        'color' => '#666666',
                                        'size' => 'sm',
                                        'flex' => 1,
                                      ),
                                    ),
                                  ),
                                  1 =>
                                  array (
                                    'type' => 'box',
                                    'layout' => 'baseline',
                                    'spacing' => 'sm',
                                    'contents' =>
                                    array (
                                      0 =>
                                      array (
                                        'type' => 'text',
                                        'text' => 'IP :',
                                        'color' => '#aaaaaa',
                                        'size' => 'sm',
                                        'flex' => 2,
                                      ),
                                      1 =>
                                      array (
                                        'type' => 'text',
                                        'text' => 'ERROR',
                                        'wrap' => true,
                                        'color' => '#666666',
                                        'size' => 'sm',
                                        'flex' => 1,
                                      ),
                                    ),
                                  ),
                                  2 =>
                                  array (
                                    'type' => 'box',
                                    'layout' => 'baseline',
                                    'spacing' => 'sm',
                                    'contents' =>
                                    array (
                                      0 =>
                                      array (
                                        'type' => 'text',
                                        'text' => 'BIO :',
                                        'color' => '#aaaaaa',
                                        'size' => 'sm',
                                        'flex' => 2,
                                      ),
                                      1 =>
                                      array (
                                        'type' => 'text',
                                        'text' => $profil->statusMessage,
                                        'wrap' => true,
                                        'color' => '#666666',
                                        'size' => 'sm',
                                        'flex' => 1,
                                      ),
                                    ),
                                  ),
                                ),
                              ),
                            ),
                          ),
                          'footer' =>
                          array (
                            'type' => 'box',
                            'layout' => 'vertical',
                            'spacing' => 'sm',
                            'contents' =>
                            array (
                              0 =>
                              array (
                                'type' => 'button',
                                'style' => 'primary',
                                'action' =>
                                array (
                                  'type' => 'uri',
                                  'label' => 'Contact Creator',
                                  'uri' => 'https://line.me/ti/p/~alkhoarizmy',
                                ),
                              ),
                              1 =>
                              array (
                                'type' => 'spacer',
                                'size' => 'sm',
                              ),
                            ),
                            'flex' => 0,
                          ),
                        ),
                    )
                )  
            );
        }
}

if($message['type']=='text'){
	if($command == '/multicast'){
		$bala = array(
			'replyToken' => $replyToken,
			'messages' => array(
				array(
					'type' => 'text',
					'text' => $options
				)
			)
		);
		$client->multicast($bala);
	}
}
if ($message['type'] == 'text') {
	if ($command == '/def') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Definition : ' . urb_dict($options)
                )
            )
        );
    }elseif($command == '/jodoh') {
    	$balas=array(
   		'replyToken' => $replyToken,
           'messages' => array(
                array(
                    'type' => 'text',
                    'text' => jodoh($options)
                ) 
           ) 
        );
    }elseif($command == '/ssweb') {
    	$result = ssweb($options);
    	$balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'image',
                    'originalContentUrl' => $result,
                    'previewImageUrl' => $result
                ),
            ),
        );
    }elseif($command == 'tes') {
    	$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
                	'type' => 'text',
                    'text' => 'tis'
                )
            )
        );
    }elseif($command == '/ytdown') {
    	$res = ytdown($options);
    	$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
                	'type' => 'template',
                    'altText' => 'Yt Down',
                    'template' =>
                    	array(
                            'type' => 'buttons',
                            'thumbnailImageUrl' => 'https://image.ibb.co/cHrU19/Photo-Funia-1539494061.jpg',
                            'imageAspectRatio' => 'rectangle',
                            'imageSize' => 'cover',
                            'imageBackgroundColor' => '#FFFFFF',
                            'title' => 'Yt Download',
                            'text' => $res['bb'],
                            'actions' =>
                            	array(
                                    0 =>
                                    	array(
                                            'type' => 'message',
                                            'label' => $res['b1']/*'label'*/,
                                            'text' => $res['a1']/*'https://line.me/ti/p/~alkhoarizmy'*/
                                        ),
                                    1 =>
                                    	array(
                                            'type' => 'message',
                                            'label' => $res['b2']/*'label'*/,
                                            'text' => $res['a2']/*'https://line.me/ti/p/~alkhoarizmy'*/
                                        ),
                                    2 =>
                                    	array(
                                            'type' => 'message',
                                            'label' => $res['b3']/*'label'*/,
                                            'text' => $res['a3']/*'https://line.me/ti/p/~alkhoarizmy'*/
                                        ),
                                    3 =>
                                    	array(
                                            'type' => 'message',
                                            'label' => 'Send Video',
                                            'text' => '/sendvid '. $res['a1']
                                        ),
                                ),
                        ),
                ),
            ),
        );
    }elseif($command == '/ytmp3') {
    	$res = ytdown_mp3($options);
    	$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
                	'type' => 'template',
                    'altText' => 'Youtube mp3',
                    'template' =>
                    	array(
                            'type' => 'buttons',
                            'thumbnailImageUrl' => 'https://image.ibb.co/cHrU19/Photo-Funia-1539494061.jpg',
                            'imageAspectRatio' => 'rectangle',
                            'imageSize' => 'cover',
                            'imageBackgroundColor' => '#FFFFFF',
                            'title' => 'YT MP3',
                            'text' => 'Status: Success',
                            'actions' =>
                            	array(
                                    0 =>
                                    	array(
                                            'type' => 'message',
                                            'label' => 'M4A',
                                            'text' => $res['a1']/*'https://line.me/ti/p/~alkhoarizmy'*/
                                        ),
                                    1 =>
                                    	array(
                                            'type' => 'message',
                                            'label' => 'webm',
                                            'text' => $res['a2']/*'https://line.me/ti/p/~alkhoarizmy'*/
                                        ),
                                    
                                ),
                        ),
                ),
            ),
        );
    }elseif($command == '/sendvid') {
    	$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
                	'type' => 'video',
                    'originalContentUrl' => $options,
                    'previewImageUrl' => 'https://img00.deviantart.net/f53d/i/2018/159/7/c/ana_by_rossdraws-dccukho.jpg'
                ),
            ),
        );
    }elseif($command == '/shalat') {
		$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
                	'type' => 'text',
                    'text' => '[Jadwal Shalat]' . praytime($options)
                )
            )
        );
    }elseif($command == '/joox') {
    	$result = joox($options);
    	$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
                	'type' => 'template',
                	'altText' => 'alkhBot',
                	'template' =>
                	    array(
                	        'type' => 'carousel',
                            'columns' =>
                            	array(
                            	    0 =>
                            	        array(
                            	            'thumbnailImageUrl' => $result['a4'],
                                            'imageBackgroundColor' => '#FFFFFF',
                                            'title' => $result['a2'],
                                            'text' => $result['a1'],
                                            'actions' =>
                                            	array(
                                            	    0 =>
                                            	        array(
                                            	            'type' => 'uri',
                                                            'label' => 'LISTEN',
                                                            'uri' => $result['a3'],
                                                        ),
                                                ),
                                        ),
                                ),
                        ),
                )
            )
        );
    }elseif($command == 'Help3') {
    	$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
					'type' => 'flex',
					'altText' => 'alkhBot',
					'contents' =>
						array(
							'type' => 'bubble',
							'body' =>
								array(
									'type' => 'box',
									'layout' => 'vertical',
									'contents' =>
										array(
											0 =>
												array(
													'type' => 'text',
													'text' => '[Command List]',
													'color' => '#808000'
												),
											1 =>
												array(
													'type' => 'text',
													'text' => '> /searchmusic [song]',
												),
											2 =>
												array(
													'type' => 'text',
													'text' => '> /ig [username]'
												),
											3 =>
												array(
													'type' => 'text',
													'text' => '> /shalat [daerah]'
												),
											4 =>
												array(
													'type' => 'text',
													'text' => '> /joox [lagu]'
												),
											5 =>
												array(
													'type' => 'text',
													'text' => '> /jam'
												),
											6 =>
												array(
													'type' => 'text',
													'text' => '> /def [kata]'
												),
											7 =>
												array(
													'type' => 'text',
													'text' => '> /img [kata]'
												),
											8 =>
												array(
												    'type' => 'text',
												    'text' => '> /yt [judul]'
												),
											9 =>
												array(
												    'type' => 'text',
												    'text' => '> @bye'
												),
											10 =>
												array(
												    'type' => 'text',
												    'text' => '> /pesan_sebelumnya'
												),
											11 =>
												array(
												    'type' => 'text',
												    'text' => '> /ssweb [link]'
												),
											12 =>
												array(
												    'type' => 'text',
												    'text' => '> Me'
												),
											13 =>
												array(
													'type' => 'text', 
													'text' => '> /brainly [pertanyaan]' 
												), 
											14 =>
												array(
													'type' => 'text', 
													'text' => '> /loginqr' 
												), 
											15 =>
												array(
													'type' => 'text', 
													'text' => '> /shorter [LINK] ' 
												), 
										),
								),
						),
				),
			),
		);
	}elseif($command == '@bye') {
		$push = array(
			'to' => $groupId,
			'messages' => array(
				array(
					'type' => 'text',
					'text' => 'OK'
				)
			)
		);
		$bebeq = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
                	'type' => 'text',
                    'text' => 'eye eye sir'
                ),
            ),
        );
		$client->pushMessage($push);
		$client->replyMessage($bebeq);
		$client->leaveGroup($groupId);
	}elseif($command == '/instagram') {
		$balas = array(
			'replyToken' => $replyToken,                                                        
			'messages' => array(
				array(
                	'type' => 'text',
                    'text' => '[IG INFO]' . iginfo($options)
                ),
            ),
        );
	}
}

if($message['type']=='text') {
	if ($command == '/translate') {
		$uri="https://api.eater.pw/translate?lang=id&text=". $options;
		$hasil = file_get_contents($uri);
        $json = $hasil;
		$responses['replyToken'] = $replyToken;
		$responses['messages']['0']['type'] = 'text';
		$responses['messages']['0']['text'] = $json;
		$res = json_encode($responses);
		$result_json = json_decode($res, TRUE);
		$balas=$result_json;
	} 
} 


		
if($message['type']=='text') {
	if ($command == 'Help2'){
		$responses['replyToken'] = $replyToken;
		$responses['messages']['0']['type'] = 'flex';
		$responses['messages']['0']['altText'] = 'help 2';
		$responses['messages']['0']['contents']['type'] = 'carousel';
		$responses['messages']['0']['contents']['contents'][0]['type'] = 'bubble';
		$responses['messages']['0']['contents']['contents'][0]['body']['type'] = 'box';
		$responses['messages']['0']['contents']['contents'][0]['body']['layout'] = 'vertical';
		$responses['messages']['0']['contents']['contents'][0]['body']['contents'][0]['type'] = 'text';
		$responses['messages']['0']['contents']['contents'][0]['body']['contents'][0]['text'] = 'Help Command';
		$responses['messages']['0']['contents']['contents'][0]['body']['contents'][1]['type'] = 'text';
		$responses['messages']['0']['contents']['contents'][0]['body']['contents'][1]['text'] = 'Help Messages
[~] /ig [username]
[~] /shalat [daerah]
[~] /joox [judul lagu] 
[~] /jam
[~] /def [kata] 
[~] /img [kata] 
[~] /yt [judul] 
[~] @bye
[~] /creator
[~] /ssweb [link] 
[~] Me
[~] /brainly [pertanyaan] 
[~] /loginqr
[~] /shorter [url] 
[~] /film-syn [judul film]
[~] /translate [text]
END';
		$responses['messages']['0']['contents']['contents'][0]['body']['contents'][1]['wrap'] = true;
		$responses['messages']['0']['contents']['contents'][1]['type'] = 'bubble';
		$responses['messages']['0']['contents']['contents'][1]['body']['type'] = 'box';
		$responses['messages']['0']['contents']['contents'][1]['body']['layout'] = 'vertical';
		$responses['messages']['0']['contents']['contents'][1]['body']['contents'][0]['type'] = 'text';
		$responses['messages']['0']['contents']['contents'][1]['body']['contents'][0]['text'] = '[~] Support [~]';
		$responses['messages']['0']['contents']['contents'][1]['body']['contents'][1]['type'] = 'text';
		$responses['messages']['0']['contents']['contents'][1]['body']['contents'][1]['text'] = 'Jika ada command yg error
silahkan kontak creator';
		$responses['messages']['0']['contents']['contents'][1]['body']['contents'][1]['wrap'] = true;
		$responses['messages']['0']['contents']['contents'][1]['body']['contents'][2]['type'] = 'button';
		$responses['messages']['0']['contents']['contents'][1]['body']['contents'][2]['style'] = 'primary';
		$responses['messages']['0']['contents']['contents'][1]['body']['contents'][2]['color'] = '#0083FF';
		$responses['messages']['0']['contents']['contents'][1]['body']['contents'][2]['action']['type'] = 'uri';
		$responses['messages']['0']['contents']['contents'][1]['body']['contents'][2]['action']['label'] = 'My Creator';
		$responses['messages']['0']['contents']['contents'][1]['body']['contents'][2]['action']['uri'] = 'https://line.me/ti/p/t4tUbw-0Pz';
		
		
		$res = json_encode($responses);
		$result_json = json_decode($res, TRUE);
		$balas=$result_json;
	} 
} 

if($message['type']=='text') {
        if ($command == '/creator') { 
     
        $balas = array( 
            'replyToken' => $replyToken, 
            'messages' => array( 
                array ( 
                        'type' => 'template', 
                          'altText' => 'About Creator', 
                          'template' =>  
                          array ( 
                            'type' => 'buttons', 
                            'thumbnailImageUrl' => 'https://pre00.deviantart.net/01bf/th/pre/f/2018/040/6/b/the_scientists_by_damaimikaz-dc2n9sx.png', 
                            'imageAspectRatio' => 'rectangle', 
                            'imageSize' => 'cover', 
                            'imageBackgroundColor' => '#FFFFFF', 
                            'title' => '[ ABOUT CREATOR ]', 
                            'text' => 'Alkhoarizmy', 
                            'actions' =>  
                            array ( 
                              0 =>  
                              array ( 
                                'type' => 'uri', 
                                'label' => 'Contact', 
                                'uri' => 'https://line.me/ti/p/t4tUbw-0Pz', 
                              ), 
                            ), 
                          ), 
                        ) 
            ) 
        ); 
    }
}

if($message['type']=='text') {
	if ($command == 'help'||$command == 'Help'||$command == '/help') {
		$balas = array( 
            'replyToken' => $replyToken, 
            'messages' => array( 
                array ( 
                  'type' => 'template', 
                  'altText' => 'alkhBot',
                  'template' =>
                  	array(
                  	    'type' => 'image_carousel',
                          'columns' =>
                          	array(
                              	0 =>
                              	    array(
                          	            'imageUrl' => 'https://pre00.deviantart.net/f17d/th/pre/f/2018/014/9/0/lecture_by_damaimikaz-dbzz6qr.png',
                                          'action' =>
                                          	array(
                                              	'type' => 'message',
                                                  'label' => 'JOOX',
                                                  'text' => 'contoh=> /joox meraih bintang'
                                              ),
                                      ),
                                  1 =>
                                  	array(
                                  	    'imageUrl' => 'https://pre00.deviantart.net/d4ee/th/pre/f/2017/343/5/8/party_squad_by_damaimikaz-dbw71rm.png',
                                          'action' =>
                                          	array(
                                                  'type' => 'message',
                                                  'label' => 'INSTAGRAM',
                                                  'text' => 'contoh=> /ig instagram'
                                              ),
                                      ),
                                  2 =>
                                  	array(
                                  	    'imageUrl' => 'https://pre00.deviantart.net/d4b3/th/pre/f/2018/033/4/3/successful_mission_by_damaimikaz-dc1xl76.png',
                                          'action' =>
                                          	array(
                                                  'type' => 'message',
                                                  'label' => 'IMAGE',
                                                  'text' => 'contoh=> /img duck'
                                              ),
                                      ),
                                  3 =>
                                  	array(
                                  	    'imageUrl' => 'https://i.giphy.com/media/13ebMyYmmaXzgc/giphy.webp',
                                          'action' =>
                                          	array(
                                                  'type' => 'message',
                                                  'label' => 'JAM',
                                                  'text' => 'contoh=> /jam'
                                              ),
                                      ),
                                  4 =>
                                  	array(
                                  	    'imageUrl' => 'https://i.giphy.com/media/s6OiiampNcye4/giphy.webp',
                                          'action' =>
                                          	array(
                                                  'type' => 'message',
                                                  'label' => 'DEFINE',
                                                  'text' => 'contoh=> /def blyat'
                                              ),
                                      ),
                                  5 =>
                                  	array(
                                  	    'imageUrl' => 'https://pre00.deviantart.net/ba7a/th/pre/i/2018/005/f/9/wanderer_by_kate_fox-dbz1dfh.jpg',
                                          'action' =>
                                          	array(
                                                  'type' => 'message',
                                                  'label' => 'SHALAT',
                                                  'text' => 'contoh=> /shalat serang'
                                              ),
                                      ),
                                  6 =>
                                  	array(
                                  	    'imageUrl' => 'https://i.gifer.com/YUhL.gif',
                                          'action' =>
                                          	array(
                                                  'type' => 'message',
                                                  'label' => 'YOUTUBE',
                                                  'text' => 'contoh=> /yt bitch lasagna'
                                              ),
                                      ),
                                  7 =>
                                  	array(
                                  	    'imageUrl' => 'https://img00.deviantart.net/3aaf/i/2018/140/3/7/mercy_and_genji_by_raikoart-dcc0kie.png',
                                          'action' =>
                                          	array(
                                                  'type' => 'message',
                                                  'label' => 'Film Syn',
                                                  'text' => 'contoh=> /film-syn venom'
                                              ),
                                      ),
                                  8 =>
                                  	array(
                                  	    'imageUrl' => 'https://pre00.deviantart.net/8df1/th/pre/f/2017/273/9/3/war_by_guweiz-dbp0ggr.jpg',
                                          'action' =>
                                          	array(
                                                  'type' => 'message',
                                                  'label' => 'HELP2',
                                                  'text' => 'Help2'
                                              ),
                                      ),
                                  9 =>
                                  	array(
                                  	    'imageUrl' => 'https://pre00.deviantart.net/b27a/th/pre/f/2018/005/f/c/fighting_the_mobs_by_damaimikaz-dbz0ti3.png',
                                          'action' =>
                                          	array(
                                                  'type' => 'message',
                                                  'label' => 'CREATOR',
                                                  'text' => '/creator'
                                              ),
                                      ),
                              ),
                      ),
                ),
            ),
        );
    }
}

/*
    ×××SEARCH YOUTUBE V1×××
*/
function youtube($keyword) {	#Kalau di bot Yuuko-chan ini adalah Function /youtube, PUBLIC API ini dapat dari website google.com
    $uri = "https://www.googleapis.com/youtube/v3/search?part=snippet&order=relevance&regionCode=lk&q=". $keyword ."&key=AIzaSyA6JQDWAVYXN07fZAtBK-ATcBg750J68bQ&maxResults=10&type=video";		 	#Ubah kata kata MASUKAN_APPID_KALIAN dengan APP ID kalian cara ambil Api key ada ditutor, video tutorialnya ada di folder Materi -> 9 Lain Lain
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $parsed = array();
    $parsed['a1'] = $json['items']['0']['id']['videoId'];
	$parsed['b1'] = $json['items']['0']['snippet']['title'];
	$parsed['c1'] = $json['items']['0']['snippet']['thumbnails']['high']['url'];
	$parsed['d1'] = $json['items']['0']['snippet']['channelTitle'];
    $parsed['a2'] = $json['items']['1']['id']['videoId'];
	$parsed['b2'] = $json['items']['1']['snippet']['title'];
	$parsed['c2'] = $json['items']['1']['snippet']['thumbnails']['high']['url'];
	$parsed['d2'] = $json['items']['1']['snippet']['channelTitle'];
    $parsed['a3'] = $json['items']['2']['id']['videoId'];
	$parsed['b3'] = $json['items']['2']['snippet']['title'];
	$parsed['c3'] = $json['items']['2']['snippet']['thumbnails']['high']['url'];
	$parsed['d3'] = $json['items']['2']['snippet']['channelTitle'];
    $parsed['a4'] = $json['items']['3']['id']['videoId'];
	$parsed['b4'] = $json['items']['3']['snippet']['title'];
	$parsed['c4'] = $json['items']['3']['snippet']['thumbnails']['high']['url'];
	$parsed['d4'] = $json['items']['3']['snippet']['channelTitle'];
    $parsed['a5'] = $json['items']['4']['id']['videoId'];
	$parsed['b5'] = $json['items']['4']['snippet']['title'];
	$parsed['c5'] = $json['items']['4']['snippet']['thumbnails']['high']['url'];
	$parsed['d5'] = $json['items']['5']['snippet']['channelTitle'];
    $parsed['a6'] = $json['items']['5']['id']['videoId'];
	$parsed['b6'] = $json['items']['5']['snippet']['title'];
	$parsed['c6'] = $json['items']['5']['snippet']['thumbnails']['high']['url'];
	$parsed['d6'] = $json['items']['6']['snippet']['channelTitle'];
    $parsed['a7'] = $json['items']['6']['id']['videoId'];
	$parsed['b7'] = $json['items']['6']['snippet']['title'];	
	$parsed['c7'] = $json['items']['6']['snippet']['thumbnails']['high']['url'];
	$parsed['d7'] = $json['items']['6']['snippet']['channelTitle'];
    $parsed['a8'] = $json['items']['7']['id']['videoId'];
	$parsed['b8'] = $json['items']['7']['snippet']['title'];
	$parsed['c8'] = $json['items']['7']['snippet']['thumbnails']['high']['url'];
	$parsed['d8'] = $json['items']['7']['snippet']['channelTitle'];
    $parsed['a9'] = $json['items']['8']['id']['videoId'];
	$parsed['b9'] = $json['items']['8']['snippet']['title'];
	$parsed['c9'] = $json['items']['8']['snippet']['thumbnails']['high']['url'];
	$parsed['d9'] = $json['items']['8']['snippet']['channelTitle'];
    $parsed['a10'] = $json['items']['9']['id']['videoId'];
	$parsed['b10'] = $json['items']['9']['snippet']['title'];	
	$parsed['c10'] = $json['items']['9']['snippet']['thumbnails']['high']['url'];
	$parsed['d10'] = $json['items']['9']['snippet']['channelTitle'];
    return $parsed;
}
/*××××××*/
if($message['type'] =='text') {
	if($command=='/shorter') {
		$uri='https://rest.farzain.com/api/url.php?id='.$options.'&apikey=ppqeuy';
		$response = Unirest\Request::get("$uri");
		$json = json_decode($response->raw_body, true);
		$responses['replyToken'] = $replyToken;
		$responses['messages'][0]['type']='text';
		$responses['messages'][0]['text']=$json['url'];
		$res = json_encode($responses);
        $result_json = json_decode($res, TRUE);
		$balas=$result_json;
	} 
} 

if($message['type']=='text') {
	if ($command == '/film-syn') {
		$result = film_syn($options);
        $responses['replyToken'] = $replyToken;
        $responses['messages']['0']['type'] = 'text';
        $responses['messages']['0']['text'] = $result['hasil'];
        $responses['messages']['1']['type'] = 'image';
        $responses['messages']['1']['originalContentUrl'] = $result['poster'];
        $responses['messages']['1']['previewImageUrl'] = $result['poster'];
        $res = json_encode($responses);
        $result_json = json_decode($res, TRUE);
		$balas=$result_json;
    }
}

#>>>>>>>>>>>>>>>ZONE QR<<<<<<<<<<<<<<<<#
if($message['type']=='text') {
	if ($command == '/loginqr') {
        $responses['replyToken'] = $replyToken;
        $responses['messages']['0']['type'] = "template";
        $responses['messages']['0']['altText'] = "LIST TOKEN";
        $responses['messages']['0']['template']['type'] = "carousel";
        $responses['messages']['0']['template']['columns'][0]['thumnnailImageUrl'] = NULL;
        $responses['messages']['0']['template']['columns'][0]['imageBackgroundColor'] = "#FFFFFF";
        $responses['messages']['0']['template']['columns'][0]['title'] = 'TOKEN 1';
        $responses['messages']['0']['template']['columns'][0]['text'] = 'CHROMEOS';
        $responses['messages']['0']['template']['columns'][0]['actions'][0]['type'] = 'message';
        $responses['messages']['0']['template']['columns'][0]['actions'][0]['label'] = 'CLICK';
        $responses['messages']['0']['template']['columns'][0]['actions'][0]['text'] = 'login_chromeos';
        $responses['messages']['0']['template']['columns'][1]['thumnnailImageUrl'] = NULL;
        $responses['messages']['0']['template']['columns'][1]['imageBackgroundColor'] = "#FFFFFF";
        $responses['messages']['0']['template']['columns'][1]['title'] = 'TOKEN 2';
        $responses['messages']['0']['template']['columns'][1]['text'] = 'CLOVAFRIENDS';
        $responses['messages']['0']['template']['columns'][1]['actions'][0]['type'] = 'message';
        $responses['messages']['0']['template']['columns'][1]['actions'][0]['label'] = 'CLICK';
        $responses['messages']['0']['template']['columns'][1]['actions'][0]['text'] = 'login_clova';
        $responses['messages']['0']['template']['columns'][2]['thumnnailImageUrl'] = NULL;
        $responses['messages']['0']['template']['columns'][2]['imageBackgroundColor'] = "#FFFFFF";
        $responses['messages']['0']['template']['columns'][2]['title'] = 'TOKEN 3';
        $responses['messages']['0']['template']['columns'][2]['text'] = 'IOSIPAD';
        $responses['messages']['0']['template']['columns'][2]['actions'][0]['type'] = 'message';
        $responses['messages']['0']['template']['columns'][2]['actions'][0]['label'] = 'CLICK';
        $responses['messages']['0']['template']['columns'][2]['actions'][0]['text'] = 'login_ios';
        $responses['messages']['0']['template']['columns'][3]['thumnnailImageUrl'] = NULL;
        $responses['messages']['0']['template']['columns'][3]['imageBackgroundColor'] = "#FFFFFF";
        $responses['messages']['0']['template']['columns'][3]['title'] = 'TOKEN 4';
        $responses['messages']['0']['template']['columns'][3]['text'] = 'DESKTOPMAC';
        $responses['messages']['0']['template']['columns'][3]['actions'][0]['type'] = 'message';
        $responses['messages']['0']['template']['columns'][3]['actions'][0]['label'] = 'CLICK';
        $responses['messages']['0']['template']['columns'][3]['actions'][0]['text'] = 'login_mac';
        $responses['messages']['0']['template']['columns'][4]['thumnnailImageUrl'] = NULL;
        $responses['messages']['0']['template']['columns'][4]['imageBackgroundColor'] = "#FFFFFF";
        $responses['messages']['0']['template']['columns'][4]['title'] = 'TOKEN 5';
        $responses['messages']['0']['template']['columns'][4]['text'] = 'WIN10';
        $responses['messages']['0']['template']['columns'][4]['actions'][0]['type'] = 'message';
        $responses['messages']['0']['template']['columns'][4]['actions'][0]['label'] = 'CLICK';
        $responses['messages']['0']['template']['columns'][4]['actions'][0]['text'] = 'login_win10';
        
        $result = json_encode($responses);
        $result_json = json_decode($result, TRUE);
		$balas=$result_json;
	}
}
if($message['type']=='text') {
	if ($command == 'login_chromeos') {
    	$uri='https://api.eater.pw/token?header=CHROMEOS';
		$response = Unirest\Request::get("$uri");
		$json = json_decode($response->raw_body, true);
		$responses['replyToken'] = $replyToken;
		$responses['messages']['0']['type'] = 'text';
		$responses['messages']['0']['text'] = $json['result'][0]['linkqr'];
		$responses['messages']['1']['type'] = 'text';
		$responses['messages']['1']['text'] = 'jika sudah klik link ini: '. $json['result'][0]['linktkn'];
		
		$result = json_encode($responses);
        $result_json = json_decode($result, TRUE);
		$balas=$result_json;
	} 
} 
if($message['type']=='text') {
	if ($command == 'login_clova') {
    	$uri='https://api.eater.pw/token?header=CLOVAFRIENDS';
		$response = Unirest\Request::get("$uri");
		$json = json_decode($response->raw_body, true);
		$responses['replyToken'] = $replyToken;
		$responses['messages']['0']['type'] = 'text';
		$responses['messages']['0']['text'] = $json['result'][0]['linkqr'];
		$responses['messages']['1']['type'] = 'text';
		$responses['messages']['1']['text'] = 'jika sudah klik link ini: '. $json['result'][0]['linktkn'];
		
		$result = json_encode($responses);
        $result_json = json_decode($result, TRUE);
		$balas=$result_json;
	} 
} 
if($message['type']=='text') {
	if ($command == 'login_ios') {
    	$uri='https://api.eater.pw/token?header=IOSIPAD';
		$response = Unirest\Request::get("$uri");
		$json = json_decode($response->raw_body, true);
		$responses['replyToken'] = $replyToken;
		$responses['messages']['0']['type'] = 'text';
		$responses['messages']['0']['text'] = $json['result'][0]['linkqr'];
		$responses['messages']['1']['type'] = 'text';
		$responses['messages']['1']['text'] = 'jika sudah klik link ini: '. $json['result'][0]['linktkn'];
		
		$result = json_encode($responses);
        $result_json = json_decode($result, TRUE);
		$balas=$result_json;
	} 
} 
if($message['type']=='text') {
	if ($command == 'login_mac') {
    	$uri='https://api.eater.pw/token?header=DESKTOPMAC';
		$response = Unirest\Request::get("$uri");
		$json = json_decode($response->raw_body, true);
		$responses['replyToken'] = $replyToken;
		$responses['messages']['0']['type'] = 'text';
		$responses['messages']['0']['text'] = $json['result'][0]['linkqr'];
		$responses['messages']['1']['type'] = 'text';
		$responses['messages']['1']['text'] = 'jika sudah klik link ini: '. $json['result'][0]['linktkn'];
		
		$result = json_encode($responses);
        $result_json = json_decode($result, TRUE);
		$balas=$result_json;
	} 
} 
if($message['type']=='text') {
	if ($command == 'login_win10') {
    	$uri='https://api.eater.pw/token?header=WIN10';
		$response = Unirest\Request::get("$uri");
		$json = json_decode($response->raw_body, true);
		$responses['replyToken'] = $replyToken;
		$responses['messages']['0']['type'] = 'text';
		$responses['messages']['0']['text'] = $json['result'][0]['linkqr'];
		$responses['messages']['1']['type'] = 'text';
		$responses['messages']['1']['text'] = 'jika sudah klik link ini: '. $json['result'][0]['linktkn'];
		
		$result = json_encode($responses);
        $result_json = json_decode($result, TRUE);
		$balas=$result_json;
	} 
} 

#>>>>>>>>>>>>>>>ZONE QR<<<<<<<<<<<<<<<<#

if($message['type']=='text') {
	if ($command == '/soundcloud') {
		$hasil = soundcloud($options);
		$responses['replyToken'] = $replyToken;
		$responses['messages']['0']['type'] = "template";
		$responses['messages']['0']['altText'] = "Sound Cloud";
	    $responses['messages']['0']['template']['type'] = "carousel";
	    $responses['messages']['0']['template']['columns'][0]['thumnnailImageUrl'] = $hasil['c'];
	    $responses['messages']['0']['template']['columns'][0]['imageBackgroundColor'] = '#FFFFFF';
	    $responses['messages']['0']['template']['columns'][0]['title'] = 'Hasil 1';
	    $responses['messages']['0']['template']['columns'][0]['text'] = $hasil['b'];
	    $responses['messages']['0']['template']['columns'][0]['actions'][0]['type'] = 'uri';
	    $responses['messages']['0']['template']['columns'][0]['actions'][0]['label'] = 'DOWNLOAD';
	    $responses['messages']['0']['template']['columns'][0]['actions'][0]['uri'] = $hasil['d'];
	    $responses['messages']['0']['template']['columns'][0]['actions'][1]['type'] = 'uri';
	    $responses['messages']['0']['template']['columns'][0]['actions'][1]['label'] = 'URL';
	    $responses['messages']['0']['template']['columns'][0]['actions'][1]['uri'] = $hasil['e'];
	    $responses['messages']['0']['template']['columns'][1]['thumnnailImageUrl'] = $hasil['c1'];
	    $responses['messages']['0']['template']['columns'][1]['imageBackgroundColor'] = '#FFFFFF';
	    $responses['messages']['0']['template']['columns'][1]['title'] = 'Hasil 2';
	    $responses['messages']['0']['template']['columns'][1]['text'] = $hasil['b1'];
	    $responses['messages']['0']['template']['columns'][1]['actions'][0]['type'] = 'uri';
	    $responses['messages']['0']['template']['columns'][1]['actions'][0]['label'] = 'DOWNLOAD';
	    $responses['messages']['0']['template']['columns'][1]['actions'][0]['uri'] = $hasil['d1'];
	    $responses['messages']['0']['template']['columns'][1]['actions'][1]['type'] = 'uri';
	    $responses['messages']['0']['template']['columns'][1]['actions'][1]['label'] = 'URL';
	    $responses['messages']['0']['template']['columns'][1]['actions'][1]['uri'] = $hasil['e1'];
	    $responses['messages']['0']['template']['columns'][2]['thumnnailImageUrl'] = $hasil['c2'];
	    $responses['messages']['0']['template']['columns'][2]['imageBackgroundColor'] = '#FFFFFF';
	    $responses['messages']['0']['template']['columns'][2]['title'] = 'Hasil 3';
	    $responses['messages']['0']['template']['columns'][2]['text'] = $hasil['b2'];
	    $responses['messages']['0']['template']['columns'][2]['actions'][0]['type'] = 'uri';
	    $responses['messages']['0']['template']['columns'][2]['actions'][0]['label'] = 'DOWNLOAD';
  	  $responses['messages']['0']['template']['columns'][2]['actions'][0]['uri'] = $hasil['d2'];
	    $responses['messages']['0']['template']['columns'][2]['actions'][1]['type'] = 'uri';
	    $responses['messages']['0']['template']['columns'][2]['actions'][1]['label'] = 'URL';
	    $responses['messages']['0']['template']['columns'][2]['actions'][1]['uri'] = $hasil['e2'];
	    $responses['messages']['0']['template']['columns'][3]['thumnnailImageUrl'] = $hasil['c3'];
	    $responses['messages']['0']['template']['columns'][3]['imageBackgroundColor'] = '#FFFFFF';
	    $responses['messages']['0']['template']['columns'][3]['title'] = 'Hasil 4';
	    $responses['messages']['0']['template']['columns'][3]['text'] = $hasil['b3'];
	    $responses['messages']['0']['template']['columns'][3]['actions'][0]['type'] = 'uri';
	    $responses['messages']['0']['template']['columns'][3]['actions'][0]['label'] = 'DOWNLOAD';
	    $responses['messages']['0']['template']['columns'][3]['actions'][0]['uri'] = $hasil['d3'];
	    $responses['messages']['0']['template']['columns'][3]['actions'][1]['type'] = 'uri';
	    $responses['messages']['0']['template']['columns'][3]['actions'][1]['label'] = 'URL';
	    $responses['messages']['0']['template']['columns'][3]['actions'][1]['uri'] = $hasil['e3'];
	    $responses['messages']['0']['template']['columns'][4]['thumnnailImageUrl'] = $hasil['c4'];
	    $responses['messages']['0']['template']['columns'][4]['imageBackgroundColor'] = '#FFFFFF';
	    $responses['messages']['0']['template']['columns'][4]['title'] = 'Hasil 5';
	    $responses['messages']['0']['template']['columns'][4]['text'] = $hasil['b4'];
	    $responses['messages']['0']['template']['columns'][4]['actions'][0]['type'] = 'uri';
	    $responses['messages']['0']['template']['columns'][4]['actions'][0]['label'] = 'DOWNLOAD';
	    $responses['messages']['0']['template']['columns'][4]['actions'][0]['uri'] = $hasil['d4'];
	    $responses['messages']['0']['template']['columns'][4]['actions'][1]['type'] = 'uri';
	    $responses['messages']['0']['template']['columns'][4]['actions'][1]['label'] = 'URL';
	    $responses['messages']['0']['template']['columns'][4]['actions'][1]['uri'] = $hasil['e4'];
    
	    $result = json_encode($responses);
	    $result_json = json_decode($result, TRUE);
		$balas=$result_json;
	} 
} 

if($message['type']=='text') {
	if ($command == '/brainly') {
		$uri = "https://rest.farzain.com/api/brainly.php?id=". $options ."&apikey=1MJ11rZNOM4XbZn8U0PTIsAJh";
		$response = Unirest\Request::get("$uri");
        $json = json_decode($response->raw_body, true);
        $responses['replyToken'] = $replyToken;
        $responses['messages']['0']['type'] = "template";
        $responses['messages']['0']['altText'] = "Brainly";
        $responses['messages']['0']['template']['type'] = "carousel";
        $responses['messages']['0']['template']['columns'][0]['thumnnailImageUrl'] = NULL;
        $responses['messages']['0']['template']['columns'][0]['imageBackgroundColor'] = "#FFFFFF";
        $responses['messages']['0']['template']['columns'][0]['title'] = 'Result 1';
        $responses['messages']['0']['template']['columns'][0]['text'] = substr($json['0']['title'],0,55);
        $responses['messages']['0']['template']['columns'][0]['actions'][0]['type'] = 'uri';
        $responses['messages']['0']['template']['columns'][0]['actions'][0]['label'] = 'URL';
        $responses['messages']['0']['template']['columns'][0]['actions'][0]['uri'] = $json['0']['url'];
        $responses['messages']['0']['template']['columns'][1]['thumnnailImageUrl'] = NULL;
        $responses['messages']['0']['template']['columns'][1]['imageBackgroundColor'] = "#FFFFFF";
        $responses['messages']['0']['template']['columns'][1]['title'] = 'Result 2';
        $responses['messages']['0']['template']['columns'][1]['text'] = substr($json['1']['title'],0,55);
        $responses['messages']['0']['template']['columns'][1]['actions'][0]['type'] = 'uri';
        $responses['messages']['0']['template']['columns'][1]['actions'][0]['label'] = 'URL';
        $responses['messages']['0']['template']['columns'][1]['actions'][0]['uri'] = $json['1']['url'];
        $responses['messages']['0']['template']['columns'][2]['thumnnailImageUrl'] = NULL;
        $responses['messages']['0']['template']['columns'][2]['imageBackgroundColor'] = "#FFFFFF";
        $responses['messages']['0']['template']['columns'][2]['title'] = 'Result 3';
        $responses['messages']['0']['template']['columns'][2]['text'] = substr($json['2']['title'],0,55);
        $responses['messages']['0']['template']['columns'][2]['actions'][0]['type'] = 'uri';
        $responses['messages']['0']['template']['columns'][2]['actions'][0]['label'] = 'URL';
        $responses['messages']['0']['template']['columns'][2]['actions'][0]['uri'] = $json['2']['url'];
        $responses['messages']['0']['template']['columns'][3]['thumnnailImageUrl'] = NULL;
        $responses['messages']['0']['template']['columns'][3]['imageBackgroundColor'] = "#FFFFFF";
        $responses['messages']['0']['template']['columns'][3]['title'] = 'Result 4';
        $responses['messages']['0']['template']['columns'][3]['text'] = substr($json['3']['title'],0,55);
        $responses['messages']['0']['template']['columns'][3]['actions'][0]['type'] = 'uri';
        $responses['messages']['0']['template']['columns'][3]['actions'][0]['label'] = 'URL';
        $responses['messages']['0']['template']['columns'][3]['actions'][0]['uri'] = $json['3']['url'];
        $responses['messages']['0']['template']['columns'][4]['thumnnailImageUrl'] = NULL;
        $responses['messages']['0']['template']['columns'][4]['imageBackgroundColor'] = "#FFFFFF";
        $responses['messages']['0']['template']['columns'][4]['title'] = 'Result 5';
        $responses['messages']['0']['template']['columns'][4]['text'] = substr($json['4']['title'],0,55);
        $responses['messages']['0']['template']['columns'][4]['actions'][0]['type'] = 'uri';
        $responses['messages']['0']['template']['columns'][4]['actions'][0]['label'] = 'URL';
        $responses['messages']['0']['template']['columns'][4]['actions'][0]['uri'] = $json['4']['url'];
        
        $result = json_encode($responses);
        $result_json = json_decode($result, TRUE);
		$balas=$result_json;
	}
}

if($message['type']=='text') {
	if ($command == 'pesan_sebelumnya') {
		$unsend=file_get_contents('./pesan.json');
		$responses['replyToken'] = $replyToken;
        $responses['messages']['0']['type'] = "text";
        $responses['messages']['0']['text'] = 'menampilkan pesan sebelumnya: '.$unsend;
        
        $result = json_encode($responses);
        $result_json = json_decode($result, TRUE);
		$balas=$result_json;
	} 
} 

#=====
if($message['type']=='text') {
	if ($command == 'test') {     
        $responses['replyToken'] = $replyToken;
        $responses['messages']['0']['type'] = "template";
        $responses['messages']['0']['altText'] = "POSTBACK";
        $responses['messages']['0']['template']['type'] = "carousel";
        $responses['messages']['0']['template']['columns'][0]['thumbnailImageUrl'] = NULL;
        $responses['messages']['0']['template']['columns'][0]['imageBackgroundColor'] = "#FFFFFF";
        $responses['messages']['0']['template']['columns'][0]['title'] = "test";
        $responses['messages']['0']['template']['columns'][0]['text'] = "POSTBACK INI";
        $responses['messages']['0']['template']['columns'][0]['actions'][0]['type'] = "message";
        $responses['messages']['0']['template']['columns'][0]['actions'][0]['label'] ="hah?";
        $responses['messages']['0']['template']['columns'][0]['actions'][0]['text'] = "hehoh";        
        $responses['messages']['0']['template']['columns'][0]['actions'][1]['type'] = "postback";
        $responses['messages']['0']['template']['columns'][0]['actions'][1]['label'] ="tes";
        $responses['messages']['0']['template']['columns'][0]['actions'][1]['data'] = "tis $profileName";

        $result = json_encode($responses);
        $result_json = json_decode($result, TRUE);
		$balas=$result_json;
	}
}

if($message['type']=='text') {
	if ($command == 'mbehek') {
		$responses['replyToken'] = $replyToken;
		$responses['messages']['0']['type'] = "video";
		$responses['messages']['0']['originalContentUrl'] = "https://alkhrzmy.online/img/lul.mp4";
		$responses['messages']['0']['previewImageUrl'] = "https://alkhrzmy.online/img/img1.png";
		$responses['messages']['1']['type'] = "video";
		$responses['messages']['1']['originalContentUrl'] = "https://alkhrzmy.online/img/lol.mp4";
		$responses['messages']['1']['previewImageUrl'] = "https://alkhrzmy.online/img/img1.png";
		
		$result = json_encode($responses);
        $result_json = json_decode($result, TRUE);
		$balas=$result_json;
	}
} 

if($message['type']=='text') {
	if ($command == 'groupId') {
		$responses['replyToken'] = $replyToken;
		$responses['messages']['0']['type'] = "text";
		$responses['messages']['0']['text'] = $groupId;
		
		$result = json_encode($responses);
        $result_json = json_decode($result, TRUE);
		$balas=$result_json;
	} 
} 

if($message['type']=='text') {
	if ($command == 'myID') {
		$responses['replyToken'] = $replyToken;
		$responses['messages']['0']['type'] = "text";
		$responses['messages']['0']['text'] = $userId;
		
		$result = json_encode($responses);
        $result_json = json_decode($result, TRUE);
		$balas=$result_json;
	} 
} 

if($message['type']=='text') {
	if ($command == '/jam') {
        $result = wib($options); 
        $result2 = wit($options); 
        $result3 = wita($options); 
        $balas = array( 
            'replyToken' => $replyToken, 
            'messages' => array( 
                array ( 
                  'type' => 'template', 
                  'altText' => 'Jam Indonesia', 
                  'template' =>  
                  array ( 
                    'type' => 'carousel', 
                    'columns' =>  
                    array ( 
                      0 =>  
                      array ( 
                        'thumbnailImageUrl' => 'https://preview.ibb.co/gXGfLU/20180913_194713.jpg', 
                        'imageBackgroundColor' => '#FFFFFF', 
                        'title' => 'WIB', 
                        'text' => 'Jam Indonesia WIB', 
                        'actions' =>  
                        array ( 
                          0 =>  
                          array ( 
                            'type' => 'postback', 
                            'label' => $result['time'], 
                            'data' => '/creator', 
                          ), 
                          1 =>  
                          array ( 
                            'type' => 'postback', 
                            'label' => $result['date'],
                            'data' => $result['date'],
                          ), 
                        ), 
                      ), 
                      1 =>  
                      array ( 
                        'thumbnailImageUrl' => 'https://preview.ibb.co/nxaPfU/20180913_194725.jpg', 
                        'imageBackgroundColor' => '#000000', 
                        'title' => 'WIT', 
                        'text' => 'Jam Indonesia WIT', 
                        'actions' =>  
                        array ( 
                          0 =>  
                          array ( 
                            'type' => 'postback', 
                            'label' => $result2['time'], 
                            'data' => $result2['time'], 
                          ), 
                          1 =>  
                          array ( 
                            'type' => 'postback', 
                            'label' => $result2['date'],
                            'data' => $result2['date'],
                          ), 
                        ), 
                      ), 
                      2 =>  
                      array ( 
                        'thumbnailImageUrl' => 'https://preview.ibb.co/cPdc0U/20180913_194744.jpg', 
                        'imageBackgroundColor' => '#000000', 
                        'title' => 'WITA', 
                        'text' => 'Jam Indonesia WITA', 
                        'actions' =>  
                        array ( 
                          0 =>  
                          array ( 
                            'type' => 'postback', 
                            'label' => $result3['time'], 
                            'data' => $result3['time'], 
                          ), 
                          1 =>  
                          array ( 
                            'type' => 'postback', 
                            'label' => $result3['date'],
                            'data' => $result3['date'],
                          ), 
                        ),  
                      ),
                    ), 
                  ), 
                ) 
            ) 
        ); 
    }
}

if($message['type']=='text') {
    if ($command == '/ig') { 
        
        $result = instagram($options);
        $altText2 = "Followers : " . $result['a3'];
        $altText2 .= "\nFollowing :" . $result['a4'];
        $altText2 .= "\nPost :" . $result['a5'];
        $balas = array( 
            'replyToken' => $replyToken, 
            'messages' => array( 
                array ( 
                        'type' => 'template', 
                          'altText' => 'Instagram ' . $options, 
                          'template' =>  
                          array ( 
                            'type' => 'buttons', 
                            'thumbnailImageUrl' => $result['a7'], 
                            'imageAspectRatio' => 'rectangle', 
                            'imageSize' => 'cover', 
                            'imageBackgroundColor' => '#FFFFFF', 
                            'title' => $result['a6'], 
                            'text' => $altText2, 
                            'actions' =>  
                            array ( 
                              0 =>  
                              array ( 
                                'type' => 'uri', 
                                'label' => 'Check', 
                                'uri' => $result['a8'],
                              ), 
                            ), 
                          ), 
                        ) 
            ) 
        ); 
    }
}
/* search ytb */
if($message['type']=='text') {
	    if ($command == '/yt') {

        $result = youtube($options);
        $balas = array(
			'replyToken' => $replyToken,
			'messages' => array(
				array (
					'type' => 'template',
					'altText' => 'youtube '. $commandSingle,
					'template' => 
					array (
						'type' => 'carousel',
						'columns' => 
						array (
							0 => 
							array (
								'thumbnailImageUrl' => $result['c1'],
								'imageBackgroundColor' => '#FFFFFF',
								'title' => 'Result 1',
								'text' => substr($result['b1'],0,55),
								'actions' => 
								array (
								0 => 
									array (
										'type' => 'uri',
										'label' => 'Streaming',
										'uri' => 'https://youtu.be/'.$result['a1'],
									),
								1 => 
									array (
										'type' => 'message',
										'label' => 'Unduh',
										'text' => '/ytdown '. $result['a1'],
									),
								2 => 
									array (
										'type' => 'message',
										'label' => 'YTMP3',
										'text' => '/ytmp3 '. $result['a1'],
									),
								),
							),
							1 => 
							array (
								'thumbnailImageUrl' => $result['c2'],
								'imageBackgroundColor' => '#FFFFFF',
								'title' => 'Result 2',
								'text' => substr($result['b2'],0,55),
								'actions' => 
								array (
								0 => 
									array (
										'type' => 'uri',
										'label' => 'Streaming',
										'uri' => 'https://youtu.be/'.$result['a2'],
									),
								1 => 
									array (
										'type' => 'message',
										'label' => 'Unduh',
										'text' => '/ytdown '. $result['a2'],
									),
								2 => 
									array (
										'type' => 'message',
										'label' => 'YTMP3',
										'text' => '/ytmp3 '. $result['a2'],
									),
								),
							),
							2 => 
							array (
								'thumbnailImageUrl' => $result['c3'],
								'imageBackgroundColor' => '#FFFFFF',
								'title' => 'Result 3',
								'text' => substr($result['b3'],0,55),
								'actions' => 
								array (
								0 => 
									array (
										'type' => 'uri',
										'label' => 'Streaming',
										'uri' => 'https://youtu.be/'.$result['a3'],
									),
								1 => 
									array (
										'type' => 'message',
										'label' => 'Unduh',
										'text' => '/ytdown '. $result['a3'],
									),
								2 => 
									array (
										'type' => 'message',
										'label' => 'YTMP3',
										'text' => '/ytmp3 '. $result['a3'],
									),
								),
							),
							3 => 
							array (
								'thumbnailImageUrl' => $result['c4'],
								'imageBackgroundColor' => '#FFFFFF',
								'title' => 'Result 4',
								'text' => substr($result['b4'],0,55),
								'actions' => 
								array (
								0 => 
									array (
										'type' => 'uri',
										'label' => 'Streaming',
										'uri' => 'https://youtu.be/'.$result['a4'],
									),
								1 => 
									array (
										'type' => 'message',
										'label' => 'Unduh',
										'text' => '/ytdown '. $result['a4'],
									),
								2 => 
									array (
										'type' => 'message',
										'label' => 'YTMP3',
										'text' => '/ytmp3 '. $result['a4'],
									),
								),
							),
							4 => 
							array (
								'thumbnailImageUrl' => $result['c5'],
								'imageBackgroundColor' => '#FFFFFF',
								'title' => 'Result 5',
								'text' => substr($result['b5'],0,55),
								'actions' => 
								array (
								0 => 
									array (
										'type' => 'uri',
										'label' => 'Streaming',
										'uri' => 'https://youtu.be/'.$result['a5'],
									),
								1 => 
									array (
										'type' => 'message',
										'label' => 'Unduh',
										'text' => '/ytdown '. $result['a5'],
									),
								2 => 
									array (
										'type' => 'message',
										'label' => 'YTMP3',
										'text' => '/ytmp3 '. $result['a5'],
									),
								),
							),
							5 => 
							array (
								'thumbnailImageUrl' => $result['c6'],
								'imageBackgroundColor' => '#FFFFFF',
								'title' => 'Result 6',
								'text' => substr($result['b6'],0,55),
								'actions' => 
								array (
								0 => 
									array (
										'type' => 'uri',
										'label' => 'Streaming',
										'uri' => 'https://youtu.be/'.$result['a6'],
									),
								1 => 
									array (
										'type' => 'message',
										'label' => 'Unduh',
										'text' => '/ytdown '. $result['a6'],
									),
								2 => 
									array (
										'type' => 'message',
										'label' => 'YTMP3',
										'text' => '/ytmp3 '. $result['a6'],
									),
								),
							),
							6 => 
							array (
								'thumbnailImageUrl' => $result['c7'],
								'imageBackgroundColor' => '#FFFFFF',
								'title' => 'Result 7',
								'text' => substr($result['b7'],0,55),
								'actions' => 
								array (
								0 => 
									array (
										'type' => 'uri',
										'label' => 'Streaming',
										'uri' => 'https://youtu.be/'.$result['a7'],
									),
								1 => 
									array (
										'type' => 'message',
										'label' => 'Unduh',
										'text' => '/ytdown '. $result['a7'],
									),
								2 => 
									array (
										'type' => 'message',
										'label' => 'YTMP3',
										'text' => '/ytmp3 '. $result['a7'],
									),
								),
							),
							7 => 
							array (
								'thumbnailImageUrl' => $result['c8'],
								'imageBackgroundColor' => '#FFFFFF',
								'title' => 'Result 8',
								'text' => substr($result['b8'],0,55),
								'actions' => 
								array (
								0 => 
									array (
										'type' => 'uri',
										'label' => 'Streaming',
										'uri' => 'https://youtu.be/'.$result['a8'],
									),
								1 => 
									array (
										'type' => 'message',
										'label' => 'Unduh',
										'text' => '/ytdown '. $result['a8'],
									),
								2 => 
									array (
										'type' => 'message',
										'label' => 'YTMP3',
										'text' => '/ytmp3 '. $result['a8'],
									),
								),
							),
							8 => 
							array (
								'thumbnailImageUrl' => $result['c9'],
								'imageBackgroundColor' => '#FFFFFF',
								'title' => 'Result 9',
								'text' => substr($result['b9'],0,55),
								'actions' => 
								array (
								0 => 
									array (
										'type' => 'uri',
										'label' => 'Streaming',
										'uri' => 'https://youtu.be/'.$result['a9'],
									),
								1 => 
									array (
										'type' => 'message',
										'label' => 'Unduh',
										'text' => '/ytdown '.$result['a9'],
									),
								2 => 
									array (
										'type' => 'message',
										'label' => 'YTMP3',
										'text' => '/ytmp3 '. $result['a9'],
									),
								),
							),
							9 => 
							array (
								'thumbnailImageUrl' => $result['c10'],
								'imageBackgroundColor' => '#FFFFFF',
								'title' => 'Result 10',
								'text' => substr($result['b10'],0,55),
								'actions' => 
								array (
								0 => 
									array (
										'type' => 'uri',
										'label' => 'Streaming',
										'uri' => 'https://youtu.be/'.$result['a10'],
									),
								1 => 
									array (
										'type' => 'message',
										'label' => 'Unduh',
										'text' => '/ytdown '. $result['a10'],
									),
								2 => 
									array (
										'type' => 'message',
										'label' => 'YTMP3',
										'text' => '/ytmp3 '. $result['a10'],
									),
								),
							),
						),
						'imageAspectRatio' => 'rectangle',
						'imageSize' => 'cover',
					 ),
				)
            )
		);
        
    }
}
if (isset($message['text'])) {
    $result = json_encode($message['text']).'- '.$profileName;

    file_put_contents('./pesan.json', $result);
}

if (isset($balas)) {
    $result = json_encode($balas);
//$result = ob_get_clean();

    file_put_contents('./balasan.json', $result);


    $client->replyMessage($balas);
}

#MySQL projek

$bobs = mysqli_connect("localhost","u841029483_bo","MlEFa7J>vgr#`W+s^B","u841029483_bot");

//error log
if(!$bobs) {
	echo('ada error'. mysqli_connect_error());
}
?>
