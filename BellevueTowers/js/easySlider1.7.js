/*
 * 	Easy Slider 1.7 - jQuery plugin
 *	written by Alen Grakalic	
 *	http://cssglobe.com/post/4004/easy-slider-15-the-easiest-jquery-plugin-for-sliding
 *
 *	Copyright (c) 2009 Alen Grakalic (http://cssglobe.com)
 *	Dual licensed under the MIT (MIT-LICENSE.txt)
 *	and GPL (GPL-LICENSE.txt) licenses.
 *
 *	Built for jQuery library
 *	http://jquery.com
 *
 */
 
/*
 *	markup example for $("#slider").easySlider();
 *	
 * 	<div id="slider">
 *		<ul>
 *			<li><img src="images/01.jpg" alt="" /></li>
 *			<li><img src="images/02.jpg" alt="" /></li>
 *			<li><img src="images/03.jpg" alt="" /></li>
 *			<li><img src="images/04.jpg" alt="" /></li>
 *			<li><img src="images/05.jpg" alt="" /></li>
 *		</ul>
 *	</div>
 *
 */

(function($) {

	$.fn.easySlider = function(options){
	  
		// default configuration properties
		var defaults = {			
			prevId: 		    'prevBtn',
			prevText: 		  'Previous',
			nextId: 		    'nextBtn',	
			nextText: 		  'Next',
			controlsShow:	  true,
			controlsBefore:	'',
			controlsAfter:	'',	
			controlsFade:	  true,
			firstId: 		    'firstBtn',
			firstText: 		  'First',
			firstShow:		  false,
			lastId: 		    'lastBtn',	
			lastText: 		  'Last',
			lastShow:		    false,				
			vertical:		    false,
			speed: 			    800,
			auto:			      false,
			pause:			    2000,
			continuous:		  false, 
			numeric: 		    false,
			numericId: 		  'controls',
			floorPlanFinder: false,
			unitSearch:      false
		}; 
		
		var options = $.extend(defaults, options);  
		
		this.each(function() {  
			var obj = $(this); 	
			var s = $("li", obj).length;
			var w = $("li", obj).width(); 
			var h = $("li", obj).height(); 
			var clickable = true;
			obj.width(w); 
			obj.height(h); 
			obj.css("overflow","hidden");
			var ts = s-1;
			var t = 0;
			$("ul", obj).css('width',s*w);		
			var numericIdName = obj.attr('id') + '-' + options.numericId;	
			var prevIdName = obj.attr('id') + '-' + options.prevId;
			var nextIdName = obj.attr('id') + '-' + options.nextId;
			
			if(options.continuous){
				$("ul", obj).prepend($("ul li:last-child", obj).clone().css("margin-left","-"+ w +"px"));
				$("ul", obj).append($("ul li:nth-child(2)", obj).clone());
				$("ul", obj).css('width',(s+1)*w);
			};				
			
			if(!options.vertical) $("li", obj).css('float','left');
							
			if(options.controlsShow){
        var html = options.controlsBefore;
        
        if(options.numeric) {
        html += '<ol id="'+ numericIdName +'" class="controls group"></ol>';
        if(options.firstShow) html += '<span id="'+ options.firstId +'"><a href=\"javascript:void(0);\"></a></span>';
        html += ' <div class="nav-slider"><span id="'+ prevIdName +'" class="nav-prev"><a href=\"javascript:void(0);\"></a></span>';
        html += ' <span id="'+ nextIdName +'" class="nav-next"><a href=\"javascript:void(0);\"></a></span></div>';
        if(options.lastShow) html += ' <span id="'+ options.lastId +'"><a href=\"javascript:void(0);\"></a></span>';
        } else {
        if(options.firstShow) html += '<span id="'+ options.firstId +'"><a href=\"javascript:void(0);\"></a></span>';
        html += ' <span id="'+ prevIdName +'" class="nav-prev"><a href=\"javascript:void(0);\"></a></span>';
        html += ' <span id="'+ nextIdName +'" class="nav-next"><a href=\"javascript:void(0);\"></a></span>';
        if(options.lastShow) html += ' <span id="'+ options.lastId +'"><a href=\"javascript:void(0);\"></a></span>';
        };

        html += options.controlsAfter;
        $(obj).after(html);
      };
			
			if(options.numeric) {
        for(var i=0;i<s;i++) {
          $(document.createElement("li"))
          .attr('id', numericIdName + (i+1))
          .html('<a rel='+ i +' href=\"javascript:void(0);\"></a>')
          .appendTo($("#"+ numericIdName))
          .click(function(){
            animate($("a",$(this)).attr('rel'),true);
          });
        };

        $("a","#"+ nextIdName).click(function(){
          animate("next",true);
        });

        $("a","#"+prevIdName).click(function(){
          animate("prev",true);
        });

        $("a","#"+options.firstId).click(function(){
          animate("first",true);
        });

        $("a","#"+options.lastId).click(function(){
          animate("last",true);
        });
        

      } else {

        $("a","#"+nextIdName).click(function(){
          animate("next",true);
        });

        $("a","#"+prevIdName).click(function(){
          animate("prev",true);
        });

        $("a","#"+options.firstId).click(function() {
          animate("first",true);
        });

        $("a","#"+options.lastId).click(function() {
          animate("last",true);
        });

        if (options.floorPlanFinder) {
          if ($("li#" + numericIdName).hasClass("current")) {
            $("a","#"+nextIdName).hide();
          }
          
          $("div.result").each(function() {
            if (options.unitSearch) {
              var unitInfo = $(this).html();
              var unitPlan = "/plans/" + $(this).children("span#plan").html().toLowerCase() + ".png";
              var unitPlanLg = "/plans/" + $(this).children("span#plan").html().toLowerCase() + "_xl.png";
              var pdfLink = "/plans/" + $(this).children("span#plan").html() + ".pdf";

              $("div.unit-details-title").html(unitInfo);
              $("div.unit-details-plan").html("<img src='" + unitPlan + "' alt='Enlarge Floor Plan' title='Enlarge Floor Plan' />");
              
              $("div.unit-details-plan img").click(function() {
                var content = "<img src='" + unitPlanLg + "' class='floorplan-lg'/>";
                content += "<a href='" + pdfLink + "' class='modal call-to-action' id='download' target='_blank'>" + $("li.unit-details div.footer div.translation.current a").html() + "</a>";
                
                Shadowbox.open({
                    content:    content,
                    player:     "html",
                    width:      780,
                    height:     530,
                    handleOversize: "resize"
                });              
              });
              
              $("div.unit-details-plan").hover(function() {
                $(this).css('cursor','hand');
              });
              $("li.unit-details a#download").attr("href", pdfLink);
              $("li.unit-details a#download").attr("target", "_blank");
              animate("next",true);
            }

            $(this).click(function() {
              $("div.result.active").removeClass('active');
              $(this).addClass('active');

              var unitInfo = $(this).html();
              var unitPlan = "/plans/" + $(this).children("span#plan").html().toLowerCase() + ".png";
              var unitPlanLg = "/plans/" + $(this).children("span#plan").html().toLowerCase() + "_xl.png";
              var pdfLink = "/plans/" + $(this).children("span#plan").html() + ".pdf";

              $("div.unit-details-title").html(unitInfo);
              $("div.unit-details-plan").html("<img src='" + unitPlan + "' alt='Enlarge Floor Plan' title='Enlarge Floor Plan' />");
              
              $("div.unit-details-plan img").click(function() {
                var content = "<img src='" + unitPlanLg + "' class='floorplan-lg'/>";
                content += "<a href='" + pdfLink + "' class='modal call-to-action' id='download' target='_blank'>" + $("li.unit-details div.footer div.translation.current a").html() + "</a>";
                
                Shadowbox.open({
                    content:    content,
                    player:     "html",
                    width:      780,
                    height:     530,
                    handleOversize: "resize"
                });              
              });
              
              $("div.unit-details-plan").hover(function() {
                $(this).css('cursor','hand');
              });
              $("li.unit-details a#download").attr("href", pdfLink);
              $("li.unit-details a#download").attr("target", "_blank");
              animate("next",true);
            });
          });
        }      

      };		
			
			function setCurrent(i){
				i = parseInt(i)+1;
				$("li", "#" + numericIdName).removeClass("current");
				$("li#" + numericIdName + i).addClass("current");
			};
			
			function adjust(){
				if(t>ts) t=0;		
				if(t<0) t=ts;	
				if(!options.vertical) {
					$("ul",obj).css("margin-left",(t*$("li",obj).width()*-1));
				} else {
					$("ul",obj).css("margin-left",(t*h*-1));
				}
				if(options.numeric) setCurrent(t);
				clickable = true;
				$("div.nav-slider").fadeIn();

			};
			
			function animate(dir,clicked){
				$("div.nav-slider").hide();
				if (clickable){
					clickable = false;
					var ot = t;				
          t = parseInt(t);
					switch(dir){
						case "next":
							t = (ot>=ts) ? (options.continuous ? t+1 : ts) : t+1;						
							break; 
						case "prev":
							t = (t<=0) ? (options.continuous ? t-1 : 0) : t-1;
							break; 
						case "first":
							t = 0;
							break; 
						case "last":
							t = ts;
							break; 
						default:
							t = dir;
							break; 
					};	
					var diff = Math.abs(ot-t);
					var speed = diff*options.speed;						
					if(!options.vertical) {
						p = (t*$("li",obj).width()*-1);
						$("ul",obj).animate(
							{ marginLeft: p }, 
							{ queue:false, duration:speed, complete:adjust }
						);				
					} else {
						p = (t*h*-1);
						$("ul",obj).animate(
							{ marginTop: p }, 
							{ queue:false, duration:speed, complete:adjust }
						);					
					};
					
					if(!options.continuous && options.controlsFade){					
						if(t==ts){
							$("a","#"+nextIdName).hide();
							$("a","#"+options.lastId).hide();
						} else {
							$("a","#"+nextIdName).show();
							$("a","#"+options.lastId).show();					
						};
						if(t==0){
							$("a","#"+prevIdName).hide();
							$("a","#"+options.firstId).hide();
						} else {
							$("a","#"+prevIdName).show();
							$("a","#"+options.firstId).show();
						};					
					};				
					
					if(clicked) clearTimeout(timeout);
					if(options.auto && dir=="next" && !clicked){;
						timeout = setTimeout(function(){
							animate("next",false);
						},diff*options.speed+options.pause);
					};
			
				};
				
			};
			// init
			var timeout;
			if(options.auto){;
				timeout = setTimeout(function(){
					animate("next",false);
				},options.pause);
			};		
			
			if(options.numeric) setCurrent(0);
		
			if(!options.continuous && options.controlsFade){					
				$("a","#"+prevIdName).hide();
				$("a","#"+options.firstId).hide();				
			};				
			
		});
	  
	};

})(jQuery);



