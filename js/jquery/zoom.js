/**
 * @name browserZoom 
 * 
 * @param 
 *    curr : 현재값
 *    rate : 확대/축소 비율
 *    max : 최대 확대
 *    min : 최대 축소
 * @return jQuery
 * @author narang82
 */

(function(jQuery) {
	jQuery.fn.browserZoom = function(options) {
		var defaults = {
			curr:100,
			rate:10,
			max:160,
			min:60
		};
			
		this.each(function() {
			var obj = jQuery(this);
			var o = jQuery.extend(defaults, options);
			if( o.curr==null ) {
				o.curr=100;
			}

			zoom();
			jQuery('.browserZoomIn',obj).click(function() {
				o.curr = parseInt(o.curr) + parseInt(o.rate);
				if( o.curr>o.max ) {
					o.curr = o.max;
				}
				zoom();
			});
			jQuery('.browserZoomOut',obj).click(function() {
				o.curr = parseInt(o.curr) - parseInt(o.rate);
				if( o.curr<o.min ) {
					o.curr = o.min;
				}
				zoom();
			});
			function zoom() {
				try {
					jQuery('#Wrap_main').css("zoom", o.curr+"%");
					jQuery('#Wrap_sub').css("zoom", o.curr+"%");
					//jQuery('#Wrap').css("zoom", o.curr+"%");
					jQuery('#bottomWrap').css("zoom", o.curr+"%");
					jQuery('#bottomCopy').css("zoom", o.curr+"%");
					jQuery('#Wrap').css("zoom", o.curr+"%");

					jQuery.cookie('dip_zoom_curr', o.curr);
				} catch(e) {
					// nothing
					// alert( e );
				}
			}
		});
	};
})(jQuery);


function allFontSize(obj, px){
      var childs = obj.childNodes;
      for (var i=0; i<childs.length; i++) {
        if(childs[i].nodeType==1) {

          childs[i].style.fontSize = px;
          if(childs.length) {

            allFontSize(childs[i], px);           

          }
        }
      }
    }

function plusFont(){
	var node = document.body;
	//var node = document.getElementById("Wrap");
	if(parseInt(jQuery("body").css("font-size")) < 18){
		node.style.fontSize = (parseInt(jQuery("body").css("font-size")) + 1) + "px";
		jQuery.cookie('dip_zoom_curr', (parseInt(jQuery("body").css("font-size")) + 1));
		allFontSize(node, node.style.fontSize);
	}else{
		alert("확대 가능한 최대 크기 입니다.");
	}
}
function minusFont(){
	var node = document.body;
	
	if(parseInt(jQuery("body").css("font-size")) > 8){
		node.style.fontSize = (parseInt(jQuery("body").css("font-size")) - 1) + "px";
		jQuery.cookie('dip_zoom_curr', (parseInt(jQuery("body").css("font-size")) + 1));
		allFontSize(node, node.style.fontSize);
	}else{
		alert("축소 가능한 최소 크기 입니다.");
	}
}