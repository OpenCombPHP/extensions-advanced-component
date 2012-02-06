<?php
namespace org\opencomb\doccenter;

use org\opencomb\platform\ext\Extension;
use org\jecat\framework\mvc\model\IModel;
use org\jecat\framework\db\DB;
use org\jecat\framework\util\Version;
use org\opencomb\doccenter\frame\DocFrontController;
use org\jecat\framework\message\Message;

class WikiContent extends DocFrontController {
	public function createBeanConfig() {
		return array (
				'title' => '文档内容', 
				'view:wikiContent' => array (
						'template' => 'WikiContent.html', 
						'class' => 'view', 
						'model' => 'wiki' ), 
				'model:wiki' => array (
						'class' => 'model', 
						'list' => true, 
						'orm' => array (
								'table' => 'topic', 
								'orderAsc' => 'version',
								'hasAndBelongsToMany:examples' => array (
										'fromkeys' => array ('title' ), 
										'tobridgekeys' => array ('topic_title' ), 
										'frombridgekeys' => 'eid', 
										'tokeys' => 'eid', 
										'table' => 'example', 
										'bridge' => 'example_topic', 
										'orderAsc'=>'index'
										) 
								) 
						), 
				'model:versions' => array (
						'class' => 'model', 
						'list' => true, 
						'orm' => array (
								'table' => 'topic',
								'orderAsc' => 'version', 
								'columns' => array (
										'version'
										 ), 
								'keys' => 'version'
								) 
						) 
				);
	}
	
	public function process() {
		
	}
	
}