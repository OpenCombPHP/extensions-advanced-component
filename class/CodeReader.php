<?php
namespace org\opencomb\doccenter;

use org\opencomb\coresystem\auth\Id;

use org\opencomb\platform\ext\Extension;
use org\jecat\framework\mvc\model\IModel;
use org\jecat\framework\db\DB;
use org\jecat\framework\util\Version;
use org\opencomb\doccenter\frame\DocFrontController;
use org\jecat\framework\message\Message;

class WikiContent extends DocFrontController {
	public function createBeanConfig() {
		return array (
			'title' => '代码内容', 
			'view:reader' => array (
				'template' => 'CodeReader.html', 
				'class' => 'view'
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
			),
			'perms' => array(
					// 权限类型的许可
					'perm.purview'=>array(
							'namespace'=>'coresystem',
							'name' => Id::PLATFORM_ADMIN,
					) ,
				)
		);
	}
	
	public function process() {
		$this->checkPermissions('您没有使用这个功能的权限,无法继续浏览',array()) ;
	}
	
}