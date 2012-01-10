<?php 
namespace org\opencomb\advcmpnt ;

use org\opencomb\platform\system\PlatformSerializer;

use org\jecat\framework\bean\BeanFactory;
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
	{
		//添加扩展提供的控件
		BeanFactory::singleton()->registerBeanClass("org\\opencomb\\advcmpnt\\widget\\RichText",'richText') ;
	
		
		/////////////////////////////////////////////////////////////////////////
		// 注册前端库

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
						'advancedcomponent:jquery.ztree/jquery.ztree.all-3.0.min.js' ,
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
		// syntaxhighlighter
		LibManager::singleton()->registerLibrary('syntaxhighlighter','3.0.83'
			// js
			, array(
				'advancedcomponent:syntaxhighlighter/scripts/shCore.js' ,
 				'advancedcomponent:syntaxhighlighter/scripts/shBrushJScript.js' ,
// 				'advancedcomponent:syntaxhighlighter/scripts/shAutoloader.js' ,
// 				'advancedcomponent:syntaxhighlighter/scripts/shBrushXml.js' ,
// 				'advancedcomponent:syntaxhighlighter/scripts/shInit.js' ,
			)
			// css
			, array(
				'advancedcomponent:syntaxhighlighter/styles/shCoreDefault.css' ,
			)
			, null , true
		) ;
		// syntaxhighlighter:js
		LibManager::singleton()->registerLibrary('syntaxhighlighter:js','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushJScript.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:css
		LibManager::singleton()->registerLibrary('syntaxhighlighter:css','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushCss.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:cpp
		LibManager::singleton()->registerLibrary('syntaxhighlighter:cpp','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushCpp.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:as3
		LibManager::singleton()->registerLibrary('syntaxhighlighter:as3','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushAS3.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:bash
		LibManager::singleton()->registerLibrary('syntaxhighlighter:bash','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushBash.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:delphi
		LibManager::singleton()->registerLibrary('syntaxhighlighter:delphi','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushDelphi.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:groovy
		LibManager::singleton()->registerLibrary('syntaxhighlighter:groovy','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushGroovy.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:java
		LibManager::singleton()->registerLibrary('syntaxhighlighter:java','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushJava.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:perl
		LibManager::singleton()->registerLibrary('syntaxhighlighter:perl','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushPerl.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:php
		LibManager::singleton()->registerLibrary('syntaxhighlighter:php','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushPhp.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:python
		LibManager::singleton()->registerLibrary('syntaxhighlighter:python','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushPython.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:ruby
		LibManager::singleton()->registerLibrary('syntaxhighlighter:ruby','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushRuby.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:scala
		LibManager::singleton()->registerLibrary('syntaxhighlighter:scala','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushScala.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:sql
		LibManager::singleton()->registerLibrary('syntaxhighlighter:sql','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushSql.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:xml
		LibManager::singleton()->registerLibrary('syntaxhighlighter:xml','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushXml.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		// syntaxhighlighter:vb
		LibManager::singleton()->registerLibrary('syntaxhighlighter:vb','3.0.83'
				// js
				, array('advancedcomponent:syntaxhighlighter/scripts/shBrushVb.js' )
				, array()
				, 'syntaxhighlighter' , true
		) ;
		
		// ckeditor
		LibManager::singleton()->registerLibrary('ckeditor','3.6.2'
				// js
				, array('advancedcomponent:ckeditor/ckeditor.js' )
				, array()
				, null , true
		) ;
		// jquery.threedots
		LibManager::singleton()->registerLibrary('jquery.threedots','1.0.10'
				// js
				, array('advancedcomponent:jquery.threedots/jquery.ThreeDots.min.js' )
				, array()
				, 'jquery' , true
		) ;
		
		// --------------------------
		// 提供给系统序列化
		PlatformSerializer::singleton()->addSystemObject(LibManager::singleton()) ;
	}
	
	public function active()
	{
		$this->registerLibNode() ;
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
