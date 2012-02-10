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
		
		if(!$sSourceClass = $this->params['sclass']){
			$this->messageQueue ()->create ( Message::error, "无法定位到指定代码,缺少信息" );
		}
		if(!$sSourcePackageNamespace = $this->params['spnamespace']){
			$this->messageQueue ()->create ( Message::error, "无法定位到指定代码,缺少信息" );
		}
		if(!$sExtension = $this->params['extension']){
			$this->messageQueue ()->create ( Message::error, "无法定位到指定代码,缺少信息" );
		}
		if($this->params->has('hline')){
			$this->viewViewer->variables ()->set ( 'sLines', str_replace('_', ',', $this->params->get('hline')) );
		}
		foreach(Extension::flyweight($sExtension)->metainfo()->packageIterator() as $arrPackage){
			list($sNamespace,$sPackagePath) = $arrPackage ;
			if($sNamespace == $sSourcePackageNamespace){
				$sClassPath = Extension::flyweight($sExtension)->metainfo()->installPath().$sPackagePath . str_replace( '\\','/', substr($sSourceClass , strLen($sSourcePackageNamespace)) ).'.php';
				$aSourceFile = FileSystem::singleton()->findFile($sClassPath);
				break;
			}
		}
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