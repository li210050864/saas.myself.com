-- 地理空间索引
db.restaurants.find({loc:{
		$geoWithin:{
			$geometry:{
					type:"Polygon",
					coordinates:[[
						[52.368739,4.890203],[52.368872,4.890477],[52.368726,4.890793],[52.368608,4.89049],[52.368739,4.890203]
					]]
				}
			}
	}});
db.restaurants.find({loc:{$geoWithin:{$center:[[52.370524,5.217682],10]}}});
db.restaurants.find({loc:{$geoWithin:{$centerSphere:[[52.370524,5.217682],10]}}});
-- MongoDB 增删改查
db.media.update({"Title":"Matrix,The"},{$set:{Genre:"Sci-Fi2"}});
db.media.find({"Title":"Matrix,The"});
db.media.update({"Title":"Matrix,The"},{$unset:{"Genre":1}});
db.media.update({"IBSN":"978-1-4302-5821-6"},{$push:{Author:"Griffin,Stewie"}});
db.media.find({"IBSN":"978-1-4302-5821-6"});
db.media.update({"IBSN":"978-1-4302-5821-6"},{$push:{Author:{$each:["Griffin,Peter","Griffin,Brian"]}}});
db.media.update({"IBSN":"978-1-4302-5821-6"},{$addToSet:{Author:"Griffin,Brian"}});
db.media.update({"IBSN":"978-1-4302-5821-6"},{$pop:{Author:1}});
db.media.update({"IBSN":"978-1-4302-5821-6"},{$push:{Author:"Griffin,Weast"}});
db.media.update({"IBSN":"978-1-4302-5821-6"},{$pull:{Author:"Griffin,Weast"}});
db.media.update({"Title":"Nirvana"},{$addToSet:{Tracklist:{Track:2,"Title":"Been a Son",Length:"2:23"}}});
db.media.find({"Title":"Nirvana"});
db.media.find({"Tracklist.Title":"Been a Son"});
db.media.update({"Tracklist.Title":"Been a Son"},{$inc:{"Tracklist.$.Track":1 }});
db.$cmd.findOne({getlasterror:1});
db.media.findAndModify({"Title":"One Piece",sort:{"Title":-1,remove:true}});
db.media.find();
db.media.findAndModify({query:{"IBSN":"978-1-4302-5821-6"},sort:{"Title":-1},update:{$set:{Title:"Different Title"}}});
db.media.renameCollection("medianew");
show collections;
db.medianew.remove({"Title":"Matrix,The"});
db.medianew.drop();
db.dropDatabase();

appress=({"_id":"Appress","Type":"Technical Publisher","Category":["IT","Software","Programming"]});
db.publisherscollection.insert(appress);
book=({"Type":"Book","Title":"Definitive Guide to MongoDB 2nd ed.,The","ISBN":"978-1-4302-5821-6","Publisher":"Appress","Author":["Hows,David","Plugge,Eelco","Membery,Peter","Hawkins,Tim"]});
db.media.insert(book);
book=db.media.findOne();
db.publisherscollection.findOne({_id:book.Publisher});

appress=({"Type":"Technical Publisher","Category":["IT","Software","Programming"]});
db.publisherscollection.save(appress);
book=({"Type":"Book","Titile":"Definitive Guide to MongoDB 2nd ed.,The","ISBN":"978-1-4302-5821-6",Author:["Hows,David","membrey,Peter","Plugge,Eelco","Hawkins,Tim"],Publisher:[new DBRef('publisherscollection',appress._id)]});

db.media.ensureIndex({Title:1});

cd=({"Type":"CD","Title":"Nevermind","Artist":"Nirvana","Tracklist":[{Track:"1","Title":"Smells Like Teen Spirit",Length:"5:02"},{Track:"2","Title":"In Bloom",Length:"4:15"}]});
db.media.insert(cd);
db.media.ensureIndex({"Tracklist.Title":1});
{
	"createdCollectionAutomatically" : false,
	"numIndexesBefore" : 3,
	"numIndexesAfter" : 4,
	"ok" : 1
}
> db.system.indexes.find();
{ "v" : 1, "key" : { "_id" : 1 }, "name" : "_id_", "ns" : "library.audit" }
{ "v" : 1, "key" : { "_id" : 1 }, "name" : "_id_", "ns" : "library.publisherscollection" }
{ "v" : 1, "key" : { "_id" : 1 }, "name" : "_id_", "ns" : "library.media" }
{ "v" : 1, "key" : { "Title" : 1 }, "name" : "Title_1", "ns" : "library.media" }
{ "v" : 1, "key" : { "Title" : -1 }, "name" : "Title_-1", "ns" : "library.media" }
{ "v" : 1, "key" : { "Tracklist.Title" : 1 }, "name" : "Tracklist.Title_1", "ns" : "library.media" }

> db.media.find({ISBN:"978-1-4302-5821-6"}).hint({ISBN:-1});
Error: error: {
	"$err" : "Unable to execute query: error processing query: ns=library.media limit=0 skip=0\nTree: ISBN == \"978-1-4302-5821-6\"\nSort: {}\nProj: {}\n planner returned error: bad hint",
	"code" : 17007
}
> db.media.ensureIndex({ISBN:1},{background:true});
{
	"createdCollectionAutomatically" : false,
	"numIndexesBefore" : 4,
	"numIndexesAfter" : 5,
	"ok" : 1
}
> db.media.find({ISBN:"978-1-4302-5821-6"}).hint({ISBN:-1});
Error: error: {
	"$err" : "Unable to execute query: error processing query: ns=library.media limit=0 skip=0\nTree: ISBN == \"978-1-4302-5821-6\"\nSort: {}\nProj: {}\n planner returned error: bad hint",
	"code" : 17007
}
> db.media.find({ISBN:"978-1-4302-5821-6"}).hint({ISBN:1});
{ "_id" : ObjectId("55dbbec69c7926fe4d9978f7"), "Type" : "Book", "Titile" : "Definitive Guide to MongoDB 2nd ed.,The", "ISBN" : "978-1-4302-5821-6", "Author" : [ "Hows,David", "membrey,Peter", "Plugge,Eelco", "Hawkins,Tim" ], "Publisher" : [ DBRef("publisherscollection", ObjectId("55dbbce29c7926fe4d9978f6")) ] }
> db.media.find({ISBN:"978-1-4302-5821-6"}).hint({ISBN:1}).explain();
{
	"queryPlanner" : {
		"plannerVersion" : 1,
		"namespace" : "library.media",
		"indexFilterSet" : false,
		"parsedQuery" : {
			"ISBN" : {
				"$eq" : "978-1-4302-5821-6"
			}
		},
		"winningPlan" : {
			"stage" : "FETCH",
			"inputStage" : {
				"stage" : "IXSCAN",
				"keyPattern" : {
					"ISBN" : 1
				},
				"indexName" : "ISBN_1",
				"isMultiKey" : false,
				"direction" : "forward",
				"indexBounds" : {
					"ISBN" : [
						"[\"978-1-4302-5821-6\", \"978-1-4302-5821-6\"]"
					]
				}
			}
		},
		"rejectedPlans" : [ ]
	},
	"serverInfo" : {
		"host" : "localhost.localdomain",
		"port" : 27017,
		"version" : "3.0.5",
		"gitVersion" : "8bc4ae20708dbb493cb09338d9e7be6698e4a3a3 modules: enterprise"
	},
	"ok" : 1
}

> db.media.insert({"Type":"DVD","Titile":"Matrix,The","Released":1999});
WriteResult({ "nInserted" : 1 })
> db.media.insert({"Type":"DVD","Titile":"Blade Runner","Released":1982});
WriteResult({ "nInserted" : 1 })
> db.media.insert({"Type":"DVD","Titile":"Toy Story 3","Released":2010});
WriteResult({ "nInserted" : 1 })
> db.media.ensureIndex({Released:1});
{
	"createdCollectionAutomatically" : false,
	"numIndexesBefore" : 5,
	"numIndexesAfter" : 6,
	"ok" : 1
}
> db.media.find().min({Released:1995}).max({Released:2005});
{ "_id" : ObjectId("55dbc6d99c7926fe4d9978f9"), "Type" : "DVD", "Titile" : "Matrix,The", "Released" : 1999 }

({"First Name":"Victoria","Last Name":"Wood","Address":[{"Street":"50 Ash lane","Place":"Ystradgynlains","Postal Code":"SA9 6XS","Country":"UK"}],"E-Mail":["vm@example.com","vm@office.com"],"Phone":"078-8727-8409","Age":28});


-- 聚合框架
--备份数据
monogdump -d test -o test.tgz
-- 恢复数据
mongorestore --db m /root/m
-- $name : 文档中包含 name 字段
> db.company.aggregate({$group:{_id:"$name"}});
{ "_id" : "广州市美控电子科技有限公司" }
{ "_id" : "测试开放接口2222" }
{ "_id" : "深圳市泰合唯信科技有限公司" }
{ "_id" : "金山安全测试注册2" }
{ "_id" : "上海晟一数码印务有限公司" }
{ "_id" : "金博数码快印" }
{ "_id" : "江西天琼实业有限公司" }
{ "_id" : "深圳市毅星纺投资发展有限公司" }
{ "_id" : "深圳贸涛伟业科技有限公司" }
{ "_id" : "上海锦泰金属材料有限公司" }
{ "_id" : "周启飞口腔诊所" }
{ "_id" : "haha" }
{ "_id" : "湛江日报社" }
{ "_id" : "广州市蓝昌贸易有限公司" }
{ "_id" : "上海赤刚投资管理咨询有限公" }
{ "_id" : "广州市玛润机械设备有限公司" }
{ "_id" : "东莞市玥行商贸有限公司" }
{ "_id" : "香港金融网" }
{ "_id" : "智信创富金融信息服务（上海）有限公司" }
{ "_id" : "日丰建材（天津）有限公司" }
Type "it" for more
> it
{ "_id" : "test" }
{ "_id" : "广州市知远电子有限公司" }
{ "_id" : "上海夯昆电子商务有限公司" }
{ "_id" : "深圳市万家兄弟电子商务有限公司" }
{ "_id" : "51瓷网" }
{ "_id" : "测试帐号_ZHJ" }
{ "_id" : "珠海佳米科技有限公司" }
{ "_id" : "广州益寿医院(有限合伙)" }
{ "_id" : "xushinan" }
{ "_id" : "深圳市彩印通科技有限公司" }
{ "_id" : "华励展览（上海）有限公司" }
{ "_id" : "东莞市创顺防静电科技有限公司" }
{ "_id" : "北京科技" }
{ "_id" : "深圳市丰韩昱英实业有限公司" }
{ "_id" : "苏州市华谊商务有限公司" }
{ "_id" : "汕头市康泰国际旅行社有限公司" }
{ "_id" : "上海杉杉针织内衣有限公司" }
{ "_id" : "深圳市林华企业管理顾问有限公司" }
{ "_id" : "广州涵天酒店" }
{ "_id" : "上海泓亮国际货物运输代理有限公司" }
-- limit : 限制条数 $sum 计数 依据 name/status 进行分组
> db.company.aggregate([{$group:{_id:{name:"$name",status:"$status"},count:{$sum:1}}},{$limit:5}]);
{ "_id" : { "name" : "测试开放接口2222", "status" : NumberLong(1) }, "count" : 1 }
{ "_id" : { "name" : "深圳市泰合唯信科技有限公司", "status" : NumberLong(1) }, "count" : 1 }
{ "_id" : { "name" : "广州垄燊进出口有限公司", "status" : NumberLong(1) }, "count" : 1 }
{ "_id" : { "name" : "上海晟一数码印务有限公司", "status" : NumberLong(0) }, "count" : 1 }
{ "_id" : { "name" : "金博数码快印", "status" : NumberLong(1) }, "count" : 1 }
-- $match 在狙击管道中搞笑的返回一个普通的MongoDB 查询结果，操作符 $match 最好用在管道的开始，用于限制一开始被输入到管道中的文档的数量
> db.company.aggregate([{$match:{status:{$ne:0}}},{$group:{_id:{name:"$computer_name",status:"$status"},count:{$sum:1}}},{$limit:5}]);
{ "_id" : { "status" : NumberLong(1) }, "count" : 226 }
> db.kc_hostinfo.aggregate([{$match:{status:{$ne:0}}},{$group:{_id:{name:"$computer_name",status:"$status"},count:{$sum:1}}},{$limit:5}]);
{ "_id" : { "status" : 2 }, "count" : 2 }
{ "_id" : { "status" : 1 }, "count" : 25 }
--$sort 正数代表升序 负数代表降序
> db.company.aggregate([{$group:{_id:{name:"$name"},count:{$sum:1}}},{$sort:{_id:1}},{$limit:10}]);
{ "_id" : { "name" : "2132132131" }, "count" : 1 }
{ "_id" : { "name" : "407实验室" }, "count" : 1 }
{ "_id" : { "name" : "51瓷网" }, "count" : 1 }
{ "_id" : { "name" : "JUST" }, "count" : 1 }
{ "_id" : { "name" : "Jingoal-Test" }, "count" : 1 }
{ "_id" : { "name" : "MAKINO" }, "count" : 1 }
{ "_id" : { "name" : "MMQ公司" }, "count" : 1 }
{ "_id" : { "name" : "SHHSXX" }, "count" : 1 }
{ "_id" : { "name" : "TGTchibo" }, "count" : 1 }
{ "_id" : { "name" : "cmcm" }, "count" : 1 }
> db.company.aggregate([{$group:{_id:{name:"$name"},count:{$sum:1}}},{$sort:{_id:-1}},{$limit:10}]);
{ "_id" : { "name" : "鼎盛传祺" }, "count" : 1 }
{ "_id" : { "name" : "香港金融网" }, "count" : 1 }
{ "_id" : { "name" : "韶关艾瑞美容医院" }, "count" : 2 }
{ "_id" : { "name" : "青岛科捷" }, "count" : 1 }
{ "_id" : { "name" : "阳东县富城五金工贸有限公司" }, "count" : 1 }
{ "_id" : { "name" : "钜亮光学" }, "count" : 1 }
{ "_id" : { "name" : "鑫灵感电脑配件经营部" }, "count" : 1 }
{ "_id" : { "name" : "金蝶云之家" }, "count" : 1 }
{ "_id" : { "name" : "金盾酒店投资管理有限公司" }, "count" : 1 }
{ "_id" : { "name" : "金山安全测试账户1" }, "count" : 1 }
-- $unwind 接受一个数组，并将每个元素分割到一个新的文档中（在内存中而不是添加到集合中）
-- $project限制文档中返回的字段或者重命名其中的字段，这仅仅是一个可用在find命令中的字段限制参数，是减少聚集中多余字段的最好方式，$project 操作符只是修改返回的文档内容，不会修改数据库中的文档
> db.user.aggregate({$project:{name:1,status:1,groups:1,tenYears:{$add:["$age",10]}}});
{ "_id" : ObjectId("55dac71802e60e4df1c8ddb4"), "name" : "sue", "status" : "A", "groups" : [ "news", "sports" ], "tenYears" : 36 }
> db.user.find();
{ "_id" : ObjectId("55dac71802e60e4df1c8ddb4"), "name" : "sue", "age" : 26, "status" : "A", "groups" : [ "news", "sports" ] }
--重命名字段
> db.user.aggregate({$project:{name:1,username:"$name",bar:"$groups"}});
{ "_id" : ObjectId("55dac71802e60e4df1c8ddb4"), "name" : "sue", "username" : "sue", "bar" : [ "news", "sports" ] }
> db.user.find();
{ "_id" : ObjectId("55dac71802e60e4df1c8ddb4"), "name" : "sue", "age" : 26, "status" : "A", "groups" : [ "news", "sports" ] }
-- 添加子文档
> db.user.aggregate({$project:{name:1,stats:{pv:"$age",foo:"$groups",dpv:{$add:["$age",10]}}}});
{ "_id" : ObjectId("55dac71802e60e4df1c8ddb4"), "name" : "sue", "stats" : { "pv" : 26, "foo" : [ "news", "sports" ], "dpv" : 36 } }
> db.user.find();
{ "_id" : ObjectId("55dac71802e60e4df1c8ddb4"), "name" : "sue", "age" : 26, "status" : "A", "groups" : [ "news", "sports" ] }
-- skip 忽略前X个文档，并返回所有剩余的文档，用他减少返回的文档数量
> db.company.aggregate({$skip:260});
{ "_id" : ObjectId("55acea0400726d642e8b456c"), "create_time" : ISODate("2015-07-20T12:31:00.729Z"), "enterprise_id" : 100386116, "create_date" : NumberLong(1437395460), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "101-100-001", "app_policy" : [ [ "1", "2", "3", "4", "5" ], [ "00:00-23:59" ] ], "logout" : "OXFkdWRO", "uninst" : "OXFkdWRO", "email" : "mtelectronic@vip.163.com", "password" : "c75cfbef8b050172c59dc8803ec7e1e83c107013115dc0959aa5c1bd42b6dc41", "name" : "深圳贸涛伟业科技有限公司", "serial" : "55aca7f04a22324a8ac0ad14", "cid" : "93701d45af4fc5ea1d34caf75c80b11a", "update_date" : NumberLong(1437962357), "f_expire" : [ NumberLong(1437395460), NumberLong(1469017860) ], "f_serial" : "55aca7f04a22324a8ac0ad14", "f_status" : NumberLong(0), "f_license" : NumberLong(5) }
{ "_id" : ObjectId("55b1ab1f00726d690b8b4582"), "create_time" : ISODate("2015-07-24T03:03:59.334Z"), "enterprise_id" : 100387947, "create_date" : NumberLong(1437707039), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "101-100-001", "app_policy" : [ [ "1", "2", "3", "4", "5" ], [ "08:00-12:00", "14:00-17:30" ] ], "logout" : "OFFZUjZB", "uninst" : "OFFZUjZB", "email" : "2850528593@QQ.COM", "password" : "284578b541d4ec67fbee23f48b45c8b79363de829f3609d74865456c2196441e", "name" : "深圳市毅星纺投资发展有限公司", "serial" : "55ae0b9b4a22324a8ac0ad2c", "cid" : "c3ea33745cee7ba18b3768c47998dc24", "update_date" : NumberLong(1437707039), "f_expire" : [ NumberLong(1437707039), NumberLong(1440299039) ], "f_serial" : "55ae0b9b4a22324a8ac0ad2c", "f_status" : NumberLong(1), "f_license" : NumberLong(10) }
{ "_id" : ObjectId("55b5a08c00726d660b8b4581"), "create_time" : ISODate("2015-07-27T03:07:56.805Z"), "enterprise_id" : 100388027, "create_date" : NumberLong(1437966476), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "101-100-001", "app_policy" : [ [ "1", "6", "2", "7", "3", "4", "5" ], [ "00:00-23:59" ] ], "logout" : "ZmZVd1Ru", "uninst" : "ZmZVd1Ru", "serial" : "558d1f5c4a22324a8ac0abdb", "email" : "279455008@qq.com", "password" : "30364a37c2b5c92cc1332852b6f5c24f44f56079e63c20ec7de1e8c408bda4ea", "name" : "江西天琼实业有限公司", "cid" : "af59352d10080232b2062a53914ac703", "update_date" : NumberLong(1437967109), "f_expire" : [ NumberLong(1437966476), NumberLong(1469588876) ], "f_serial" : "558d1f5c4a22324a8ac0abdb", "f_status" : NumberLong(0), "f_license" : NumberLong(5) }
{ "_id" : ObjectId("55b5a4c900726d680b8b4586"), "create_time" : ISODate("2015-07-27T03:26:01.027Z"), "enterprise_id" : 100389199, "create_date" : NumberLong(1437967561), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "101-100-001", "app_policy" : [ [ "1", "2", "3", "4", "5" ], [ "08:00-12:00", "14:00-17:30" ] ], "logout" : "Mk1NY1k2", "uninst" : "Mk1NY1k2", "email" : "2356804908@qq.com", "password" : "c2625ea2a66df577cff90c3de5c14b3ace4afac933eb90a4cae6dee983b542ea", "name" : "广州标信知识产权代理有限公司", "serial" : "55b19f254a22324a8ac0ad65", "cid" : "be6d471d41036313f178c7c78418f9ee", "update_date" : NumberLong(1437967561), "f_expire" : [ NumberLong(1437967561), NumberLong(1469589961) ], "f_serial" : "55b19f254a22324a8ac0ad65", "f_status" : NumberLong(0), "f_license" : NumberLong(5) }
{ "_id" : ObjectId("55b5deb700726d690b8b458b"), "create_time" : ISODate("2015-07-27T07:33:11.898Z"), "enterprise_id" : 100390123, "create_date" : NumberLong(1437982391), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "101-100-001", "app_policy" : [ [ "1", "6", "2", "7", "3", "4", "5" ], [ "00:00-23:59" ] ], "logout" : "VEFwWDlx", "uninst" : "VEFwWDlx", "email" : "511378501@qq.com", "password" : "41c93e70c74d1208e835c1bee1bed0eb09b1a754ec767960ca7539e8156e5de8", "name" : "金博数码快印", "serial" : "55a60a604a22324a8ac0acfa", "cid" : "016738f0d6a1912098a95e0d3521f9b6", "update_date" : NumberLong(1437982925), "f_expire" : [ NumberLong(1437982391), NumberLong(1469604791) ], "f_serial" : "55a60a604a22324a8ac0acfa", "f_status" : NumberLong(0), "f_license" : NumberLong(5) }
{ "_id" : ObjectId("55b5e0db00726d684c8b456e"), "create_time" : ISODate("2015-07-27T07:42:19.281Z"), "enterprise_id" : 100391785, "create_date" : NumberLong(1437982939), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "101-100-001", "app_policy" : [ [ "1", "2", "3", "4", "5" ], [ "08:00-12:00", "14:00-17:30" ] ], "logout" : "S0w4bFph", "uninst" : "S0w4bFph", "email" : "fzj@szlk.gzmpc.com", "password" : "a6f074bd45a3fbcd1f2c665f716f5dcb982447c532fe378dc96519fcaea5d846", "name" : "深圳广药联康医药有限公司", "serial" : "55b5962f4a22324a8ac0ad76", "cid" : "88155df739b4961e768cb32e480b3933", "update_date" : NumberLong(1437982939), "f_expire" : [ NumberLong(1437982939), NumberLong(1469605339) ], "f_serial" : "55b5962f4a22324a8ac0ad76", "f_status" : NumberLong(0), "f_license" : NumberLong(5) }
{ "_id" : ObjectId("55b5ecba00726d660b8b4588"), "create_time" : ISODate("2015-07-27T08:32:58.381Z"), "enterprise_id" : 100392374, "create_date" : NumberLong(1437985978), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "101-100-001", "app_policy" : [ [ "1", "2", "3", "4", "5" ], [ "08:00-12:00", "14:00-17:30" ] ], "logout" : "eU9XT3E2", "uninst" : "eU9XT3E2", "email" : "851622859@qq.com", "password" : "703bce5849d60f94d0de6331cfc665f93270c115f6749e519b509b962a7a4fa0", "name" : "爱蓝国际旅行社有限公司", "serial" : "55aefb024a22324a8ac0ad2e", "cid" : "c94836e884938c3a8f34e4725a8122de", "update_date" : NumberLong(1437985978), "f_expire" : [ NumberLong(1437985978), NumberLong(1469608378) ], "f_serial" : "55aefb024a22324a8ac0ad2e", "f_status" : NumberLong(0), "f_license" : NumberLong(5) }
{ "_id" : ObjectId("55b7158900726dc8198b457d"), "create_time" : ISODate("2015-07-28T05:39:21.943Z"), "enterprise_id" : 100393199, "create_date" : NumberLong(1438061961), "status" : NumberLong(0), "em_verified" : NumberLong(0), "reg_from" : "101-100-001", "app_policy" : [ [ "1", "2", "3", "4", "5" ], [ "08:00-12:00", "14:00-17:30" ] ], "logout" : "b3ZVa1JL", "uninst" : "b3ZVa1JL", "email" : "sy32251002@vip.sina.com", "password" : "73be973d1a92398b2d458fe42def08007b11ea6a9010940801777513c8697527", "name" : "上海晟一数码印务有限公司", "serial" : "55b5bf2d4a22324a8ac0ad7e", "cid" : "49a1d8f8b4dbd063960618a9c0233fb2", "update_date" : NumberLong(1438061961), "f_expire" : [ NumberLong(1438061961), NumberLong(1564292361) ], "f_serial" : "55b5bf2d4a22324a8ac0ad7e", "f_status" : NumberLong(0), "f_license" : NumberLong(11) }
{ "_id" : ObjectId("55b725e900726d9f018b457f"), "create_time" : ISODate("2015-07-28T06:49:13.324Z"), "enterprise_id" : 100394569, "create_date" : NumberLong(1438066153), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "101-100-001", "app_policy" : [ [ "1", "2", "3", "4", "5" ], [ "08:00-12:00", "14:00-17:30" ] ], "logout" : "NkF6djJ4", "uninst" : "NkF6djJ4", "email" : "maier@maiertrade.com", "password" : "d15df548fb13466186cd9289ab59e8282b9daf430451d63fe77a1cce34f2106e", "name" : "广州垄燊进出口有限公司", "serial" : "55af04ac4a22324a8ac0ad2f", "cid" : "f3c80e5cb4dd6d418fc073070e411f39", "update_date" : NumberLong(1438066153), "f_expire" : [ NumberLong(1438066153), NumberLong(1469688553) ], "f_serial" : "55af04ac4a22324a8ac0ad2f", "f_status" : NumberLong(0), "f_license" : NumberLong(5) }
{ "_id" : ObjectId("55b734dc00726d690b8b4592"), "create_time" : ISODate("2015-07-28T07:53:00.282Z"), "enterprise_id" : 100395853, "create_date" : NumberLong(1438069980), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "100-100-001", "app_policy" : [ [ "1", "2", "3", "4", "5" ], [ "08:00-12:00", "14:00-17:30" ] ], "logout" : "cmZKdTQ1", "uninst" : "cmZKdTQ1", "password" : "284578b541d4ec67fbee23f48b45c8b79363de829f3609d74865456c2196441e", "email" : "yyy1076766088@163.com", "name" : "金山安全测试注册", "serial" : "55b734254a22324a8ac0ad92", "cid" : "478bfe16d5194bad1f72c9307626c7c8", "update_date" : NumberLong(1438069980), "f_expire" : [ NumberLong(1438069980), NumberLong(1469692380) ], "f_serial" : "55b734254a22324a8ac0ad92", "f_status" : NumberLong(0), "f_license" : NumberLong(20) }
{ "_id" : ObjectId("55b741d500726db2518b456e"), "create_time" : ISODate("2015-07-28T08:48:21.323Z"), "enterprise_id" : 100396159, "create_date" : NumberLong(1438073301), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "100-100-001", "app_policy" : [ [ "1", "2", "3", "4", "5" ], [ "08:00-12:00", "14:00-17:30" ] ], "logout" : "aHIzNUpY", "uninst" : "aHIzNUpY", "email" : "yyyy1076766088@163.com", "password" : "284578b541d4ec67fbee23f48b45c8b79363de829f3609d74865456c2196441e", "name" : "金山安全测试注册2", "serial" : "55b7417a4a22324a8ac0ad93", "cid" : "5532f05ddf89cdc22b5f9b573833cff3", "update_date" : NumberLong(1438073301), "f_expire" : [ NumberLong(1438073301), NumberLong(1469695701) ], "f_serial" : "55b7417a4a22324a8ac0ad93", "f_status" : NumberLong(0), "f_license" : NumberLong(10) }
{ "_id" : ObjectId("55b82ce100726d650b8b458a"), "create_time" : ISODate("2015-07-29T01:31:13.756Z"), "enterprise_id" : 100397511, "create_date" : NumberLong(1438133473), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "101-100-001", "app_policy" : [ [ "1", "2", "3", "4", "5" ], [ "08:00-12:00", "14:00-17:30" ] ], "logout" : "VTRpbGxM", "uninst" : "VTRpbGxM", "email" : "andichen@togevision.com", "password" : "7a10cebbd10f6e5947159fc201bceaaf4c65bf25831dfe820e9b7f947ce6bbb9", "name" : "深圳市泰合唯信科技有限公司", "serial" : "55b58d794a22324a8ac0ad73", "cid" : "898dcce9fc3ffc1ab4e911cabfdee7bd", "update_date" : NumberLong(1438133473), "f_expire" : [ NumberLong(1438133473), NumberLong(1469755873) ], "f_serial" : "55b58d794a22324a8ac0ad73", "f_status" : NumberLong(0), "f_license" : NumberLong(5) }
{ "_id" : ObjectId("55b8373200726da70c8b4589"), "create_time" : ISODate("2015-07-29T02:15:14.125Z"), "enterprise_id" : 100398516, "create_date" : NumberLong(1438136114), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "102-100-001", "app_policy" : [ [ "1", "2", "3", "4", "5" ], [ "08:00-12:00", "14:00-17:30" ] ], "logout" : "WTM2WHJW", "uninst" : "WTM2WHJW", "serial" : "55b8327f4a22324a8ac0ad9c", "name" : "测试开放接口2222", "email" : "y1076766088@163.com", "outer_cid" : "123456789", "cid" : "0889ad4c3f196c76b40d8d2bfd278bb4", "update_date" : NumberLong(1438136114), "f_expire" : [ NumberLong(1438136114), NumberLong(1469758514) ], "f_serial" : "55b8327f4a22324a8ac0ad9c", "f_status" : NumberLong(0), "f_license" : NumberLong(20) }
{ "_id" : ObjectId("55b86bcd00726d690b8b459b"), "create_time" : ISODate("2015-07-29T05:59:41.303Z"), "enterprise_id" : 100399953, "create_date" : NumberLong(1438149581), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "101-100-001", "app_policy" : [ [ "1", "2", "3", "4", "5" ], [ "08:00-12:00", "14:00-17:30" ] ], "logout" : "dVBQMUdO", "uninst" : "dVBQMUdO", "email" : "261802784@qq.com", "password" : "401b28be9c4a3b6cefb755209221baf2da2608a27dc901227c8d04524410bb1c", "name" : "广州市美控电子科技有限公司", "serial" : "55b5a7644a22324a8ac0ad7a", "cid" : "baf5ba7276274baeed6597fcf9279910", "update_date" : NumberLong(1438149581), "f_expire" : [ NumberLong(1438149581), NumberLong(1469771981) ], "f_serial" : "55b5a7644a22324a8ac0ad7a", "f_status" : NumberLong(0), "f_license" : NumberLong(5) }
{ "_id" : ObjectId("55b9952b00726d3e0f8b4574"), "create_time" : ISODate("2015-07-30T03:08:27.667Z"), "enterprise_id" : 100400740, "create_date" : NumberLong(1438225707), "status" : NumberLong(1), "em_verified" : NumberLong(1), "reg_from" : "101-100-001", "app_policy" : [ [ "1", "2", "3", "4", "5" ], [ "08:00-12:00", "14:00-17:30" ] ], "logout" : "dzJRVkFQ", "uninst" : "dzJRVkFQ", "email" : "282485676@qq.com", "password" : "bf3303ef7ddb581303a1c383b4edfe9667698a4a65719aeb1ac3859d0d857a15", "name" : "广州市花都区新华江花眼镜厂", "serial" : "55b72cb64a22324a8ac0ad8f", "cid" : "c691441007178e12abff0cdd9041a025", "update_date" : NumberLong(1438225707), "f_expire" : [ NumberLong(1438225707), NumberLong(1469848107) ], "f_serial" : "55b72cb64a22324a8ac0ad8f", "f_status" : NumberLong(0), "f_license" : NumberLong(5) }
-- 数据库管理
-- 不能创建名称相同，大小写不同的数据库
> use Foo
switched to db Foo
> db.createCollection("user");
{ "ok" : 1 }
> use foo
switched to db foo
> db.createCollection("user");
{
	"errmsg" : "exception: db already exists with different case already have: [Foo] trying to create [foo]",
	"code" : 13297,
	"ok" : 0
}
-- 备份和还原MongoDB 系统
-- 备份所有数据库
[root@localhost mongoback]# mongodump -o m_bak
2015-08-26T02:11:49.564+0800	writing m.code to m_bak/m/code.bson
2015-08-26T02:11:49.565+0800	writing m.code metadata to m_bak/m/code.metadata.json
2015-08-26T02:11:49.565+0800	done dumping m.code (7 documents)
2015-08-26T02:11:49.565+0800	writing m.company to m_bak/m/company.bson 
-- 备份单个数据库
[root@localhost mongoback]# mongodump -d m -o mbak
2015-08-26T02:25:18.773+0800	writing m.code to mbak/m/code.bson
2015-08-26T02:25:18.773+0800	writing m.code metadata to mbak/m/code.metadata.json
2015-08-26T02:25:18.773+0800	done dumping m.code (7 documents)
2015-08-26T02:25:18.773+0800	writing m.company to mbak/m/company.bson 
-- 备份单个集合
[root@localhost mongoback]# mongodump -d m -c code
2015-08-26T02:22:53.122+0800	writing m.code to dump/m/code.bson
2015-08-26T02:22:53.123+0800	writing m.code metadata to dump/m/code.metadata.json
2015-08-26T02:22:53.124+0800	done dumping m.code (7 documents)
-- 恢复数据库
[root@localhost mongoback]# mongorestore --db m /root/mongoback/m_bak/m --drop
2015-08-26T02:18:30.540+0800	building a list of collections to restore from /root/mongoback/m_bak/m dir
2015-08-26T02:18:30.543+0800	reading metadata file from /root/mongoback/m_bak/m/hoststatus.metadata.json
-- 深入参数定义
mongodump --help
	--dbpath: 如果有大量需要备份的数据和快速驱动器，并且不考虑索引的备份，那么推荐通过直接将MongoDB 服务器上的数据文件复制到备份媒介中的方式备份数据库，通过该选项可以直接备份服务器上的数据文件，但只有在服务器离线或写冻结时才可使用
	--directoryperdb:结合--dbpath 命令行选项一起使用，可以指定正在备份的MongoDB服务器将每个数据库中的数据分贝放到不同的目录中。默认情况下，MongoDB将数据文件放在一个目录中。
	-o/--out: 指定数据库转储文件的存放目录，默认情况下，mongodump工具将在当前目录中创建一个名为 /dump 的文件夹，并将转储文件保存在其中。 
	--authenticationDatabase:指定保存用户凭证的数据库，在未使用该项的情况下，mongodump 默认将使用-db 选项指定的数据库
	--authenticationMachanism:默认使用MongoDB的挑战/响应机制（用户名/密码）。该命令用于将验证模式切换为MongoDB企业版的Kerberos验证。

-- 恢复单个集合
[root@localhost ~]# mongorestore -d m -c code /root/dump/m/code.bson  --drop
2015-08-26T02:49:21.156+0800	checking for collection data in /root/dump/m/code.bson
2015-08-26T02:49:21.159+0800	reading metadata file from /root/dump/m/code.metadata.json
2015-08-26T02:49:21.160+0800	restoring m.code from file /root/dump/m/code.bson
2015-08-26T02:49:21.225+0800	restoring indexes for collection m.code from metadata
2015-08-26T02:49:21.225+0800	finished restoring m.code (7 documents)
2015-08-26T02:49:21.225+0800	done
 -- 深入参数理解
 --drop 在恢复集合之前删除现有的集合，保证不会出现重复数据，如果为使用该选项，被恢复的数据将被添加到目标集合中
 --noobjcheck: 忽略将对象插入目标集合之前的验证步骤
-- 自动化备份
 file:mongo_bak.sh 


