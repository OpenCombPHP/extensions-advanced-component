<?php
namespace org\opencomb\advcmpnt\lib ;

use org\jecat\framework\lang\Exception;
use org\jecat\framework\lang\Type;
use org\jecat\framework\ui\TargetCodeOutputStream;
use org\jecat\framework\ui\CompilerManager;
use org\jecat\framework\ui\IObject;
use org\jecat\framework\ui\xhtml\compiler\NodeCompiler;

class LibCompiler extends NodeCompiler
{
	public function compile(IObject $aObject,TargetCodeOutputStream $aDev,CompilerManager $aCompilerManager)
	{
		Type::check ( "org\\jecat\\framework\\ui\\xhtml\\Node", $aObject );
	
		if( !$sLibName = $aObject->attributes()->string('name') )
		{
			throw new Exception("lib 标签缺少 name 树形") ;
		}
		
		foreach(LibManager::singleton()->libraryFileIterator('js','jquery.treeview') as $sFile)
		{
			$sFile = addslashes($sFile) ;
			$aDev->write("\\org\\jecat\\framework\\resrc\\HtmlResourcePool::singleton()->addRequire(\"{$sFile}\",\\org\\jecat\\framework\\resrc\\HtmlResourcePool::RESRC_JS) ;") ;
		}
		foreach(LibManager::singleton()->libraryFileIterator('css','jquery.treeview') as $sFile)
		{
			$sFile = addslashes($sFile) ;
			$aDev->write("\\org\\jecat\\framework\\resrc\\HtmlResourcePool::singleton()->addRequire(\"{$sFile}\",\\org\\jecat\\framework\\resrc\\HtmlResourcePool::RESRC_CSS) ;") ;
		}
		
	}
}

?>