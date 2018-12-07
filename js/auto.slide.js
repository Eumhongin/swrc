/*
* http://wincop.net
* Copyright © 2013 hwang jin woo
* All rights reserved.
*
*/
var slide = {
	LRN : 0
	,SZ : []
	,LN : 0
	,IMN : 0
	,zOimgW : 150
	,zOimgH : 200
	,zoomInper : 0
	,zIimgW : 0
	,zIimgH : 0
	,LP : 0
	,ISS : []
	,SDL : 0
	,WOLS : 0
	,No : 0
	,ZNo : 0
	,Offset : 0
	,ID : null
	,W : null
	,WO : null
	,WL : null
	,WOL : null
	,isSlide : true
	,NI : []
	,easing : ''
	,aniTime : 0
	,isAuto : false
	,isAutoOver : true
	,autoPlayType : ''
	,autoTime : 0
	,zInNum : 0
	,autoObj : null
	,ended : null
	,load : function (params) {
		try{
			if (typeof params!='object') {
				throw '초기화 값을 넣어주세요!';
			}
			if (!params.id||params.id=='undefined') {
				throw '아이디는 필수입니다.';
			}
			if (!params.view_num||params.view_num=='undefined'||/[0-9]/gi.test(params.view_num)===false) {
				throw '보여줄 슬라이드개수를 지정해주세요!';
			}
			this.ID=params.id;
			this.LRN=params.view_num;
			this.zoomInper = params.zoom_size>0?params.zoom_size:100;
			this.W = $('#'+this.ID);
			this.WO = this.W.find('ul');
			this.WOL = this.WO.find('li');
			this.aniTime = params.ani_time>0?params.ani_time:500;
			this.SZ[0] = params.image_size[0];
			this.SZ[1] = params.image_size[1];
			this.IMN = params.image_margin>0?params.image_margin:0;
			this.zInNum = params.zoom_in_num;
			if (params.easing)
			this.easing = params.easing;
			if (params.auto_slide==true) {
				this.isAuto=true;
				this.autoTime = params.auto_time>0?params.auto_time:1000;
				this.autoPlayType = params.auto_play_type=='prev'?'prev':'next';
			}
			this.ended=params.ended;
		}catch(e){
			alert(e);
			return;
		}
		this.WOL.each(function(n) {
			var imgs = $(this);
			if (n==0) {
				slide.zOimgW = slide.SZ[0];
				slide.zOimgH = slide.SZ[1];
				slide.zIimgW = slide.zOimgW * slide.zoomInper / 100;
				slide.zIimgH = slide.zOimgH * slide.zoomInper / 100;
				slide.W.css({'height':slide.zIimgH});
				slide.WO.css({'margin-top':((slide.W.height() - slide.zIimgH)/2)+'px'});
			}
			img = new Image();
			img.onload = function() {
			var cHeight = 0;
			var cWidth = 0;
				if (this.width > slide.zOimgW) {
					cWidth = slide.zOimgW;
					cHeight = Math.ceil((this.height*(cWidth/this.width)));
				}
				if (cHeight > slide.zOimgH) {
					cHeight = slide.zOimgH;
					cWidth = Math.ceil(this.width*cHeight/this.height);
				}
				this.width = (cWidth * slide.zoomInper) / 100;
				this.height = (cHeight * slide.zoomInper) / 100;
				var omt = Math.floor((slide.zIimgH - cHeight)/2);
				var oms = (slide.zOimgW - cWidth)/2;
				var imt = 0;
				var ims = (slide.zIimgW - this.width)/2;
				if (this.height <= cHeight) {
					cmt = 0;
					imt = Math.floor((cHeight - slide.zIimgH)/2);
				}
				slide.ISS[n] = {'ow':cWidth,'oh':cHeight
					,'iw':this.width, 'ih':this.height
					,'oms':oms,'omt':omt
				,'ims':ims,'imt':imt};
				imgs.find('img').css({'width':cWidth, 'height':cHeight
					,'margin-left':oms + 'px'
				,'margin-right':oms + 'px'});
				imgs.css({'margin-top': omt + 'px'});
				imgs.find('img').mouseover(function(){
					if (slide.autoObj) {
						window.clearTimeout(slide.autoObj);
						slide.autoObj=null;
					}
					slide.isAutoOver=false;
				}).mouseout(function(){slide.isAutoOver=true;slide.autoPlay();});
					slide.LN++;
					if (slide.LN==slide.WOL.length) {
						slide.init();
					}
				};
				img.src = imgs.find('img').attr('src');
			});
			$('.__const_prev>img').each(function(){
				slide.NI['prevoff'] = this.src;
				slide.NI['prevon'] = this.getAttribute('on');
				this.style.cursor = 'pointer';
				this.removeAttribute('on');
			});
			$('.__const_next>img').each(function(){
				slide.NI['nextoff'] = this.src;
				slide.NI['nexton'] = this.getAttribute('on');
				this.style.cursor = 'pointer';
				this.removeAttribute('on');
			});
		},init :  function () {
			this.isLen = this.LN >= this.LRN;
			if (this.isLen) {
				this.Offset = Math.floor(this.LRN/2);
				html = this.WO.html();
				for (var i=0,len=this.ISS.length; i < len;i++){
					this.ISS[slide.LN+i]=this.ISS[i];
					this.ISS[(slide.LN*2)+i]=this.ISS[i];
				}
				this.WO.prepend(html);
				this.WO.append(html);
				this.No = this.LN;
			} else {
				this.Offset = Math.floor(this.LN/2);
			}
			if (this.zInNum&&this.zInNum<=slide.LN&&this.zInNum<=this.LRN&&this.zInNum>0) {
				this.Offset = --this.zInNum;
			}
			this.WL = this.WO.find('li');
			this.SDL = this.WL.length;
			this.WOLS = (this.WOL.length*this.zOimgW)+(this.WOL.length*this.IMN);
			this.WO.css({ 'width': Math.floor((this.SDL*this.zOimgW)+(this.SDL*this.IMN)+this.zIimgW)+'px'
				,'height':this.zIimgH
			,'display':'block' });
			this.W.css({width:Math.floor(((this.LRN*this.zOimgW)+(this.LRN*this.IMN)+(slide.zIimgW-slide.zOimgW))),'display':'block'});
			if (this.isLen) {
				this.reset(this.No);
			} else {
				this.WO.css({ 'left': (this.W.width()-(this.WO.width()-this.zIimgW+(slide.zIimgW-slide.zOimgW)))/2, 'display': 'block' });
				this.on(this.No);
			}
			if (this.isLen) {
				this.setChgNavi('next', 'on');
			}
			if (this.SDL > 1) {
				this.setChgNavi('prev', 'on');
			}
			this.autoPlay();
		},navi : function (mode) {
			if (!this.isSlide||!this.isAutoOver) {
				return;
			}
			this.isSlide = false;
			if (mode == 'next') {
				if (!this.isLen) {
					this.isSlide = true;
					if ((this.No + this.SDL) >= this.SDL) {
						return;
					}
					if (this.No + this.LRN >= this.SDL) {
						this.setChgNavi('next', 'off');
					}
				}
				this.setChgNavi('prev', 'on');
				this.off(this.No);
				this.on(++this.No);
				if (this.isLen) {
					this.LP = '-'+(this.zOimgW+this.IMN)*this.No;
				this.WO.stop().animate({ 'left': this.LP + 'px' }, { duration: slide.aniTime, complete: function () {
					if (slide.isLen && (slide.No==slide.SDL-slide.WOL.length)) {
						slide.reset(slide.WOL.length);
						slide.resetOff(slide.No);
						slide.No = slide.WOL.length;
					}
					slide.autoPlay();
					slide.isSlide = true;
				}
			});
		}
	} else {
		if (!this.isLen) {
			this.isSlide = true;
			if (this.SDL<=1||this.No < 0) {
				return;
			}
			if (this.No - 1 < 0) {
				this.setChgNavi('prev', 'off');
			}
		}
		this.setChgNavi('next', 'on');
		this.off(this.No);
		this.on(--this.No);
		if (this.isLen) {
			if (this.isLen && this.No < 0) {
				this.LP = (this.zOimgW+this.IMN);
			} else {
				this.LP = '-'+(this.zOimgW + this.IMN)*this.No;
			}
		this.WO.stop().animate({ 'left': this.LP + 'px' }, { duration: slide.aniTime, complete: function () {
			if (slide.isLen && (slide.No==0)) {
				slide.resetOff(slide.No);
				slide.reset(slide.WOL.length);
				slide.No = slide.WOL.length;
			}
			slide.autoPlay();
			slide.isSlide = true;
		}
	});
}
}
},autoPlay : function() {
	this.ended();
	if (slide.isAuto) {
		if (slide.autoObj) {
			window.clearTimeout(slide.autoObj);
			slide.autoObj=null;
		}
		slide.autoObj=window.setTimeout("slide.navi('"+slide.autoPlayType+"')",slide.aniTime+slide.autoTime);
	}
},update : function(n) {
	n=this.Offset+n;
	this.item = this.WL.eq(n);
	return n;
},reset: function (n) {
	n=this.update(n);
	this.WO.css({ 'left': '-'+this.WOLS+'px','display':'block' });
	this.item.stop().css({ 'margin-top': this.ISS[n].imt});
	this.item.stop().find('img').css({ width: this.ISS[n].iw, height : this.ISS[n].ih
		,'margin-left':this.ISS[n].ims
	,'margin-right':this.ISS[n].ims});
},resetOff: function (n) {
	n=this.update(n);
	this.item.stop().css({ 'margin-top': this.ISS[n].omt});
	this.item.stop().find('img').css({ width: this.ISS[n].ow,'height':this.ISS[n].oh
		,'margin-left':this.ISS[n].oms
	,'margin-right':this.ISS[n].oms});
},off: function (n) {
	n=this.update(n);
	this.item.stop().animate({ 'margin-top': this.ISS[n].omt}, { duration: slide.aniTime });
	this.item.find('img').stop().animate({ width: this.ISS[n].ow
		,'height':this.ISS[n].oh
		,'margin-left':this.ISS[n].oms
	,'margin-right':this.ISS[n].oms}, { duration: slide.aniTime
	});
},on: function (n) {
	n=this.update(n);
	this.item.stop().animate({ 'margin-top': this.ISS[n].imt}, { duration: slide.aniTime });
	this.item.find('img').stop().animate({ width: this.ISS[n].iw
		,height : this.ISS[n].ih
		,'margin-left':this.ISS[n].ims
	,'margin-right':this.ISS[n].ims}, { duration: slide.aniTime,easing: slide.easing });
	},setChgNavi : function (navi, mode) {
		$('.__const_' + navi + '>img').attr('src', this.NI[navi+mode]);
	}
};