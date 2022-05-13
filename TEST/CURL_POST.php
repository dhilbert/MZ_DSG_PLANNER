<?PHP


$username = 'yoonhd@mz.co.kr';
$password = 'K80gueIJUonHEGUJHQ4y44E6';
$password = 'aqzsIiu6OOqPsJdb6XWM031D';

// https://mz-dev.atlassian.net/browse/MZNO-49907
$url = "https://mz-dev.atlassian.net/rest/api/2/issue/262342/editmeta";


$json_data = '
"fields": {"summary": "new summary"}   
   ';

$body = $json_data ;


$body = json_encode($json_data);



$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$result = curl_exec ($ch);
$object = json_decode($result,true);
echo $result

/*
$temp = explode('","key":"',$result);
$temp = explode('","self":"',$temp[1]);
echo $temp[0];
*/
?>

<!--

 = Array (
    "fields" => Array (
        "labels" =>  "일반유지보수",
        "assignee" => Array (
					"accountId"  => "5f9631478405b10077318f2c",
					"emailAddress"=> "yoonhd@mz.co.kr",
					"displayName"=> "윤희동"
		),
		"components"=> Array (
			  "self" => "https://mz-dev.atlassian.net/rest/api/2/component/19338",
			  "id" => "19338",
			  "name"=> "폭스바겐",
			  "description"=>"폭스바겐 운영업무"
		),
		"reporter" => Array (
			"accountId"  => "5f9631478405b10077318f2c",
			"emailAddress"=> "yoonhd@mz.co.kr",
			"displayName"=> "윤희동"
		),
		"summary"=> "test 입니다.",
		"description"=> "테스트 입니다. "
	
		)
		)		;

{
    "fields": {
        "project": {
             "key": "프로젝트명"  
        }
        ,"issuetype": { 
            "name": "작업",
            "id": "3" 
        }
        ,"summary": "이슈 제목"     
        ,"description": "이슈 상세내용"
        ,"labels": [ 
            "태그"
        ]
        ,"duedate": "2030-12-31"  
        ,"reporter": {
            "name": "윤희동" 
        }
        ,"assignee": { 
            "name": "윤희동" 
        }
        ,"customfield_10004" : "산출물 첨부경로" 
        ,"customfield_10705" : "EpicLink명"
    },
   "update":{
      "issuelinks":[
         {
            "add":{
               "type":{
                  "name":"Blocks",
                  "inward":"is blocked by",
                  "outward":"blocks"
               },
               "outwardIssue":{
                  "key":"연결된 이슈명"
               }
            }
         }
      ]
   }
}
-->