<?php
namespace org\opencomb\advcmpnt;

use org\jecat\framework\util\String;

use org\opencomb\platform\ext\Extension;
use org\opencomb\platform\ext\ExtensionMetainfo;
use org\jecat\framework\fs\FileSystem;
use org\jecat\framework\message\Message;
use org\opencomb\coresystem\auth\Id;
use org\opencomb\doccenter\frame\DocFrontController;

class SourceViewer extends DocFrontController {
	/**
	 * @wiki 高级工具/代码查看器
	 * 
	 * 代码生成器需要一些参数才能找到对应的文件
	 * path  所在文件
	 * 找到文件后,代码查看器会读取其中的内容然后用代码高亮插件显示出来
	 * 可以以下参数来提高可读性:
	 * hline 高亮行,单行用','号隔开,多行用'~'表示区间,例如 '2,4,34~44,55'
	 */
	public function createBeanConfig() {
		return array (
			'title' => '代码查看', 
			'view:viewer' => array (
				'template' => 'SourceViewer.html', 
				'class' => 'view'
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
		
		if(!$this->params->has('path')){
			$this->messageQueue ()->create ( Message::error, "无法定位到指定代码,缺少信息" );
		}
		
		if($this->params->has('hline')){
			$arrLinesString = explode(',', $this->params->get('hline'));
			for($i=0;$i<count($arrLinesString);$i++){
				if(strpos($arrLinesString[$i] , '~')){
					list($sStart , $sEnd) = explode('~',$arrLinesString[$i]);
					$arrLinesString = array_merge($arrLinesString ,range((int)$sStart,(int)$sEnd) );
				}
			}
			
			$this->viewViewer->variables ()->set ( 'sLines', implode(',', $arrLinesString) );
		}
		$sClassPath = $this->params->get('path'); 
		$aSourceFile = FileSystem::singleton()->findFile($sClassPath);
		/**
		 * @example /文件/文件内容读取
		 * @forwiki /文件/文件内容读取
		 */
		if($aSourceFile->exists()){
			//新建一个string对象,这里不能使用原生string
			$sSource= new String();
			//$aSourceFile是一个实现IFile接口的对象,openReader方法打开文件数据流,readInString方法把文件内容读出,并把读出的内容填入刚刚建立的string对象$sSource
			$aSourceFile->openReader()->readInString($sSource);
			$this->viewViewer->variables ()->set ( 'sClassPath', $sClassPath );
			$this->viewViewer->variables ()->set ( 'sSource', $sSource );
		}
	}
}