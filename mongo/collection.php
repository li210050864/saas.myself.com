<?php
/*
 * php mongo collection function
 * author lmx
 * create time 2015-08-31
*/
//$c  = new MongoClient("mongodb://192.168.224.131:27017");
$c  = new MongoClient("mongodb://119.29.96.177:27017");
$db = $c->selectDB("media");
$collection = $db->selectCollection("media");
$where = array("Type"=>"CD");
$cursor = $collection->find($where);
$count = $cursor->count();
//echo "ALL Count IS:".$count;
//$cursor = $collection->find()->sort(array("_id"=>-1))->skip(1)->limit(1);
/*
if($cursor){
	echo "<pre>";
	while($doc = $cursor->getNext()){
		print_r($doc);
	}	
	echo "</pre>";
}
$cursor_type = $collection->aggregate(array(
	'$group' => array(
		'_id' => '$Address.Country',
		'total' => array('$sum'=>1)
	)
));
echo "<pre>";
print_r($cursor_type);
echo "</pre>";
*/
echo "<pre>";
print_r($db);
// -------------- 搜索/查询 ----------------
//$cursor_name = $collection->find(array("Last Name"=>"Moran"));
//$cursor_name->hint(array("Last Name"=>-1));
//while($document = $cursor_name->getNext()){
//	print_r($document);	
//}
//$where = array('Age'=>array('$lt'=>30));
//$where = array('Age'=>array('$ne'=>28));
//$where = array('Address.Country'=>array('$in'=>array('USA','UK')));
//$where = array('E-Mail'=>array('$all'=>array("vm@example.com","vm@office.com")));
//$where = array('$or'=>array(array('Age'=>28),array("Address.Country"=>"USA")));
//$where = array('Address.Country'=>"USA",'$or'=>array(array('Last Name'=>'Moran'),array('E-Mail'=>"vw@example.com")));
//$query = array('Last Name'=>"Moran");
//$where = (object)array("Email"=>array('$slice'=>array(2,3)));
//$where = array("Age"=>array('$exists'=>true));
//$regex = new MongoRegex("/stradgynl/i");
//$where = array("Address.Place"=>$regex);
//$cursor_order = $collection->find($where);
//if($cursor_order){
//	while($doc = $cursor_order->getNext()){
//			print_r($doc);
//			echo "<br />----------------------------------------------------------------------------<br />";
//		}	
//}
//---------------------- update ----------------
//$where = array("Last Name"=>"Wood");
//$update = array(
//	"First Name"  => "Vicky",
//	"Last Name"   => "Wood",
//	"Address"     => array(
//			"Street"  => "50 Ash lane",
//			"Place"   => "Ystradgynlais",
//			"Postal Code" => "SA9 6XS",
//			"Country" => "UK",
//	),
//	"E-Mail"      => array(
//			"vm@example.com","vm@office.com"
//	),
//	"Phone"       => "078-8727-8049",
//	"Age"         => 28,
//);
//$option = array("upsert"=>true);
//$collection->update($where,$update,$option);
//print_r($collection->findOne($where));

//$where = array("Age"=>array('$lt'=>30));
//$update = array('$inc'=>array("Age"=>3));

//$where = array("Last Name"=>"Wood");
//$update = array('$set'=>array("First Name"=>"VickyWood"));

//$where = array("Email"=>new MongoRegex("/@office.com/i"));
//$update = array('$set'=>array("Category"=>'Work'));

//$where = array("Last Name"=>"Wood");
//$update = array('$unset'=>array('Phone'=>1));

//$where = array("Last Name"=>"Wood");
//$update = array('$rename'=>array("First Name"=>"Given Name","Last Name"=>"Family Name"));

//$where = array("Family Name"=>"Wood");
//$update = array('$setOnInsert'=>array("Country"=>"Unknow"));

//$where = array("Family Name"=>"Wallace");
//$update = array('$setOnInsert'=>array("Address.Country"=>"Unknow"));

//$where = array("Family Name"=>"Wood");
//$update = array('$push'=>array("E-Mail"=>"vm@mongo.db.com"));

//$where = array("Family Name" => "Wood");
//$update = array('$push'=>array(
//					"E-Mail"=>array('$each' => array("vicwo@mongo.db","vicwo@example.com"))
//));

//$where = array("Family Name"=>"Wood");
//$update = array(
//	'$addToSet' => array(
//		"E-Mail" => array(
//			'$each' => array(
//				'vm@mongo.db','vick@mongo.db','vm@mongo.db.com','vicky@example.com'
//			)
//		)
//	)
//);

//$where = array("Family Name" => "Wood");
//$update = array('$pop'=>array('E-Mail'=>1));

//$where = array("Family Name"=>"Wood");
//$update = array('$pull'=>array("E-Mail"=>"vicwo@mongo.db"));

//$where = array("Family Name"=>"Wood");
//$update = array('$pullAll'=>array("E-Mail"=>array("vm@mongo.db.com","vm@mongo.db")));
//$option = array("upsert"=>true);
//$option = array("upsert"=>true,"multi"=>true);
//$collection->update($where,$update,$option);
//$new_where = array("Age"=>array('$gt'=>30));
//$new_where = array("Family Name"=>"Wood");
//$new_where = array("Family Name" => "Wallace");
//$content = array(
//	"Given Name" => "Kenji",
//	"Family Name" => "Kitahara",
//	"Address"     => array(
//		"Street"    => "149 Bartlett Avenue",
//		"Place"     => "Southfield",
//		"Postal Code"=> "MI 48075",
//		"Country"   => "USA"
//	),
//	"E-Mail"      => array(
//		"kk@example.com","kk@office.com"
//	),
//	"Phone"       => "248-510-1562",
//	"Age"         => 34
//);
//$option = array("fsync"=>true);
//$collection->save($content,$option);
//$content["Category"] = "Work";
//$collection->save($content);
//------------------ 原子操作 --------------------------
//$where = array("Family Name"=>"Kitahara");
//$update = array('$push'=>array("E-Mail"=>"Kitahara@mongo.db"));
//$option = array("sort"=>array("Age"=>-1),"remove"=>true);
//$collection->findAndModify($where,null,null,$option);
//----------------- 移除操作 ---------------------------
//$where = array("E-Mail"=>new MongoRegex("/@example.com/i"));
//$where = array("Family Name"=>"Wood");
//$option = array("justOne"=>false);
//$collection->remove($where,$option);
//print_r($collection->drop());
//print_r($db->drop());
echo "<br />----------------------------------------------------------------------------<br />";
echo "</pre>";
?>