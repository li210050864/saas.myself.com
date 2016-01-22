<?php
/*
 * Created on 2015年7月15日
 * Author lmx
 * Redis class
 */
class myRedis{
	private $redis;
	private $host;
	private $port;
	
	/**
	 * 设置redis参数 host redis 服务器IP或域名，默认为 127.0.0.1 本机
	 */
	public function setHost($host = '127.0.0.1'){
		$this->host = $host;
	}
	/**
	 * 设置redis 服务端口 默认为 6379
	 */
	public function setPort($port = 6379){
		$this->port = $port;
	}
	/**
	 * 创建redis 对象
	 */
	public function setRedis(){
		if(isset($this->redis)){
			$this->redis =$this->redis;
		}else{
			$this->redis = new Redis();
		}
	}
	
	/**
	 * 构造函数，完成redis 的连接
	 * @param $host ： redis 服务器IP或者域名
	 * @param $port : redis 服务端口
	 */
	public function __construct($host='127.0.0.1',$port=6379){
		$this->setHost($host);
		$this->setPort($port);
		$this->setRedis();
		$this->redisConnect();
	}
	
	/**
	 * 连接redis
	 */
	public function redisConnect(){
		$this->redis->connect($this->host,$this->port);
	}
	
	/**
	 * redis 创建集合
	 * @param $set 集合名称
	 * @param $value 值
	 */
	public function redisSadd($set,$value){
		$this->redis->SADD($set,$value);
	}
	
	/**
	 * redis 向队列中插入值
	 * @param $key 键值
	 * @param $value 值
	 */
	public function redisLpush($key,$value){
		$this->redis->lpush($key,$value);
	}
	
	/**
	 * redis 从队列中读取值
	 * @param $key 键值
	 * @return $value
	 */
	public function redisRpop($key){
		return $this->redis->rpop($key);
	}
	
	/**
	 * redis 读取值
	 * @param $key 键值名称
	 */
	public function redisGet($key){
		return $this->redis->get($key);
	}
	
}

?>
