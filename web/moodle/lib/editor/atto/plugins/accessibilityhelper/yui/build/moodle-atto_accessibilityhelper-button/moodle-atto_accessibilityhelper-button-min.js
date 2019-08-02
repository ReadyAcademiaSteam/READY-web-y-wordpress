YUI.add("moodle-atto_accessibilityhelper-button",function(e,t){var n="atto_accessibilityhelper",r='<div><p id="{{elementid}}_{{CSS.STYLESLABEL}}">{{get_string "liststyles" component}}<br/><span aria-labelledby="{{elementid}}_{{CSS.STYLESLABEL}}" /></p></div><span class="listStyles"></span><p id="{{elementid}}_{{CSS.LINKSLABEL}}">{{get_string "listlinks" component}}<br/><span aria-labelledby="{{elementid}}_{{CSS.LINKSLABEL}}"/></p><span class="listLinks"></span><p id="{{elementid}}_{{CSS.IMAGESLABEL}}">{{get_string "listimages" component}}<br/><span aria-labelledby="{{elementid}}_{{CSS.IMAGESLABEL}}"/></p><span class="listImages"></span>',i={STYLESLABEL:n+"_styleslabel",LINKSLABEL:n+"_linkslabel",IMAGESLABEL:n+"_imageslabel"};e.namespace("M.atto_accessibilityhelper").Button=e.Base.create("button",e.M.editor_atto.EditorPlugin,[],{initializer:function(){this.addButton({icon:"e/screenreader_helper",callback:this._displayDialogue})},_displayDialogue:function(){var e=this.getDialogue({headerContent:M.util.get_string("pluginname",n),width:"800px",focusAfterHide:!0});e.set("bodyContent",this._getDialogueContent()).show()},_getDialogueContent:function(){var t=e.Handlebars.compile(r),s=e.Node.create(t({CSS:i,component:n}));return s.one(".listStyles").empty().appendChild(this._listStyles()),s.one(".listLinks").empty().appendChild(this._listLinks()),s.one(".listImages").empty().appendChild(this._listImages()),s},_listStyles:function(){var t=[],r=this.get("host"),i=r.getSelectionParentNode(),s;i&&(i=e.one(i));while(i&&i!==this.editor)s=i.get("tagName"),typeof s!="undefined"&&t.push(e.Escape.html(s)),i=i.ancestor();return t.length===0&&t.push(M.util.get_string("nostyles",n)),t.reverse(),t.join(", ")},_listLinks:function(){var t=e.Node.create("<ol />"),r,i;return this.editor.all("a").each(function(s){i=e.Node.create('<a href="#" title="'+M.util.get_string("selectlink",n)+'">'+e.Escape.html(s.get("text"))+"</a>"),i.setData("sourcelink",s),i.on("click",this._linkSelected,this),r=e.Node.create("<li></li>"),r.appendChild(i),t.appendChild(r)},this),t.hasChildNodes()||t.append("<li>"+M.util.get_string("nolinks",n)+"</li>"),t},_listImages:function(){var t=e.Node.create("<ol/>"),r,i;return this.editor.all("img").each(function(s){var o=s.getAttribute("alt");o===""&&(o=s.getAttribute("title"),o===""&&(o=s.getAttribute("src"))),i=e.Node.create('<a href="#" title="'+M.util.get_string("selectimage",n)+'">'+e.Escape.html(o)+"</a>"),i.setData("sourceimage",s),i.on("click",this._imageSelected,this),r=e.Node.create("<li></li>"),r.append(i),t.append(r)},this),t.hasChildNodes()||t.append("<li>"+M.util.get_string("noimages",n)+"</li>"),t},_imageSelected:function(e){e.preventDefault(),this.getDialogue({focusAfterNode:null}).hide();var t=this.get("host"),n=e.target.getData("sourceimage");this.editor.focus(),t.setSelection(t.getSelectionFromNode(n))},_linkSelected:function(e){e.preventDefault(),this.getDialogue({focusAfterNode:null}).hide();var t=this.get("host"),n=e.target.getData("sourcelink");this.editor.focus(),t.setSelection(t.getSelectionFromNode(n))}})},"@VERSION@",{requires:["moodle-editor_atto-plugin"]});
