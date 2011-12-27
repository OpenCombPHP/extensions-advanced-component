<?php 
namespace org\opencomb\advcmpnt ;

use org\opencomb\advcmpnt\lib\LibManager;
use org\jecat\framework\ui\xhtml\parsers\ParserStateTag;
use org\jecat\framework\ui\CompilerManager;
use org\opencomb\platform\ext\Extension ;
use org\jecat\framework\ui\xhtml\UIFactory ;
use org\jecat\framework\mvc\view\UIFactory as MvcUIFactory ;

class AdvancedComponent extends Extension 
{
	/**
	 * 载入扩展
	 */
	public function load()
	{}
	
	/**
	 * 载入扩展
	 */
	public function active()
	{
		$this->registerLibNode() ;
		
		// jquery
		LibManager::singleton()->registerLibrary('jquery','1.7.1','advancedcomponent:jquery-1.7.1.js',null,null,true) ;
		
		// jquery.ui
		LibManager::singleton()->registerLibrary('jquery.ui','1.8.16'
				, 'advancedcomponent:jquery.ui/jquery-ui-1.8.16.full.min.js'
				, 'advancedcomponent:jquery.ui/jquery-ui-1.8.16.full.css'
				, 'jquery', true
		) ;
		
		// jquery.treeview
		LibManager::singleton()->registerLibrary('jquery.treeview','*'
				// js
				, array(
					'advancedcomponent:jquery.treeview/jquery.treeview.js' ,
					'advancedcomponent:jquery.treeview/jquery.treeview.edit.js' ,
					'advancedcomponent:jquery.treeview/jquery.treeview.sortable.js' ,
					//'advancedcomponent:jquery.treeview/jquery.treeview.async.js' ,
				)
				// css
				, array(
					'advancedcomponent:jquery.treeview/jquery.treeview.css' ,
				)
				, array('jquery.ui'), true
		) ;
		
		// jquery.ztree
		LibManager::singleton()->registerLibrary('jquery.ztree','3.0'
				// js
				, array(
						'advancedcomponent:jquery.ztree/jquery.ztree.core-3.0.min.js' ,
						'advancedcomponent:jquery.ztree/jquery.ztree.excheck-3.0.min.js' ,
						'advancedcomponent:jquery.ztree/jquery.ztree.exedit-3.0.min.js' ,
				)
				// css
				, array(
						'advancedcomponent:jquery.ztree/css/zTreeStyle/zTreeStyle.css' ,
				)
				, array('jquery'), true
		) ;

		// jquery.cookie
		LibManager::singleton()->registerLibrary('jquery.cookie','1.7.1'
				// js
				, array(
					'advancedcomponent:jquery.cookie-1.7.1.js' ,
				)
				// css
				, array(
				)
				, array('jquery'), true
		) ;
		
		// jquery.progressbar
		LibManager::singleton()->registerLibrary('jquery.progressbar','*'
				// js
				, array(
					'advancedcomponent:jquery.progressbar.min.js' ,
				)
				// css
				, array(
				)
				, array('jquery'), true
		) ;
		// jquery.beautyofcode
		LibManager::singleton()->registerLibrary('jquery.beautyofcode','0.2'
			// js
			, array(
				'advancedcomponent:jquery.beautyofcode/shCore.js' ,
				'advancedcomponent:jquery.beautyofcode/jquery.beautyOfCode-min.js' ,
				'advancedcomponent:jquery.beautyofcode/shBrushCSharp.js' ,
				'advancedcomponent:jquery.beautyofcode/shBrushJScript.js' ,
				'advancedcomponent:jquery.beautyofcode/shBrushPhp.js' ,
				'advancedcomponent:jquery.beautyofcode/shBrushPlain.js' ,
				'advancedcomponent:jquery.beautyofcode/shBrushSql.js' ,
				'advancedcomponent:jquery.beautyofcode/shBrushXml.js' ,
			)
			// css
			, array(
				'advancedcomponent:jquery.beautyofcode/style/shCore.css' ,
				'advancedcomponent:jquery.beautyofcode/style/shThemeDefault.css' ,
			)
			, array('jquery'), true
		) ;
	}
	
	private function registerLibNode()
	{		
		ParserStateTag::singleton()->addTagNames('lib') ;

		UIFactory::singleton()->compilerManager()->compilerByName('org\\jecat\\framework\\ui\xhtml\\Node')->setSubCompiler('lib',__NAMESPACE__.'\\lib\\LibCompiler') ;
		MvcUIFactory::singleton()->compilerManager()->compilerByName('org\\jecat\\framework\\ui\xhtml\\Node')->setSubCompiler('lib',__NAMESPACE__.'\\lib\\LibCompiler') ;
		
		// 重新计算 ui 的编译策略签名
		UIFactory::singleton()->calculateCompileStrategySignture() ;
		MvcUIFactory::singleton()->calculateCompileStrategySignture() ;
	}
}
