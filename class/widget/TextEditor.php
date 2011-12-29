<?php
namespace org\opencomb\advcmpnt\widget;

use org\jecat\framework\mvc\view\widget\FormWidget;
use org\jecat\framework\mvc\view\widget\Text;

class TextEditor extends Text
{
	public function __construct($sId = null, $sTitle = null, $sValue = null, $sConfiguration , IView $aView = null)
	{
		$this->setType(self::multiple);
		$this->setValue ( $sValue );
		$this->setConfiguration($sConfiguration);
		FormWidget::__construct ( $sId, 'advcmpnt:TextEditor.template.html', $sTitle, $aView );
	}
	
	public function buildBean(array & $arrConfig,$sNamespace='*',\org\jecat\framework\bean\BeanFactory $aBeanFactory=null)
	{
		parent::buildBean ( $arrConfig,$sNamespace);
		
		if (array_key_exists ( 'configuration', $arrConfig ))
		{
			$this->setConfiguration($arrConfig ['configuration']);
		}
	}
	
	//帮助模板判断是否应该输出ckeditor的toolbar的配置信息
	public function hasSpecifiedConfiguration(){
		return !empty($this->configuration());
	}
	
	public function configuration(){
		return $this->sConfiguration;
	}
	
	public function setConfiguration($sConfiguration){
		$this->sConfiguration = $sConfiguration;
	}
	
	private $sConfiguration = null;
}