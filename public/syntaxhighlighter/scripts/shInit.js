jQuery(function(){
	/*
	 * 指定高亮语种:
	 * 		brush: plain;
	 * 高亮html,php ,css,js的混合编码 :
	 * 		html-script: true
	 * 高亮单行(重点突出):
	 * 		highlight : (行号)
	 * 开始行号:
	 * 		first-line: (行号)
	 * 
	 * 格式如下:
	 * <pre class="brush: js; ruler: true; first-line: 10; highlight: [2, 4, 6]">...</pre>
	 */
	function path()
	{
	  var args = arguments,
	      result = []
	      ;
	       
	  for(var i = 0; i < args.length; i++)
	      result.push(args[i].replace('@', '/extensions/advanced-component/0.1/public/syntaxhighlighter/scripts/'));
	       
	  return result
	};
	 
	SyntaxHighlighter.autoloader.apply(null, path(
	  'applescript            @shBrushAppleScript.js',
	  'actionscript3 as3      @shBrushAS3.js',
	  'bash shell             @shBrushBash.js',
	  'coldfusion cf          @shBrushColdFusion.js',
	  'cpp c                  @shBrushCpp.js',
	  'c# c-sharp csharp      @shBrushCSharp.js',
	  'css                    @shBrushCss.js',
	  'delphi pascal          @shBrushDelphi.js',
	  'diff patch pas         @shBrushDiff.js',
	  'erl erlang             @shBrushErlang.js',
	  'groovy                 @shBrushGroovy.js',
	  'java                   @shBrushJava.js',
	  'jfx javafx             @shBrushJavaFX.js',
	  'js jscript javascript  @shBrushJScript.js',
	  'perl pl                @shBrushPerl.js',
	  'php                    @shBrushPhp.js',
	  'text plain             @shBrushPlain.js',
	  'py python              @shBrushPython.js',
	  'ruby rails ror rb      @shBrushRuby.js',
	  'sass scss              @shBrushSass.js',
	  'scala                  @shBrushScala.js',
	  'sql                    @shBrushSql.js',
	  'vb vbnet               @shBrushVb.js'
	));
	SyntaxHighlighter.defaults['toolbar'] = false;
	SyntaxHighlighter.all();
});