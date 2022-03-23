<?PHP


$username = 'yoonhd@mz.co.kr';
$password = 'K80gueIJUonHEGUJHQ4y44E6';
$password = 'aqzsIiu6OOqPsJdb6XWM031D';


$url = "https://mz-dev.atlassian.net/rest/api/2/issue/";


$json_data = '{
	
    "fields": {
        "project": {
            "self": "https://mz-dev.atlassian.net/rest/api/2/project/11600",
			"id": "11600",
			"key": "MZNO",
			"name": "DSG-SM/그로스팀 업무관리",
			"projectTypeKey": "software",
			"simplified": false,
			"avatarUrls": {
				"48x48": "https://mz-dev.atlassian.net/rest/api/2/universal_avatar/view/type/project/avatar/10409",
				"24x24": "https://mz-dev.atlassian.net/rest/api/2/universal_avatar/view/type/project/avatar/10409?size=small",
				"16x16": "https://mz-dev.atlassian.net/rest/api/2/universal_avatar/view/type/project/avatar/10409?size=xsmall",
				"32x32": "https://mz-dev.atlassian.net/rest/api/2/universal_avatar/view/type/project/avatar/10409?size=medium"
			} 
        }
        ,"issuetype": { 
            "name": "작업",
            "id": "3" 
        }
        ,"summary": "이슈 제목"     
        ,"description": "이슈 상세내용"
        ,"labels": [ 
            "일반유지보수"
        ]
        
        ,"assignee": {
			"self": "https://mz-dev.atlassian.net/rest/api/2/user?accountId=5f9631478405b10077318f2c",
			"accountId": "5f9631478405b10077318f2c",
			"emailAddress": "yoonhd@mz.co.kr",
			"avatarUrls": {
			  "48x48": "https://secure.gravatar.com/avatar/c4be0d10744ba0dbd0eed19227da335c?d=https%3A%2F%2Favatar-management--avatars.us-west-2.prod.public.atl-paas.net%2Fdefault-avatar-1.png",
			  "24x24": "https://secure.gravatar.com/avatar/c4be0d10744ba0dbd0eed19227da335c?d=https%3A%2F%2Favatar-management--avatars.us-west-2.prod.public.atl-paas.net%2Fdefault-avatar-1.png",
			  "16x16": "https://secure.gravatar.com/avatar/c4be0d10744ba0dbd0eed19227da335c?d=https%3A%2F%2Favatar-management--avatars.us-west-2.prod.public.atl-paas.net%2Fdefault-avatar-1.png",
			  "32x32": "https://secure.gravatar.com/avatar/c4be0d10744ba0dbd0eed19227da335c?d=https%3A%2F%2Favatar-management--avatars.us-west-2.prod.public.atl-paas.net%2Fdefault-avatar-1.png"
			},
			"displayName": "윤희동",
			"active": true,
			"timeZone": "Asia/Seoul",
			"accountType": "atlassian"
		  },
		  "components": [
			{
			  "self": "https://mz-dev.atlassian.net/rest/api/2/component/19338",
			  "id": "19338",
			  "name": "폭스바겐",
			  "description": "폭스바겐 운영업무"
			}
		  ],"fixVersions": [
			{
			  "self": "https://mz-dev.atlassian.net/rest/api/2/version/12601",
			  "id": "12601",
			  "description": "2014년 5월 업무",
			  "name": "2014년 5월 업무",
			  "archived": false,
			  "released": false,
			  "releaseDate": "2014-05-31"
			}
		],
		  "reporter": {
			"self": "https://mz-dev.atlassian.net/rest/api/2/user?accountId=5f9631478405b10077318f2c",
			"accountId": "5f9631478405b10077318f2c",
			"emailAddress": "yoonhd@mz.co.kr",
			"avatarUrls": {
			  "48x48": "https://secure.gravatar.com/avatar/c4be0d10744ba0dbd0eed19227da335c?d=https%3A%2F%2Favatar-management--avatars.us-west-2.prod.public.atl-paas.net%2Fdefault-avatar-1.png",
			  "24x24": "https://secure.gravatar.com/avatar/c4be0d10744ba0dbd0eed19227da335c?d=https%3A%2F%2Favatar-management--avatars.us-west-2.prod.public.atl-paas.net%2Fdefault-avatar-1.png",
			  "16x16": "https://secure.gravatar.com/avatar/c4be0d10744ba0dbd0eed19227da335c?d=https%3A%2F%2Favatar-management--avatars.us-west-2.prod.public.atl-paas.net%2Fdefault-avatar-1.png",
			  "32x32": "https://secure.gravatar.com/avatar/c4be0d10744ba0dbd0eed19227da335c?d=https%3A%2F%2Favatar-management--avatars.us-west-2.prod.public.atl-paas.net%2Fdefault-avatar-1.png"
			},
			"displayName": "윤희동",
			"active": true,
			"timeZone": "Asia/Seoul",
			"accountType": "atlassian"
		  }
    }
}';

$body = $json_data ;


//$body = json_encode($json_data);



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

$temp = explode('","key":"',$result);
$temp = explode('","self":"',$temp[1]);
echo $temp[0];

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