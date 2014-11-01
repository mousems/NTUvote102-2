<?php


// excel to json object

$a="C2-0	na	C2	0	na	na
C2-1	研究生代表	C2	1	大氣碩一	陳梁政
C2-2	研究生代表	C2	2	海洋碩一	蘇琬婷
C2-3	研究生代表	C2	3	電信碩一	黃柏宇
C2-4	研究生代表	C2	4	植微碩一	盧潔
C2-5	研究生代表	C2	5	經濟碩一	鄭明哲
C2-6	研究生代表	C2	6	園藝碩一	劉育勳
C2-7	研究生代表	C2	7	電子碩一	王則惟
C2-8	研究生代表	C2	8	國企碩一	闕愉娟
C2-9	研究生代表	C2	9	土木所	施正倫
C2-10	研究生代表	C2	10	科法碩一	陳文葳
C2-11	研究生代表	C2	11	國發碩二	鄧維農
C2-12	研究生代表	C2	12	電子碩一	劉佳琛
C2-13	研究生代表	C2	13	國發碩二	曾友嶸
C2-14	研究生代表	C2	14	獸醫碩二	范正一
C2-15	研究生代表	C2	15	機械碩一	張哲維
C2-16	研究生代表	C2	16	人類碩二	王鈞瑜
D1-1	社科院學生會長	D1	1	政治二	蔡承翰
D4-1	管院學生會長	D4	1	會計二	書其暐
F1-1	文學院學生會長	F1	1	歷史四	翁榛憶";

$a = explode("\n", $a);
$b = new stdClass;
foreach ($a as $key => $value) {
	$value = explode("	", $value);
	$tmp = new stdClass;
	$tmp->{"rname"} = $value[1];
	$tmp->{"rid"} = $value[2];
	$tmp->{"no"} = $value[3];
	$tmp->{"dept"} = $value[4];
	$tmp->{"name"} = $value[5];
// 
	$b->$value[0] = $tmp;
}
//print_r($b);
 // echo json_encode($b);
//{"A-1":{"rname":"\u5b78\u751f\u6703\u6703\u9577","rid":"A","no":"1","dept":"\u570b\u767c\u78a9\u4e00","name":"\u6c6a\u8208\u5bf0"},"A-2":{"rname":"\u5b78\u751f\u6703\u6703\u9577","rid":"A","no":"2","dept":"\u4e2d\u6587\u4e8c","name":"\u738b\u65e5\u6684"},"A-3":{"rname":"\u5b78\u751f\u6703\u6703\u9577","rid":"A","no":"3","dept":"\u54f2\u5b78\u4e09","name":"\u90ed\u6de8\u6e90"},"B1-1":{"rname":"\u6587\u5b78\u9662\u5b78\u4ee3","rid":"B1","no":"1","dept":"\u6b77\u53f2\u4e8c","name":"\u6d82\u6b23\u51f1"},"B1-2":{"rname":"\u6587\u5b78\u9662\u5b78\u4ee3","rid":"B1","no":"2","dept":"\u5716\u8cc7\u4e00","name":"\u59da\u67cf\u5b87"},"B1-3":{"rname":"\u6587\u5b78\u9662\u5b78\u4ee3","rid":"B1","no":"3","dept":"\u54f2\u5b78\u4e8c","name":"\u90b1\u5b50\u8ed2"},"B1-4":{"rname":"\u6587\u5b78\u9662\u5b78\u4ee3","rid":"B1","no":"4","dept":"\u4eba\u985e\u4e00","name":"\u8521\u4f73\u6607"},"B2-1":{"rname":"\u7406\u5b78\u9662\u5b78\u4ee3","rid":"B2","no":"1","dept":"\u5fc3\u7406\u4e09","name":"\u6d2a\u5b50\u921e"},"B2-2":{"rname":"\u7406\u5b78\u9662\u5b78\u4ee3","rid":"B2","no":"2","dept":"\u7269\u7406\u4e09","name":"\u6797\u5b50\u7fd4"},"B3-1":{"rname":"\u793e\u79d1\u9662\u5b78\u4ee3","rid":"B3","no":"1","dept":"\u653f\u6cbb\u78a9\u4e00","name":"\u8a31\u5bb6\u777f"},"B3-2":{"rname":"\u793e\u79d1\u9662\u5b78\u4ee3","rid":"B3","no":"2","dept":"\u7d93\u6fdf\u4e09","name":"\u5f6d\u6cbb\u9f4a"},"B3-3":{"rname":"\u793e\u79d1\u9662\u5b78\u4ee3","rid":"B3","no":"3","dept":"\u570b\u767c\u78a9\u4e09","name":"\u97d3\u4fca\u8ce2"},"B3-4":{"rname":"\u793e\u79d1\u9662\u5b78\u4ee3","rid":"B3","no":"4","dept":"\u7d93\u6fdf\u4e09","name":"\u9673\u79b9\u7af9"},"B3-5":{"rname":"\u793e\u79d1\u9662\u5b78\u4ee3","rid":"B3","no":"5","dept":"\u570b\u767c\u78a9\u4e8c","name":"\u5f90\u4f51\u6607"},"B4-1":{"rname":"\u91ab\u5b78\u9662\u5b78\u4ee3","rid":"B4","no":"1","dept":"\u91ab\u5b78\u4e8c","name":"\u8521\u70ab\u9321"},"B4-2":{"rname":"\u91ab\u5b78\u9662\u5b78\u4ee3","rid":"B4","no":"2","dept":"\u91ab\u5b78\u4e09","name":"\u6797\u6602\u9821"},"B4-3":{"rname":"\u91ab\u5b78\u9662\u5b78\u4ee3","rid":"B4","no":"3","dept":"\u8b77\u7406\u4e8c","name":"\u5433\u4f73\u73b2"},"B4-4":{"rname":"\u91ab\u5b78\u9662\u5b78\u4ee3","rid":"B4","no":"4","dept":"\u7269\u6cbb\u4e8c","name":"\u6797\u70b3\u9a30"},"B4-5":{"rname":"\u91ab\u5b78\u9662\u5b78\u4ee3","rid":"B4","no":"5","dept":"\u91ab\u5b78\u4e00","name":"\u738b\u7d2b\u8b93"},"B4-6":{"rname":"\u91ab\u5b78\u9662\u5b78\u4ee3","rid":"B4","no":"6","dept":"\u91ab\u5b78\u4e8c","name":"\u9ec3\u5e8f\u7acb"},"B5-1":{"rname":"\u5de5\u5b78\u9662\u5b78\u4ee3","rid":"B5","no":"1","dept":"\u6a5f\u68b0\u4e09","name":"\u9ad8\u7ae0\u741b"},"B5-2":{"rname":"\u5de5\u5b78\u9662\u5b78\u4ee3","rid":"B5","no":"2","dept":"\u57ce\u9109\u78a9\u4e00","name":"\u8cf4\u6afb\u82b3"},"B5-3":{"rname":"\u5de5\u5b78\u9662\u5b78\u4ee3","rid":"B5","no":"3","dept":"\u5316\u5de5\u4e09","name":"\u937e\u653f\u9716"},"B5-4":{"rname":"\u5de5\u5b78\u9662\u5b78\u4ee3","rid":"B5","no":"4","dept":"\u571f\u6728\u78a9\u4e00","name":"\u65bd\u6b63\u502b"},"B6-1":{"rname":"\u751f\u8fb2\u9662\u5b78\u4ee3","rid":"B6","no":"1","dept":"\u751f\u5de5\u56db","name":"\u4faf\u745e\u745c"},"B6-2":{"rname":"\u751f\u8fb2\u9662\u5b78\u4ee3","rid":"B6","no":"2","dept":"\u8fb2\u7d93\u4e8c","name":"\u912d\u4f51\u5ba3"},"B6-3":{"rname":"\u751f\u8fb2\u9662\u5b78\u4ee3","rid":"B6","no":"3","dept":"\u68ee\u6797\u4e8c","name":"\u6234\u52ad\u82b8"},"B6-4":{"rname":"\u751f\u8fb2\u9662\u5b78\u4ee3","rid":"B6","no":"4","dept":"\u6606\u87f2\u4e8c","name":"\u5f35\u5bb6\u8c6a"},"B6-5":{"rname":"\u751f\u8fb2\u9662\u5b78\u4ee3","rid":"B6","no":"5","dept":"\u751f\u50b3\u4e8c","name":"\u6797\u627f\u8ce2"},"B7-1":{"rname":"\u7ba1\u9662\u5b78\u4ee3","rid":"B7","no":"1","dept":"\u5de5\u7ba1\u4e8c","name":"\u738b\u8000\u589e"},"B7-2":{"rname":"\u7ba1\u9662\u5b78\u4ee3","rid":"B7","no":"2","dept":"\u5de5\u7ba1\u4e09","name":"\u984f\u5d07\u76ca"},"B7-3":{"rname":"\u7ba1\u9662\u5b78\u4ee3","rid":"B7","no":"3","dept":"\u6703\u8a08\u4e8c","name":"\u8607\u9756\u5bcc"},"B7-4":{"rname":"\u7ba1\u9662\u5b78\u4ee3","rid":"B7","no":"4","dept":"\u5de5\u7ba1\u4e09","name":"\u6797\u6615\u92d2"},"B7-5":{"rname":"\u7ba1\u9662\u5b78\u4ee3","rid":"B7","no":"5","dept":"\u6703\u8a08\u4e8c","name":"\u9673\u6620\u5112"},"B8-1":{"rname":"\u516c\u885b\u9662\u5b78\u4ee3","rid":"B8","no":"1","dept":"\u516c\u885b\u4e8c","name":"\u9673\u5ba3\u7af9"},"B8-2":{"rname":"\u516c\u885b\u9662\u5b78\u4ee3","rid":"B8","no":"2","dept":"\u516c\u885b\u4e00","name":"\u66fe\u9756\u8ed2"},"B9-1":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"1","dept":"\u96fb\u6a5f\u4e09","name":"\u5433\u8ed2\u5b87"},"B9-2":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"2","dept":"\u96fb\u6a5f\u4e8c","name":"\u9f94\u664f\u5fb5"},"B9-3":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"3","dept":"\u96fb\u6a5f\u4e09","name":"\u6731\u5e0c\u5e73"},"B9-4":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"4","dept":"\u96fb\u6a5f\u4e09","name":"\u694a\u7267\u8861"},"B9-5":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"5","dept":"\u96fb\u6a5f\u4e09","name":"\u65bd\u4fdd\u5168"},"B9-6":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"6","dept":"\u8cc7\u5de5\u4e09","name":"\u99ae\u786f"},"B9-7":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"7","dept":"\u96fb\u6a5f\u4e8c","name":"\u8f9b\u723e\u5eb7"},"B10-1":{"rname":"\u6cd5\u5b78\u9662\u5b78\u4ee3","rid":"B10","no":"1","dept":"\u6cd5\u5f8b\u4e09","name":"\u90b1\u4e1e\u6b63"},"B10-2":{"rname":"\u6cd5\u5b78\u9662\u5b78\u4ee3","rid":"B10","no":"2","dept":"\u6cd5\u5f8b\u4e09","name":"\u8b1d\u5b5f\u7487"},"B10-3":{"rname":"\u6cd5\u5b78\u9662\u5b78\u4ee3","rid":"B10","no":"3","dept":"\u6cd5\u5f8b\u4e8c","name":"\u5468\u6613"},"C1-1":{"rname":"\u7814\u5354\u6703\u6703\u9577","rid":"C1","no":"1","dept":"\u570b\u767c\u78a9\u4e00","name":"\u9673\u4e59\u68cb"},"C1-2":{"rname":"\u7814\u5354\u6703\u6703\u9577","rid":"C1","no":"2","dept":"\u570b\u767c\u78a9\u4e8c","name":"\u5468\u82b7\u8431"},"C2-1":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"1","dept":"\u5927\u6c23\u78a9\u4e00","name":"\u9673\u6881\u653f"},"C2-2":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"2","dept":"\u6d77\u6d0b\u78a9\u4e00","name":"\u8607\u742c\u5a77"},"C2-3":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"3","dept":"\u96fb\u4fe1\u78a9\u4e00","name":"\u9ec3\u67cf\u5b87"},"C2-4":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"4","dept":"\u690d\u5fae\u78a9\u4e00","name":"\u76e7\u6f54"},"C2-5":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"5","dept":"\u7d93\u6fdf\u78a9\u4e00","name":"\u912d\u660e\u54f2"},"C2-6":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"6","dept":"\u5712\u85dd\u78a9\u4e00","name":"\u5289\u80b2\u52f3"},"C2-7":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"7","dept":"\u96fb\u5b50\u78a9\u4e00","name":"\u738b\u5247\u60df"},"C2-8":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"8","dept":"\u570b\u4f01\u78a9\u4e00","name":"\u95d5\u6109\u5a1f"},"C2-9":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"9","dept":"\u571f\u6728\u6240","name":"\u65bd\u6b63\u502b"},"C2-10":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"10","dept":"\u79d1\u6cd5\u78a9\u4e00","name":"\u9673\u6587\u8473"},"C2-11":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"11","dept":"\u570b\u767c\u78a9\u4e8c","name":"\u9127\u7dad\u8fb2"},"C2-12":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"12","dept":"\u96fb\u5b50\u78a9\u4e00","name":"\u5289\u4f73\u741b"},"C2-13":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"13","dept":"\u570b\u767c\u78a9\u4e8c","name":"\u66fe\u53cb\u5db8"},"C2-14":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"14","dept":"\u7378\u91ab\u78a9\u4e8c","name":"\u8303\u6b63\u4e00"},"C2-15":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"15","dept":"\u6a5f\u68b0\u78a9\u4e00","name":"\u5f35\u54f2\u7dad"},"C2-16":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"16","dept":"\u4eba\u985e\u78a9\u4e8c","name":"\u738b\u921e\u745c"},"D1-1":{"rname":"\u793e\u79d1\u9662\u5b78\u751f\u6703\u9577","rid":"D1","no":"1","dept":"\u653f\u6cbb\u4e8c","name":"\u8521\u627f\u7ff0"},"D2-1":{"rname":"\u5de5\u5b78\u9662\u5b78\u751f\u6703\u9577","rid":"D2","no":"1","dept":"\u5de5\u79d1\u4e8c","name":"\u9b4f\u4e1e\u9d3b"},"D3-1":{"rname":"\u751f\u8fb2\u5b78\u9662\u5b78\u751f\u6703\u6703\u9577","rid":"D3","no":"1","dept":"\u8fb2\u7d93\u4e8c","name":"\u5433\u6c76\u931a"},"D3-2":{"rname":"\u751f\u8fb2\u5b78\u9662\u5b78\u751f\u6703\u6703\u9577","rid":"D3","no":"2","dept":"\u8fb2\u85dd\u4e8c","name":"\u5433\u5764\u80b2"},"D4-1":{"rname":"\u7ba1\u9662\u5b78\u751f\u6703\u9577","rid":"D4","no":"1","dept":"\u6703\u8a08\u4e8c","name":"\u66f8\u5176\u6690"},"D5-1":{"rname":"\u6cd5\u5b78\u9662\u5b78\u751f\u6703\u9577","rid":"D5","no":"1","dept":"\u6cd5\u5f8b\u4e8c","name":"\u674e\u5fc3\u6bc5"},"D5-2":{"rname":"\u6cd5\u5b78\u9662\u5b78\u751f\u6703\u9577","rid":"D5","no":"2","dept":"\u6cd5\u5f8b\u4e00","name":"\u6797\u5b9b\u6f7c"}}



$a="學生會會長	President of Student Association	A1
文學院學生代表	Student Representative of College of Liberal Arts	B1
理學院學生代表	Student Representative of College of Science	B2
社會科學院學生代表	Student Representative of College of Social Sciences	B3
醫學院學生代表	Student Representative of College of Medicine	B4
工學院學生代表	Student Representative of College of Engineering	B5
生物資源暨農學院學生代表	Student Representative of College of Bio-Resources & Agriculture	B6
管理學院學生代表	Student Representative of College of Management	B7
公共衛生學院學生代表	Student Representative of College of Public Health	B8
電機資訊學院學生代表	Student Representative of College of EE & CS	B9
法律學院學生代表	Student Representative of College of Law	B10
研究生協會會長	President of Graduate Student Association	C1
研究生學生代表	Student Representative of Graduate Student Association	C2
社會科學院學生會長	President of College of Social Sciences Student Association	D1
工學院學生會長	President of Engineering Student Association	D2
生物資源暨農學院學生會會長	President of College of Bio-Resources & Agriculture Student Association	D3
管理學院學生會長	President of College of Management Student Association	D4
法律學院學生會長	President of College of Law Student Association	D5
文學院學生會長	President of Student Association	F1";

$a = explode("\n", $a);
$b = new stdClass;
foreach ($a as $key => $value){;
	$value = explode("	", $value);
	$tmp = new stdClass;
	$tmp->{"title"} = $value[0];
	$tmp->{"title_en"} = $value[1];

	$b->$value[2] = $tmp;
}
 //print_r($b);
 echo json_encode($b);
//{"A1":"\u5b78\u751f\u6703\u6703\u9577","B1":"\u6587\u5b78\u9662\u5b78\u4ee3","B2":"\u7406\u5b78\u9662\u5b78\u4ee3","B3":"\u793e\u79d1\u9662\u5b78\u4ee3","B4":"\u91ab\u5b78\u9662\u5b78\u4ee3","B5":"\u5de5\u5b78\u9662\u5b78\u4ee3","B6":"\u751f\u8fb2\u9662\u5b78\u4ee3","B7":"\u7ba1\u9662\u5b78\u4ee3","B8":"\u516c\u885b\u9662\u5b78\u4ee3","B9":"\u96fb\u8cc7\u9662\u5b78\u4ee3","B10":"\u6cd5\u5b78\u9662\u5b78\u4ee3","C1":"\u7814\u5354\u6703\u6703\u9577","C2":"\u7814\u7a76\u751f\u4ee3\u8868","D1":"\u793e\u79d1\u9662\u5b78\u751f\u6703\u9577","D2":"\u5de5\u5b78\u9662\u5b78\u751f\u6703\u9577","D3":"\u751f\u8fb2\u5b78\u9662\u5b78\u751f\u6703\u6703\u9577","D4":"\u7ba1\u9662\u5b78\u751f\u6703\u9577","D5":"\u6cd5\u5b78\u9662\u5b78\u751f\u6703\u9577"}

// $cc = "A1";
// echo $b->{$cc};



?>
