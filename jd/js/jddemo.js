$(function(){
			$('#carousel1').carousel({
				el : {
					imgsContainer	: '.carousel', // 图片容器
					prevBtn 		: '.carousel-prev', // 上翻按钮
					nextBtn 		: '.carousel-next', // 下翻按钮
					indexContainer	: '.carousel-index', // 下标容器
				},conf : {
					auto			: true, //是否自动播放 true/false 默认:true
					needIndexNum	: true, //是否需要下标数字 true/false 默认:true
					animateTiming	: 1000, //动画时长(毫秒) 默认:1000
					autoTiming		: 3000, //自动播放间隔时间(毫秒) 默认:3000
					direction 		: 'right', //自动播放方向 left/right 默认:right
				}
			});

			/*以下代码按照需要添加/修改*/
			$(".carousel-prev").hover(function(){
				$(this).find("img").attr("src","./images/icons/left_btn2.png");
			},function(){
				$(this).find("img").attr("src","./images/icons/left_btn1.png");
			});
			$(".carousel-next").hover(function(){
				$(this).find("img").attr("src","./images/icons/right_btn2.png");
			},function(){
				$(this).find("img").attr("src","./images/icons/right_btn1.png");
			});

			$("#carousel3").find('.carousel-prev,.carousel-next,.carousel-index').hide();
			$("#carousel3").hover(function(){
				$(this).find(".carousel-prev,.carousel-next,.carousel-index").stop().fadeIn(300);
			},function(){
				$(this).find(".carousel-prev,.carousel-next,.carousel-index").stop().fadeOut(300);
			});


            $("#service_pop").hover(
			function(){
			alert("sss");
			});//为了鼠标可以进入下拉框
			$("#service_pop").hover(function() {
				$(this).show();//鼠标进入下拉框
			}, function() {
				$(this).hide();//鼠标离开下拉框后，就会消失
			});





		});