/*
 * fileUpload.js
 * 异步上传图片，文件等
 * 调用方式：
 * 使用直接创建对象的方式:
 * fileUpload.Upload({
            url: '/main/upload/', 
            type: 'post',
            secureuri: false, //一般设置为false
            fileElementId: 'filename', // 上传文件的id、name属性名
            dataType: 'json', //返回值类型，一般设置为json、application/json
            success: function(data){
                if(data){
                    if(data.result == 0){
                        $("#imgshow").html("<img src='"+data.filepath+"'/>");
                    }
                   
                }
            },
            error: function(data, status, e){ 
                console.log(e);
            }
        });
 * 兼容浏览器：
 * Chrom,Firefox,IE8+
*/
var fileUpload = {

	_filetypes:'',
	_allowfilesize:0,

	Filetype:function(filetype_str){
		this._filetypes = $filetype_str;
	},

	Filesize:function(filesizeval){
		this._allowfilesize = filesizeval;
	},

	ErrorDefine:function(errorType){
		var _error = null;
		switch(errorType){
			case 'TYPEERROR':
				_error = this.Error(10001,'文件类型错误，允许上传的文件类型包括：'+this._filetypes);
			break;
			default:
			break;
		}
		return _error;
	},

	Error:function(code,msg){
		return jQuery.parseJSON('{"'+code+'":"'+msg+'"}');
	},

	FilesizeFormat:function(filesize){
		var units = ['B','KB','MB','GB','TB'];
		for(var i = 0;filesize > 1024 && i<=4;i++){
			filesize /= 1024;
		}
		return filesize+units[i];
	},

	/**
	 * 创建上传文件的表单
	*/
	CreateForm:function(id,fileInputId,data){
		var uploadFileId = "LUploadFileID_" + id;
		var uploadFromId = "LUploadFromID_" + id;
		var _fromHTML = "<form action='' method='post' enctype='multipart/form-data' name='LUploadFrom' id='"+uploadFromId+"'>";
		if(data){
			for(var i = 0;i<data.length;i++){
				_fromHTML += "<input type='hidden' value='"+data.value+"' name='"+data.name+"' />";
			}
		}
		_fromHTML += "</form>";
		var oldElement = $('#' + fileInputId); //得到页面中的<input type='file' />对象
        var newElement = $(oldElement).clone(); //克隆页面中的<input type='file' />对象
        $(oldElement).attr('id', uploadFileId); //修改原对象的id
        $(oldElement).before(newElement); //在原对象前插入克隆对象
        var _form = $(_fromHTML);
        $(oldElement).appendTo(_form);
        $('body').append(_form);
        return _fromHTML;
	},

	CreateFram:function(id,uri){
		var _frameId = 'LUploadFrameId_' + id;
		if(window.ActiveXObject){ //IE浏览器
			var io = document.createElement('<iframe id="'+_frameId+'" name="'+_frameId+'" />');
			if(typeof uri == 'boolean'){
				io.src = 'javascript:false';
			}else if(typeof uri == 'string'){
				io.src = uri;
			}
		}else{
			var io = document.createElement('iframe');
			io.id = _frameId;
			io.name = _frameId;
		}
		io.style.position = 'absolute';
		io.style.top = '-1000px';
		io.style.left = '-1000px';
		document.body.appendChild(io);
		return io;
	},

	Upload:function (s){
		var _that = this;
		s = jQuery.extend({},jQuery.ajaxSettings,s);
		var id = s.fileElementId;
		var form = this.CreateForm(id,s.fileElementId);
		var io = this.CreateFram(id,s.secureuri); //s.secureuri 是否安全上传文件

		var frameId = 'LUploadFrameId_' + id;
		var formId = 'LUploadFromID_' + id;
		
		if(s.global && !jQuery.active++){ //jQuery.active 服务器连接数量
			$("body").trigger("ajaxStart"); //强迫注册事件 ajaxStart 并执行
		}

		var  requestDone = false;
		var xml = {};
		if(s.global){
			$("body").trigger('ajaxSend',[xml,s]);
		}

		var uploadCallback = function (isTimeout){
			var io = document.getElementById(frameId);
			try{
				if(io.contentWindow){
					xml.responseText = io.contentWindow.document.body ? io.contentWindow.document.body.innerHTML : null;
					xml.responseXML = io.contentWindow.document.XMLDocument ? io.contentWindow.document.XMLDocument : io.contentWindow.document;
				}else if(io.contentDocument){
					xml.responseText = io.contentDocument.document.body ? io.contentDocument.document.body.innerHTML : null;
					xml.responseXML = io.contentDocument.document.XMLDocument ? io.contentDocument.document.XMLDocument : io.contentDocument.document;
				}
			}catch(e){
				this.handleError(s,xml,null,e);
			}

			if(xml || isTimeout == "timeout"){
				responseDone = true;
				var status;
				try{
					status = isTimeout != 'timeout' ? "success" : "error";
					if(status != "error"){
						var data = _that.uploadHttpData(xml,s.dataType);
						if(s.success){
							s.success(data,status);
						};
						if(s.global){
							$('body').trigger("ajaxSuccess",[xml,s]);
						};
					}else{
						_that.handleError(s,xml,status);
					}
				}catch(e){
					status = "error";
					_that.handleError(s,xml,status,e);
				};

			if(s.global){
				$('body').trigger('ajaxComplete',[xml,s]);
			};

			if(s.global && ! --jQuery.active){
				$('body').trigger("ajaxStop");
			};
			if(s.complete){
				s.complete(xml,status);
			};

			$(io).unbind(); // 解绑onload 方法
			setTimeout(function(){
				try{
					$(io).remove();
					$(form).remove();
				}catch(e){
					_that.handleError(s,xml,null,e);
				}
			},100);
			xml = null;
			};
		}

		if(s.timeout > 0){
			setTimeout(function(){
				if(!requestDone){
					uploadCallback("timeout");
				}
			},s.timeout);
		}
		
		try{
			var form = jQuery('#'+formId);
			jQuery(form).attr('action',s.url);
			jQuery(form).attr('method','POST');
			jQuery(form).attr('target',frameId);
			if(form.encoding){
				form.encoding = "multipart/form-data";
			}else{
				form.encoding = "multipart/form-data";
			}
			jQuery(form).submit();

		}catch(e){
			this.handleError(e,xml,null,e);
		}
		if(window.attachEvent){
			document.getElementById(frameId).attachEvent('onload',uploadCallback);
		}else{
			document.getElementById(frameId).addEventListener('load',uploadCallback,false);
		}
		return {abort:function(){}}
	},

	uploadHttpData: function ( r, type ) {
        var data = !type;
        data = type == "xml" || data ? r.responseXML : r.responseText;
        if( type == "script" )
        {
         jQuery.globalEval( data );
        }
        if( type == "json" )
        {
         eval( "data = " + data );
        }
        if( type == "html" )
        {
         jQuery("<div>").html(data).evalScripts();
        }
        return data;
    },

    handleError: function (s,xml,msg,e){
    	console.log(e);
    }
}
