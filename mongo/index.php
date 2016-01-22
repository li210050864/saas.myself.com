<?php
/*
 * php 和 mongo
 * create time 2015-08-31
 * author lmx
*/
//$c = new MongoClient("mongodb://192.168.224.131:27017");
$c = new MongoClient("mongodb://119.29.96.177:27017");

//$dbs = $c->listDBs();
$db = $c->selectDB("m");
$collection = $db->selectCollection("hoststatus");
$result = $collection->findOne();
print_r($result);
/*
$contact = array(
	"First Name" =>"Philip",
	"Last Name"  => "Moran",
	"Address"    => array(
		"Street"   => "681 Hinkle Lake Road",
		"Place"    => "Newton",
		"Postal Code" => "MA 02610",
		"Country"  => "USA"
	),
	"Email"     => array(
		"pm@example.com","pm@office.com","philip@example.com","philip@office.com","moran@example.com","moran@office.com","pmoran@example.com","pmoran@office.com"
	),
	"Phone"     => "617-546-8428",
	"Age"       => 60
);
$contact = array(
	"Type"=>"Book",
	"Title"=>"Wuthering  Heights",
	"Author"=>["Brandon","Francis"],
	"Detail"=>"Wuthering Heights (1847) - the story is narrated by Lockwood, a gentleman visiting the Yorkshire moors where the novel is set, and of Mrs Dean, housekeeper to the Earnshaw family, who had been witness of the interlocked destinies of the original owners of the Heights. In a series of flashbacks and time shifts, Bront&#235; draws a powerful picture of the enigmatic Heathcliff, who is brought to Heights from the streets of Liverpool by Mr Earnshaw. Heathcliff is treated as Earnshaw's own children, Catherine and Hindley. After his death Heathcliff is bullied by Hindley, who loves Catherine, but she marries Edgar Linton",
);

$contact = array(
	"Type"  => "CD",
	"Title" => "My Love",
	"Artist"=> "Weast Life",
	"Tracklist" => array(
		array(
			"Track" => "Seasons In The Sun",
			"Title" => "Seasons In The Sun",
			"Length"=> "5:45",
		),
		array(
			"Track" => "The Rose",
			"Title" => "The Rose",
			"Length" => "3:38"	
		)
	)
);
$collection->insert($contact);
$cursor = $collection->find();
while($document = $cursor->getNext()){
	print_r($document);
}
$collection->remove(array("Type"=>"CD"));
$where = array("Type"=>"Book");
$where = array("Email"=>"philip@example.com");
$result = $collection->find($where);
echo "<pre>";
	if($result){
		while($each = $result->getNext()){
			print_r($each);
			}
		}
echo "</pre>";

$cursor = $collection->find()->limit(1);
echo "<pre>";
while($doc = $cursor->getNext()){
	print_r($doc);	
}
echo "</pre>";
*/

?>