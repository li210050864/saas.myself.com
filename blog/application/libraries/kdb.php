<?php
class Kdb
{
    private function __clone() {}

    private static $_mongoClient = null;

    /**
     * 获取 mongo client 实列
     * @return bool|MongoClient|null
     */
    public static function getInstance()
    {

        try
        {
            if(self::$_mongoClient === null)
            {
                self::$_mongoClient = new MongoClient(
                    get_instance()->config->item('mongo_server')
                );
            }
            return self::$_mongoClient;
        }
        catch(MongoConnectionException $e)
        {
            kaas_log('connect mongodb error : ' . $e->getMessage(),4);
        }
        return false;
    }

    public function get_mongo_db()
    {
        return self::getInstance();
    }
}