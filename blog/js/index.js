$(document).ready(function(){
	$('#musi-pos').bind({
		mouseenter:function(){
			$('#musi').show();
		},
		mouseleave:function(){
			$('#musi').hide();
		}
	});

	var popWin = new popWindow();
	console.log(popWin);
	$("#alertSpan").on('click',function(){
		popWin.alert('自定义Alert插件');
	});
	$("#confirmSpan").on('click',function(){
		popWin.confirm('自定义Confirm插件',function(flag){
			if(flag){
				popWin.alert("TRUE");
			}else{
				popWin.alert("FALSE");
			}
		});
	});
	//
	$('#windowShow').on('click',function(){
		popWinPage.show('/main/editArtGroup');
	});
	//上传文件

	$("#uploadBtn").on('click',function(){
		// 开始上传文件时显示一个图片
        // $("#wait_loading").ajaxStart(function() {
        //     $(this).show();
        // // 文件上传完成将图片隐藏起来
        // }).ajaxComplete(function() {
        //     $(this).hide();
        // });
        // var elementIds=["flag"]; //flag为id、name属性名
        // $.ajaxFileUpload({
        //     url: '/main/upload/', 
        //     type: 'post',
        //     secureuri: false, //一般设置为false
        //     fileElementId: 'filename', // 上传文件的id、name属性名
        //     dataType: 'text', //返回值类型，一般设置为json、application/json
        //     elementIds: elementIds, //传递参数到服务器
        //     success: function(data, status){  
        //         console.log(data);
        //     },
        //     error: function(data, status, e){ 
        //         console.log(e);
        //     }
        // });
		$("body").ajaxStart(function() {
            //console.log("come in ajaxStart");
        }).ajaxSend(function(){
        	//console.log("come in ajaxSend");
        }).ajaxComplete(function() {
            //console.log("come in ajaxComplete");
        }).ajaxStop(function(){
        	//console.log("come in ajaxStop");
        });
		fileUpload.Upload({
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
	// var _error = fileUpload.ErrorDefine('TYPEERROR');
	// fileUpload.CreateForm('file','filename');
	// fileUpload.CreateFram('fileId');
	})
});