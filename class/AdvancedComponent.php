<?php 
namespace org\opencomb\advcmpnt ;

use org\opencomb\advcmpnt\lib\LibManager;
use org\jecat\framework\ui\xhtml\parsers\ParserStateTag;
use org\jecat\framework\ui\CompilerManager;
use org\opencomb\ext\Extension ;
use org\jecat\framework\ui\xhtml\UIFactory ;
use org\jecat\framework\mvc\view\UIFactory as MvcUIFactory ;

class AdvancedComponent extends Extension 
{
	/**
	 * 载入扩展
	 */
	public function load()
	{
		$this->registerLibNode() ;
	}
	
	/**
	 * 载入扩展
	 */
	public function active()
	{
		// jquery
		LibManager::singleton()->registerLibrary('jquery','1.7.1','advancedcomponent:jquery-1.7.1.js',null,null,true) ;
		
		// jquery.treeview
		LibManager::singleton()->registerLibrary('jquery.treeview','1.7.1'
				// js
				, array(
					'advancedcomponent:jquery.treeview/jquery.treeview.js' ,
					'advancedcomponent:jquery.treeview/jquery.treeview.edit.js' ,
					'advancedcomponent:jquery.treeview/jquery.treeview.sortable.js' ,
					'advancedcomponent:jquery.treeview/jquery.treeview.async.js' ,
				)
				// css
				, array(
					'advancedcomponent:jquery.treeview/jquery.treeview.async.js' ,
				)
				, 'jquery', true
		) ;
	}
	
	private function registerLibNode()
	{
		ParserStateTag::singleton()->addTagNames('lib') ;
		
		UIFactory::singleton()->compilerManager()->compilerByName('org\\jecat\\framework\\ui\xhtml\\Node')->setSubCompiler('lib',__NAMESPACE__.'\\lib\\LibCompiler') ;
		MvcUIFactory::singleton()->compilerManager()->compilerByName('org\\jecat\\framework\\ui\xhtml\\Node')->setSubCompiler('lib',__NAMESPACE__.'\\lib\\LibCompiler') ;
	}
}