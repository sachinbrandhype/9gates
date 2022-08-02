(function($){
	var Dialog = function(option){
		// é…�ç½®é€‰é¡¹
		this.defaultOpts = {
			'title':'Dialog Title',
			'content':'Dialog Content',
			'ctnWrapClass':'elastic-pupop-payrs',
			'beforeRenderFunc':function(thisTemp){},
			'afterRenderFunc':function(thisTemp){
				thisTemp.htmlJqObj.find('.js-yes-btn').off('click').on('click', function () {
					thisTemp.close();
				});
				
				thisTemp.htmlJqObj.find('.js-cancle-btn').off('click').on('click', function () {
					thisTemp.close();
				});
			},
			'ctxSelect':'body',
			'trigger':null
		};
		this.options = {};
		this.htmlJqObj = null;
		// é…�ç½®é€‰é¡¹
		this.initOpts = function(options){
			this.options = $.extend({},this.defaultOpts,options);	
		};
		// æ˜¾ç¤ºå¯¹è¯�æ¡†
		this.show = function(options){
			var thisTemp = this;
			thisTemp.initOpts(options);
			var html = '<div class="elastic-layer" style="display:block;">'+
						    '<p class="elastic-mask"></p>'+
						    '<div class="elastic-pupop '+thisTemp.options['ctnWrapClass']+'">'+
						        '<div class="elastic-con">'+
						        thisTemp.options['content'] +
						        '</div>'+
						    '</div>'+
						'</div>';
			thisTemp.htmlJqObj = $(html);
			thisTemp.htmlJqObj.find('.js-close').off('click').on('click', function () {
				thisTemp.close();
			});
			thisTemp.options.beforeRenderFunc(thisTemp); //!!
			thisTemp.htmlJqObj.appendTo(thisTemp.options['ctxSelect']);
			thisTemp.options.afterRenderFunc(thisTemp); //!!
			return thisTemp;
		};
		// å…³é—­å¯¹è¯�æ¡†
		this.close = function(){
			thisTemp = this;
			thisTemp.htmlJqObj.fadeOut('normal',function(){
				thisTemp.htmlJqObj.remove();
			});
		}
		
		// å»¶è¿Ÿå…³é—­
		this.delayClose = function(seconds,callback){
			seconds = parseInt(seconds);
			var thisTemp = this;
			var callbackTemp = callback;
			var delayCloseSeconds = seconds;
			var setTimeoutHandler = null;
			var setTimeoutFunc = function(){
				if(delayCloseSeconds > 0){
					thisTemp.htmlJqObj.find('.form-list .delay-close-clock').remove();
					
					clearTimeout(setTimeoutHandler);
					setTimeoutHandler = setTimeout(setTimeoutFunc,1000);
					delayCloseSeconds = delayCloseSeconds - 1;
				}
				else{
					clearTimeout(setTimeoutHandler);
					if((typeof callbackTemp)=='function'){
						if(callbackTemp(thisTemp)){
							thisTemp.close();
						}
					}
					else{
						thisTemp.close();
					}
				}
			};
			setTimeoutFunc();
		}
		this.initOpts(option);
	}
	
	jQuery.extend({
		  //å¯¹è¯�æ¡†
		  dialogx: function(opts) {
			    var dialog = new Dialog();
				dialog.show(opts);
				return dialog;
		  },
		  //æ��ç¤ºå¼¹å‡º
		  alertx: function(title,msg) {
				if(typeof msg=='undefined'){
					 msg = title;
				}
				var dialog = new Dialog();
				dialog.show({
					'title':title,
					'content':'<div class="form-list"><br><p class="center">'+msg+'</p><br><br><div class="center"><a class="btn btn-blue js-yes-btn" href="javascript:void(0);">Okey</a></div><br /></div>',
					'ctnWrapClass':'elastic-pupop-sl'
				});
				return dialog;
		  },
		  //ç¡®è®¤æ¡†
		  confirmx: function(title,msg,yesCallback,cancleCallback) {
			  var dialog = new Dialog();
			  var options = {
				  'title':title,
				  'content':'<div class="form-list"><p class="centercancel">'+msg+'</p></div>',
				  'ctnWrapClass':'elastic-pupop-sl'
			  };
			  if(((typeof yesCallback)=='function')&&
				  (typeof cancleCallback)=='function'){
				  options['afterRenderFunc'] = function(thisTemp){
					  	dialog.htmlJqObj.find('.js-yes-btn').click( function () {
					  		if(yesCallback(dialog)){
								dialog.close(); 
							}
						});
						thisTemp.htmlJqObj.find('.js-cancle-btn').click( function () {
							if(cancleCallback(dialog)){
								dialog.close(); 
							}
						});
					};
			  }
			  else if((typeof yesCallback)=='function'){
				  options['afterRenderFunc'] = function(thisTemp){
					    dialog.htmlJqObj.find('.js-yes-btn').click( function () {
							if(yesCallback(dialog)){
								dialog.close(); 
							}
						});
					    dialog.htmlJqObj.find('.js-cancle-btn').click( function () {
					    	dialog.close();
						});
					};
			  }
			  else if((typeof cancleCallback)=='function'){
				  options['afterRenderFunc'] = function(thisTemp){
					  dialog.htmlJqObj.find('.js-yes-btn').click( function () {
						  dialog.close();
					  });
					  dialog.htmlJqObj.find('.js-cancle-btn').click( function () {
						  if(cancleCallback(dialog)){
							  dialog.close(); 
						  }
					  });
				  };
			  }
			  dialog.show(options);
			  return dialog;
		  },
		  //é”™è¯¯å¼¹å‡º
		  errorAlertx: function(title,msg) {
			  if(typeof msg=='undefined'){
				  msg = title;
			  }
			  var dialog = new Dialog();
			  dialog.show({
				  'title':title,
				  'content':'<div class="form-list"><br><p class="elastic-tips center">'+msg+'</p><br><div class="center"><a class="btn btn-blue js-yes-btn" href="javascript:void(0);">Okey</a></div><br /></div>',
				  'ctnWrapClass':'elastic-pupop-sl'
			  });
			  return dialog;
		  },
	});
	
	jQuery.fn.extend({
		  bindDialogx: function(type,opts) {
		    return this.each(function(type,opts){
				$(this).bind(type, function(){
					opts['trigger'] = this;
					var dialog = new Dialog();
					dialog.show(opts);
				});
		    });
		  },
		  delegateDialogx: function(selector,type,opts) {
			  return this.each(function(type,opts){
				  $(this).delegate(selector,type,function(){
					  opts['trigger'] = this;
					  var dialog = new Dialog();
					  dialog.show(opts);
				  });
			  });
		  },
	});
})(jQuery);