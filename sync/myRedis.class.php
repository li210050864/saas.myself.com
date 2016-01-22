<?php
/*
 * Created on 2015��7��15��
 * Author lmx
 * Redis class
 */
class myRedis{
	private $redis;
	private $host;
	private $port;
	
	/**
	 * ����redis���� host redis ������IP��������Ĭ��Ϊ 127.0.0.1 ����
	 */
	public function setHost($host = '127.0.0.1'){
		$this->host = $host;
	}
	/**
	 * ����redis ����˿� Ĭ��Ϊ 6379
	 */
	public function setPort($port = 6379){
		$this->port = $port;
	}
	/**
	 * ����redis ����
	 */
	public function setRedis(){
		if(isset($this->redis)){
			$this->redis =$this->redis;
		}else{
			$this->redis = new Redis();
		}
	}
	
	/**
	 * ���캯�������redis ������
	 * @param $host �� redis ������IP��������
	 * @param $port : redis ����˿�
	 */
	public function __construct($host='127.0.0.1',$port=6379){
		$this->setHost($host);
		$this->setPort($port);
		$this->setRedis();
		$this->redisConnect();
	}
	
	/**
	 * ����redis
	 */
	public function redisConnect(){
		$this->redis->connect($this->host,$this->port);
	}
	
	/**
	 * redis ��������
	 * @param $set ��������
	 * @param $value ֵ
	 */
	public function redisSadd($set,$value){
		$this->redis->SADD($set,$value);
	}
	
	/**
	 * redis ������в���ֵ
	 * @param $key ��ֵ
	 * @param $value ֵ
	 */
	public function redisLpush($key,$value){
		$this->redis->lpush($key,$value);
	}
	
	/**
	 * redis �Ӷ����ж�ȡֵ
	 * @param $key ��ֵ
	 * @return $value
	 */
	public function redisRpop($key){
		return $this->redis->rpop($key);
	}
	
	/**
	 * redis ��ȡֵ
	 * @param $key ��ֵ����
	 */
	public function redisGet($key){
		return $this->redis->get($key);
	}
	
}

?>
