<?php

require_once('../model/Content.php');
require_once('../model/Response.php');

try {
  $content = new Content(1, 1, 'D1', "001||1||1||Shakespeare||셰익스피어||284-1317|||
  002||1||2||William Shakespeare was born in Stratford-upon-Avon, England, on April 23rd, 1564.||윌리엄 셰익스피어는 1564년 4월 23일에 영국 스트랫퍼드어폰에이번에서 태어났습니다.||2658-11168|||
  003||1||1||His father was a successful local businessman and his mother was the daughter of a land owner.||그의 아버지는 성공한 지역 사업가였고 어머니는 토지 소유주의 딸이었습니다. ||12027-18673|||
  004||1||2||In 1582, William, aged only 18, married an older woman named Anne Hathaway.||1582년, 겨우 18세의 윌리엄은 앤 해서웨이라는 나이든 여성과 결혼했습니다.||19922-28467|||
  005||1||1||They had three children.||그들은 세 명의 아이를 낳았습니다.||29024-30743|||
  006||1||2||After that there are no records of the next few years of his life.||그 후 그의 다음 몇 년 동안의 기록은 없습니다.||32298-37244|||
  007||1||1||Historians often refer to these years of Shakespeare's life as the \"lost years.\"||역사학자들은 종종 이러한 셰익스피어 생애의 세월을 \"잃어버린 해\"라고 말합니다.||38034-44391|||
  008||1||2||What is certain is that Shakespeare and his family ended up in London, where he was working at the theater.||확실한 것은 셰익스피어와 그의 가족은 그가 극장에서 일하고 있던 런던에 가게 되었다는 것입니다.||44884-52222|||
  009||1||1||William was part of an acting company called Lord Chamberlain's Men, where he wrote and played as an actor.||윌리엄은 Lord Chamberlain's Men이라고 불리는 극단에 소속되어 있었는데, 그곳에서 그는 글을 쓰고 배우로서 연기했습니다.||53266-101214|||
  010||1||2||His plays became very popular in London, and soon the Lord Chamberlain's Men were amongst the most popular acting companies in the city.||그의 연극은 런던에서 매우 유명해졌고, 곧 Lord Chamberlain's Men은 런던에서 가장 인기 있는 극단 중 하나가 되었습니다.||102345-112887|||
  011||1||1||Some of Shakespeare's early plays include The Taming of the Shrew, Richard III, Romeo and Juliet, and A Midsummer Night's Dream.||셰익스피어의 초기 희곡들 중에는 \"말괄량이 길들이기,\" \"리차드 3세,\" \"로미오와 줄리엣,\" 그리고 \"한여름 밤의 꿈\"이 있습니다.||114152-125140|||
  012||1||2||Most of these plays were performed at the Globe Theatre, which quickly became incredibly popular.||이 연극들의 대부분은 글로브 극장에서 공연되었고, 이 연극들은 곧 믿을 수 없을 정도로 인기를 얻었습니다.||126292-133289|||
  013||1||1||Regardless of the success of these plays, most of Shakespeare's greatest work was written in his late years, when he wrote masterpieces like Hamlet, Othello, King Lear, and Macbeth.||이러한 희곡들의 성공 여부와 상관없이 셰익스피어의 가장 위대한 작품 대부분은 그의 말년에 쓰여졌고, 그 때 햄릿, 오델로, 리어왕, 맥베스와 같은 걸작을 썼습니다. ||134783-148382|||
  014||1||2||Shakespeare retired and settled in Stratford, where he died in 1616.||셰익스피어는 은퇴해서 스트랫퍼드에 정착했고 그곳에서 1616년에 사망했습니다.||149470-155635|||
  015||1||1||William Shakespeare, often called the \"English National Poet,\" is widely considered the greatest dramatist of all time.||종종 \"영국의 시인\"으로 불리는 윌리엄 셰익스피어는 역사상 가장 위대한 극작가로 널리 여겨집니다.||156773-206228");
  header('Content-type: application/json;charset=UTF-8');
  $response = new Response();
  $response->setSuccess(true);
  $response->setHttpStatusCode(200);
  $response->addMessage("Get content");
  $response->setData($content->returnContentAsArray());
  $response->send();
  exit;
} catch (ContentException $ex) {
  echo 'Error: ' . $ex->getMessage();
  exit;
}