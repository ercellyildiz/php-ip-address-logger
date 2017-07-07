<?php
require_once 'config.php';
require 'countryCode.php';

$siteTitles = array(
"notfound" => "404 Not Found",
"servererror" => "500 Internal Server Error",
"movedpermanently" => "301 Moved Permanently",
"nocontent" => "204 No Content",
"found" => "302 Found",
"tempredir" => "307 Temporary Redirect",
"permredir" => "308 Permanent Redirect",
"badreq" => "400 Bad Request",
"unauthorized" => "401 Unauthorized",
"forbidden" => "403 Forbidden",
"gone" => "410 Gone",
"troll" => "418 I'm a Teapot",
"toomanyreqs" => "429 Too Many Requests",
"legal" => "451 Unavailable for Legal Reasons",
"windows-unofficial" => "450 Blocked by Windows Parental Controls"
);

$siteTitlesPT = array(
"notfound" => "404 Não Encontrado",
"servererror" => "500 Erro de Servidor Interno",
"movedpermanently" => "301 Movido Permanenentemente",
"nocontent" => "204 Sem Conteúdo",
"found" => "302 Encontrado",
"tempredir" => "307 Redirecionamento Temporário",
"permredir" => "308 Redirecionamento Permanente",
"badreq" => "400 Pedido mal-feito",
"unauthorized" => "401 Sem Autorização",
"forbidden" => "403 Proíbido",
"gone" => "410 Desaparecido",
"troll" => "418 I'm a Teapot",
"toomanyreqs" => "429 Demasiados Pedidos",
"legal" => "451 Indisponível por razões legais",
"windows-unofficial" => "450 Bloqueado pelos controlos parentais do Windows"
);

$siteTitlesCN = array(
"notfound" => "404 未找到",
"servererror" => "500 内部服务器错误",
"movedpermanently" => "301 永久移动",
"nocontent" => "204 无内容",
"found" => "302 发现",
"tempredir" => "307 临时重定向",
"permredir" => "308 永久重定向",
"badreq" => "400 错误的请求",
"unauthorized" => "401 擅自",
"forbidden" => "403 被禁止",
"gone" => "410 消失",
"troll" => "418 I'm a Teapot",
"toomanyreqs" => "429 太多的请求",
"legal" => "451 不可出于法律原因",
"windows-unofficial" => "通过家长控制的Windows受阻"
);

$siteTitlesFR = array(
"notfound" => "404 Introuvable",
"servererror" => "500 Internal Server Error",
"movedpermanently" => "301 déplacé Permanenentemente",
"nocontent" => "204 Aucun contenu",
"found" => "302 Trouvé",
"tempredir" => "307 redirection temporaire",
"permredir" => "308 redirection permanente",
"badreq" => "400 Demande bâclée",
"unauthorized" => "401 sans autorisation",
"forbidden" => "403 interdit",
"gone" => "410 disparu",
"troll" => "418 I'm a Teapot",
"toomanyreqs" => "429 trop nombreuses demandes",
"legal" => "451 Non disponible pour des raisons juridiques",
"windows-unofficial" => "450 Bloqué par contrôle parental de Windows"
);

$siteTitlesDE = array(
"notfound" => "404 nicht gefunden",
"servererror" => "500 Internal Server Error",
"movedpermanently" => "301 Moved Permanently",
"nocontent" => "204 Kein Inhalt",
"found" => "302 Gefunden",
"tempredir" => "307 Vorübergehende Umleitung",
"permredir" => "308 Permanent Redirect",
"badreq" => "400 Ungültige Anforderung",
"unauthorized" => "401 Ungültige Anforderung",
"forbidden" => "403 Verboten",
"gone" => "410 gegangen",
"troll" => "418 I'm a Teapot",
"toomanyreqs" => "429 zu viele Anfragen",
"legal" => "451 Aus rechtlichen Gründen nicht verfügbar",
"windows-unofficial" => "450 Von Windows-Jugendschutz blockiert"
);


$siteTitlesRU = array(
"notfound" => "404 nicht gefunden",
"servererror" => "500 Внутренняя ошибка сервера",
"movedpermanently" => "301 окончательно перемещено",
"nocontent" => "204 нет содержимого",
"found" => "302 Найдено",
"tempredir" => "307 временная переадресация",
"permredir" => "308 постоянное перенаправление",
"badreq" => "400 Неверный запрос",
"unauthorized" => "401 несанкционированное",
"forbidden" => "403 запрещено",
"gone" => "410 Gone",
"troll" => "418 I'm a Teapot",
"toomanyreqs" => "429 слишком много запросов",
"legal" => "451 Недоступны по юридическим причинам",
"windows-unofficial" => "450 Blocked by родительского контроля Windows"
);



$possibleCountryCodes = array("Portuguese" => "PT",
                              "USEnglish" => "US",
                              "GBEnglish" => "GB",
                              "Chinese" => "CN",
                              "French" => "FR",
                              "German" => "DE",
                              "Russian" => "RU"
                              );
//


$titleBegin = "<title>";
$titleEnd = "</title>";
$dash = "&ndash;";
define("defaultmessage", "User doesn'\t have any defined language. Using english.");

try 
{
  
  $countryCode = getCountryCode($_SERVER['REMOTE_ADDR']);
  
}
catch (IllegalStateException $e)
{
  if ($debugMode == true)
  {
    echo "<br>";
    echo "<h1>Fatal API error: Could not retrieve information: " . $e->getMessage();
    echo "<br>";
    $countryCode = "US";
    
  }
  else
  {
    
      $countryCode = "US";
    
  }
}

switch (behaviormode) {
    case "404": // set header, set title and serve status page
        switch($countryCode) {
          case "PT":
            header('HTTP/1.1 404 Not Found');
            echo "<title>" . sitename . " - " . $siteTitlesPT["notfound"] . "</title>";
            include(__DIR__ . '/statusPages/pt-PT/404.html'); //TODO Change filename to correct language
            break;
          case "US":
            header('HTTP/1.1 404 Not Found');
            echo $titleBegin . sitename . $dash . $siteTitles["notfound"] . $titleEnd;
            include(__DIR__ . 'statusPages/404.html');
            break;
          case "GB":
            header('HTTP/1.1 404 Not Found');
            echo $titleBegin . sitename . $dash . $siteTitles["notfound"] . $titleEnd;
            include(__DIR__ .'statusPages/404.html');
            break;
          case "CN":
            header('HTTP/1.1 404 Not Found');
            echo $titleBegin . sitename . $dash . $siteTitlesCN["notfound"] . $titleEnd;
            include(__DIR__ . 'statusPages/cn/404.html');
            break;
          case "FR":
            header('HTTP/1.1 404 Not Found');    
            echo $titleBegin . sitename . $dash . $siteTitlesFR["notfound"] . $titleEnd;
            include(__DIR__ . 'statusPages/fr/404.html');
            break;
          case "DE":
            header('HTTP/1.1 404 Not Found');
            echo $titleBegin . sitename . $dash . $siteTitlesDE["notfound"] . $titleEnd;
            include(__DIR__ . 'statusPages/de/404.html');
            break;
          case "RU":
            header('HTTP/1.1 404 Not Found');
            echo $titleBegin . sitename . $dash . $siteTitlesRU["notfound"] . $titleEnd;
            include(__DIR__ . 'statusPages/ru/404.html');
            break;
          default:
            if($debugMode == true) {
              echo "<br>";
              echo "User doesn't have any defined language. Using english.";
              echo "<br>";
            }
            header('HTTP/1.1 404 Not Found');
            echo $titleBegin . sitename . $dash . $siteTitles["notfound"] . $titleEnd;
            include(__DIR__ . 'statusPages/404.html');
            break;
       }
       break;
    case "500":
        switch(lang) {
          case "PT":
            header('HTTP/1.1 500 Internal Server Error');
            echo $titleBegin . sitename . $dash . $siteTitlesPT["servererror"] . $titleEnd;
            include(__DIR__ . 'statusPages/pt-PT/500.html');
            break;
          case "US":
            header('HTTP/1.1 500 Internal Server Error');
            echo $titleBegin . sitename . $dash . $siteTitles["servererror"] . $titleEnd;
            include(__DIR__ . 'statusPages/500.html');
            break;
          case "GB":
            header('HTTP/1.1 500 Internal Server Error');
            echo $titleBegin . sitename . $dash . $siteTitles["servererror"] . $titleEnd;
            include(__DIR__ . 'statusPages/500.html');
            break;
          case "CN":
            header('HTTP/1.1 500 Internal Server Error');
            echo $titleBegin . sitename . $dash . $siteTitlesCN["servererror"] . $titleEnd;
            include(__DIR__ . 'statusPages/cn/500.html');
            break;
          case "FR":
            header('HTTP/1.1 500 Internal Server Error');
            echo $titleBegin . sitename . $dash . $siteTitlesFR["servererror"] . $titleEnd;
            include(__DIR__ . 'statusPages/fr/500.html');
            break;
          case "DE":
            header('HTTP/1.1 500 Internal Server Error');
            echo $titleBegin . sitename . $dash . $siteTitlesDE["servererror"] . $titleEnd;
            include(__DIR__ . 'statusPages/de/500.html');
            break;
          case "RU":
            header('HTTP/1.1 500 Internal Server Error');
            echo $titleBegin . sitename . $dash . $siteTitlesRU["servererror"] . $titleEnd;
            include(__DIR__ . 'statusPages/ru/500.html');
            break;
          default:
            if($debugMode == true) {
              echo "<br>";
              echo defaultmessage;
              echo "<br>";
            }
            header('HTTP/1.1 500 Internal Server Error');
            echo $titleBegin . sitename . $dash . $siteTitles["servererror"] . $titleEnd;
            include('statusPages/500.html');
            break;
        }
        break;
    case "301":
        switch(lang) {
          case "PT":
            header('HTTP/1.1 301 Moved Permanently');
            echo $titleBegin . sitename . $dash . $siteTitlesPT["movedpermanently"] . $titleEnd;
            include(__DIR__ . 'statusPages/pt-PT/301.html');
            break;
          case "US":
            header('HTTP/1.1 301 Moved Permanently');
            echo $titleBegin . sitename . $dash . $siteTitles["movedpermanently"] . $titleEnd;
            include(__DIR__ . 'statusPages/301.html');
            break;
          case "GB":
            header('HTTP/1.1 301 Moved Permanently');
            echo $titleBegin . sitename . $dash . $siteTitles["movedpermanently"] . $titleEnd;
            include(__DIR__ . 'statusPages/301.html');
            break;
          case "CN":
            header('HTTP/1.1 301 Moved Permanently');
            echo $titleBegin . sitename . $dash . $siteTitlesCN["movedpermanently"] . $titleEnd;
            include(__DIR__ . 'statusPages/cn/301.html');
            break;
          case "FR":
            header('HTTP/1.1 301 Moved Permanently');
            echo $titleBegin . sitename . $dash . $siteTitlesFR["movedpermanently"] . $titleEnd;
            include(__DIR__ . 'statusPages/fr/301.html');
            break;
          case "DE":
            header('HTTP/1.1 301 Moved Permanently');
            echo $titleBegin . sitename . $dash . $siteTitlesDE["movedpermanently"] . $titleEnd;
            include(__DIR__ . 'statusPages/de/301.html');
            break;
          case "RU":
            header('HTTP/1.1 301 Moved Permanently');
            echo $titleBegin . sitename . $dash . $siteTitlesRU["movedpermanently"] . $titleEnd;
            include(__DIR__ . 'statusPages/ru/301.html');
            break;
          default:
            if($debugMode == true) {
              echo "<br>";
              echo defaultmessage;
              echo "<br>";
            }
            header('HTTP/1.1 301 Moved Permanently');
            echo $titleBegin . sitename . $dash . $siteTitles["movedpermanently"] . $titleEnd;
            include('statusPages/301.html');
            break;
        }
        break;
    case "204":
        switch(lang) {
          case "PT":
            header('HTTP/1.1 204 No Content');
            echo $titleBegin . sitename . $dash . $siteTitlesPT["nocontent"] . $titleEnd;
            include(__DIR__ . 'statusPages/pt-PT/204.html');
            break;
          case "US":
            header('HTTP/1.1 204 No Content');
            echo $titleBegin . sitename . $dash . $siteTitles["nocontent"] . $titleEnd;
            include(__DIR__ . 'statusPages/204.html');
            break;
          case "GB":
            header('HTTP/1.1 204 No Content');
            echo $titleBegin . sitename . $dash . $siteTitles["nocontent"] . $titleEnd;
            include(__DIR__ . 'statusPages/204.html');
            break;
          case "CN":
            header('HTTP/1.1 204 No Content');
            echo $titleBegin . sitename . $dash . $siteTitlesCN["nocontent"] . $titleEnd;
            include(__DIR__ . 'statusPages/cn/204.html');
            break;
          case "FR":
            header('HTTP/1.1 204 No Content');
            echo $titleBegin . sitename . $dash . $siteTitlesFR["nocontent"] . $titleEnd;
            include(__DIR__ . 'statusPages/fr/204.html');
            break;
          case "DE":
            header('HTTP/1.1 204 No Content');
            echo $titleBegin . sitename . $dash . $siteTitlesDE["nocontent"] . $titleEnd;
            include(__DIR__ . 'statusPages/de/204.html');
            break;
          case "RU":
            header('HTTP/1.1 204 No Content');
            echo $titleBegin . sitename . $dash . $siteTitlesrRU["nocontent"] . $titleEnd;
            include(__DIR__ .'statusPages/ru/204.html');
            break;
          default:
            if($debugMode == true) {
              echo "<br>";
              echo defaultmessage;
              echo "<br>";
            }
            header('HTTP/1.1 204 No Content');
            echo $titleBegin . sitename . $dash . $siteTitles["nocontent"] . $titleEnd;
            include(__DIR__ .'statusPages/204.html');
            break;
        }
        break;
    case "302":
        switch(lang) {
          case "PT":
            header('HTTP/1.1 302 Found');
            echo $titleBegin . sitename . $dash . $siteTitlesPT["found"] . $titleEnd;
            include(__DIR__ . 'statusPages/pt-PT/302.html');
            break;
          case "US":
            header('HTTP/1.1 302 Found');
            echo $titleBegin . sitename . $dash . $siteTitles["found"] . $titleEnd;
            include(__DIR__ . 'statusPages/302.html');
            break;
          case "GB":
            header('HTTP/1.1 302 Found');
            echo $titleBegin . sitename . $dash . $siteTitles["found"] . $titleEnd;
            include(__DIR__ . 'statusPages/302.html');
            break;
          case "CN":
            header('HTTP/1.1 302 Found');
            echo $titleBegin . sitename . $dash . $siteTitlesCN["found"] . $titleEnd;
            include(__DIR__ . 'statusPages/cn/302.html');
            break;
          case "FR":
            header('HTTP/1.1 302 Found');
            echo $titleBegin . sitename . $dash . $siteTitlesFR["found"] . $titleEnd;
            include(__DIR__ . 'statusPages/fr/302.html');
            break;
          case "DE":
            header('HTTP/1.1 302 Found');
            echo $titleBegin . sitename . $dash . $siteTitlesDE["found"] . $titleEnd;
            include(__DIR__ . 'statusPages/de/302.html');
            break;
          case "RU":
            header('HTTP/1.1 302 Found');
            echo $titleBegin . sitename . $dash . $siteTitlesRU["found"] . $titleEnd;
            include(__DIR__ . 'statusPages/ru/302.html');
            break;
          default:
            if($debugMode == true) {
              echo "<br>";
              echo defaultmessage;
              echo "<br>";
            }
            header('HTTP/1.1 302 Found');
            echo $titleBegin . sitename . $dash . $siteTitles["found"] . $titleEnd;
            include('statusPages/302.html');
            break;
            
        }
        break;
    case "307":
        switch(lang) {
          case "PT":
            header('HTTP/1.1 307 Temporary Redirect');
            echo $titleBegin . sitename . $dash . $siteTitlesPT["tempredir"] . $titleEnd;
            include(__DIR__ . 'statusPages/pt-PT/307.html');
            break;
          case "US":
            header('HTTP/1.1 307 Temporary Redirect');
            echo $titleBegin . sitename . $dash . $siteTitles["tempredir"] . $titleEnd;
            include(__DIR__ . 'statusPages/307.html');
            break;
          case "GB":
            header('HTTP/1.1 307 Temporary Redirect');
            echo $titleBegin . sitename . $dash . $siteTitles["tempredir"] . $titleEnd;
            include(__DIR__ . 'statusPages/307.html');
            break;
          case "CN":
            header('HTTP/1.1 307 Temporary Redirect');
            echo $titleBegin . sitename . $dash . $siteTitlesCN["tempredir"] . $titleEnd;
            include(__DIR__ . 'statusPages/cn/307.html');
            break;
          case "FR":
            header('HTTP/1.1 307 Temporary Redirect');
            echo $titleBegin . sitename . $dash . $siteTitlesFR["tempredir"] . $titleEnd;
            include(__DIR__ . 'statusPages/fr/307.html');
            break;
          case "DE":
            header('HTTP/1.1 307 Temporary Redirect');
            echo $titleBegin . sitename . $dash . $siteTitlesDE["tempredir"] . $titleEnd;
            include(__DIR__ . 'statusPages/de/307.html');
            break;
          case "RU":
            header('HTTP/1.1 307 Temporary Redirect');
            echo $titleBegin . sitename . $dash . $siteTitlesRU["tempredir"] . $titleEnd;
            include(__DIR__ . 'statusPages/ru/307.html');
            break;
          default:
            if($debugMode == true) {
              echo "<br>";
              echo defaultmessage;
              echo "<br>";
            }
            header('HTTP/1.1 307 Temporary Redirect');
            echo $titleBegin . sitename . $dash . $siteTitles["tempredir"] . $titleEnd;
            include(__DIR__ . 'statusPages/307.html');
            break;
        }
        break;
    case "308":
        header('HTTP/1.1 308 Permanent Redirect');
        echo "<title>" . sitename . " - " . $siteTitles["permredir"] . "</title>";
        include(__DIR__ . '/statusPages/308.html');
        break;
    case "400":
        header('HTTP/1.1 400 Bad Request');
        echo "<title>" . sitename . " - " . $siteTitles["badreq"] . "</title>";
        include(__DIR__ . '/statusPages/400.html');
        break;
    case "401":
        header('HTTP/1.1 401 Unauthorized');
        echo "<title>" . sitename . " - " . $siteTitles["unauthorized"] . "</title>";
        include(__DIR__ . '/statusPages/401.html');
        break;
    case "403":
        header('HTTP/1.1 403 Forbidden');
        echo "<title>" . sitename . " - " . $siteTitles["forbidden"] . "</title>";
        include(__DIR__ . '/statusPages/403.html');
        break;
    case "410":
        header('HTTP/1.1 410 Gone');
        echo "<title>" . sitename . " - " . $siteTitles["gone"] . "</title>";
        include(__DIR__ . '/statusPages/410.html');
        break;
    case "418":
        header('HTTP/1.1 418 I\'m a Teapot');
        echo "<title>" . sitename . " - " . $siteTitles["troll"] . "</title>";
        include(__DIR__ . '/statusPages/418.html');
        break;
    case "429":
        header('HTTP/1.1 429 Too Many Requests');
        echo "<title>" . sitename . " - " . $siteTitles["toomanyreqs"] . "</title>";
        include(__DIR__ . '/statusPages/429.html');
        break;
    case "451":
        header('HTTP/1.1 451 Unavailable for Legal Reasons');
        echo "<title>" . sitename . " - " . $siteTitles["legal"] . "</title>";
        include(__DIR__ . '/statusPages/451.html');
        break;
    case "503":
        header('HTTP/1.1 503 Service Temporarily Unavailable');
        echo "<title>" . sitename . " - " . "503 Service Temporarily Unavailable" . "</title>";
        include(__DIR__ . '/statusPages/503.html');
        break;
    case "450":
        echo "<title>" . sitename . " - " . $siteTitles["windows-unofficial"] . "</title>";
        include(__DIR__ . '/statusPages/450.html');
        break;
    default:
        header('HTTP/1.1 404 Not Found');
        echo "<title>" . sitename . " - " . $siteTitles["notfound"] . "</title>";
        include(__DIR__ . '/statusPages/404.html');
        if($debugMode == true) {
            echo "<br>";
            echo "Error: Unsupported behavior mode. Please change it to something valid, otherwise the errorcode will stay as default (404).";
        }
        break;
}
