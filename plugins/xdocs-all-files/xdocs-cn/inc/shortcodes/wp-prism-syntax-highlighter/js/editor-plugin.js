/**
 * The MIT License (MIT)
 * 
 * Copyright (c) 2014 TRUCHOT Guillaume
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */


function htmlentities(str, escape) {
	escape = typeof escape !== 'undefined' ? escape : true;
	
	if (escape) {
		return str.replace(/</g, '&lt;').replace(/>/g, '&gt;');
	}
	
	else {
		return str.replace(/&lt;/g, '<').replace(/&gt;/g, '>');
	}
}


(function() {
	tinymce.create('tinymce.plugins.Prism', {
		init : function(ed, url) {
			ed.addCommand('insertCode', function() {
				var selectedNode = ed.selection.getNode();
				var currentReplace = false;
				
				/* The following variables are defined by PHP according to the user settings:
				
				var currentLanguage = "";
				var currentInlineCode = false;
				var currentLineNumbers = false;*/
				
				var currentDataLine = "";
				var currentCode = "";
				var currentDataSrc = "";
				
				var languages = [];
				
				for (var language in Prism.languages) {
					if (typeof Prism.languages[language] === 'object') {
						languages.push({text: language, value: language});
					}
				}
				
				if ( currentLanguage == '' ) {
					currentLanguage = languages[0].value;
				}
				
				
				if (selectedNode.nodeName == 'CODE') {
					var codeNode = selectedNode;
					var preNode = codeNode.parentNode;
					currentReplace = true;
					
					currentLanguage = codeNode.getAttribute('class').replace('language-', '');
					currentCode = htmlentities(codeNode.innerHTML, false);
					
					if (preNode.nodeName == 'PRE') {
						currentInlineCode = false;
						
						if (preNode.getAttribute('class') == 'line-numbers') {
							currentLineNumbers = true;
						}
						
						if (preNode.hasAttribute('data-line')) {
							currentDataLine = preNode.getAttribute('data-line');
						}
						
						if (preNode.hasAttribute('data-src')) {
							currentDataSrc = preNode.getAttribute('data-src');
						}
					}
					
					else {
						currentInlineCode = true;
						currentLineNumbers = false;
					}
				}
				
				
				ed.windowManager.open({
					title: 'WP Prism Syntax Highlighter',
					body: [
						{
							type: 'listbox',
							name: 'language',
							label: 'Language :',
							values: languages,
							value: currentLanguage
						},
						{
							type: 'checkbox',
							name: 'inlineCode',
							label: 'Inline',
							checked: currentInlineCode
						},
						{
							type: 'checkbox',
							name: 'lineNumbers',
							label: 'Line numbers',
							checked: currentLineNumbers
						},
						{
							type: 'textbox',
							name: 'dataLine',
							label: 'Highlight lines :',
							value: currentDataLine
						},
						{
							type: 'textbox',
							name: 'code',
							label: 'Code :',
							multiline: true,
							minWidth: 500,
							minHeight: 500,
							value: currentCode
						},
						{
							type: 'textbox',
							name: 'dataSrc',
							label: 'File :',
							value: currentDataSrc
						},
					],
					
					onsubmit: function(e) {
						var preTag = '<pre';
						
						if (e.data.lineNumbers) {
							preTag += ' class="line-numbers"';
						}
						
						if (e.data.dataLine) {
							preTag += ' data-line="' + e.data.dataLine + '"';
						}
						
						if (e.data.dataSrc) {
							preTag += ' data-src="' + e.data.dataSrc + '"';
						}
						
						preTag += '>';
						
						
						if (currentReplace) {
							ed.dom.remove(selectedNode.parentNode);
						}
						
						ed.insertContent((!e.data.inlineCode ? preTag : '') + '<code' + (!e.data.inlineCode ? ' class="language-' + e.data.language + '"' : '') + '>' + htmlentities(e.data.code) + '</code>' + (e.data.inlineCode ? ' ' : '') + (!e.data.inlineCode ? '</pre><br />' : ''));
						ed.selection.setCursorLocation(ed.selection.getNode().firstChild); // Select <code> instead of <pre> (or <code> instead of <p> if <pre> doesn't exist)
					}
				});
			});
			
			ed.addButton('prism', {
				text: 'Prism',
				title: 'Insert code',
				cmd: 'insertCode'
			});
			
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('prism', n.nodeName == 'PRE' || n.nodeName == 'CODE');
			});
		},
		
		getInfo : function() {
			return {
				longname : 'WP Prism Syntax Highlighter',
				author : 'Lea Verou (Prism), Truchot Guillaume (WordPress Plugin)',
				authorurl : 'https://github.com/GuiTeK',
				infourl : 'https://github.com/GuiTeK/wp-prism-syntax-highlighter',
				version : '1.0.5'
			};
		}
	});
	
	tinymce.PluginManager.add('prism', tinymce.plugins.Prism);
})();
