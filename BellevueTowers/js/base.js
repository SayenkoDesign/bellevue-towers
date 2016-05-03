/*
JS file for Bellevue Towers
*/
/* FUNCTIONS INCLUDED:
 * -
 * -
 * ---------------------------------------------------------------------- */

var activeFloorIndex = 0;
var activeFloor = 0;
var floorHeight = 5.5;
var towerOffset = 29;
var maxFloor = 43;

// set translation cookie
if (!$.cookie("lang")) {
  $.cookie("lang", "en", {path: '/'});
}

$(document).ready(function() {
  positionPanels();
  showTranslation($.cookie("lang"));
  initSliders();
  bindTranslations();
  bindPanelScrolling();
  initFloorPlan();
  siteFadeIn();

  loadBackgrounds();
  handleResize();

  // enhance top navigation styling
  $('div.nav-primary ul li').eq(8).css({'border-style': 'none none none double', 'border-width': '3px', 'padding-left': '10px'});
});
/**
 * loadBackgrounds()
 *
 * Loads backgrounds after the initial home page has loaded.
 * Improves perceived load time.
 *
 */

function loadBackgrounds() {
  if ( $.browser.msie ) {
	var version = ( parseInt($.browser.version, 10) );
  }

  if (version < 9) {
	var browserRatio = $(window).width() / $(window).height();
	var imageRatio = 1800/1200;

	if (browserRatio < imageRatio) {
	  setWidth = "auto";
	  setHeight = "100%";
	}
	else {
	  setWidth = "100%";
	  setHeight = "auto";
	}

	var img = "<img class='ie-bg' src='" + templateUrl + "images/bg/homeLand.jpg' style='position: absolute; left: 0; top: 0; z-index: -1; width: " + setWidth + "; height: " + setHeight + "'>";
	$(img).prependTo("div#home.panel");
	$("div#home.panel").css({'overflow':'hidden'});

	var img = "<img class='ie-bg' src='" + templateUrl + "images/bg/residences.jpg' style='position: absolute; left: 0; top: 0; z-index: -1; width: " + setWidth + "; height: " + setHeight + "'>";
	$(img).prependTo("div#residences.panel");
	$("div#residences.panel").css({'overflow':'hidden'});

	var img = "<img class='ie-bg' src='" + templateUrl + "images/bg/floorPlans.jpg' style='position: absolute; left: 0; top: 0; z-index: -1; width: " + setWidth + "; height: " + setHeight + "'>";
	$(img).prependTo("div#floor-plans.panel");
	$("div#floor-plans.panel").css({'overflow':'hidden'});

	var img = "<img class='ie-bg' src='" + templateUrl + "images/bg/building.jpg' style='position: absolute; left: 0; top: 0; z-index: -1; width: " + setWidth + "; height: " + setHeight + "'>";
	$(img).prependTo("div#building.panel");
	$("div#building.panel").css({'overflow':'hidden'});

	var img = "<img class='ie-bg' src='" + templateUrl + "images/bg/neighborhood.jpg' style='position: absolute; left: 0; top: 0; z-index: -1; width: " + setWidth + "; height: " + setHeight + "'>";
	$(img).prependTo("div#neighborhood.panel");
	$("div#neighborhood.panel").css({'overflow':'hidden'});

	var img = "<img class='ie-bg' src='" + templateUrl + "images/bg/stories.jpg' style='position: absolute; left: 0; top: 0; z-index: -1; width: " + setWidth + "; height: " + setHeight + "'>";
	$(img).prependTo("div#stories.panel");
	$("div#stories.panel").css({'overflow':'hidden'});
  }
  
  else {

	$("div#residences.panel").css({
	  'background': 'url(' + templateUrl + 'images/bg/residences.jpg) no-repeat center center',
	  '-webkit-background-size': 'cover',
	  '-moz-background-size': 'cover',
	  '-o-background-size': 'cover',
	  'background-size': 'cover'
	});

	$("div#floor-plans.panel").css({
	  'background': 'url(' + templateUrl + 'images/bg/floorPlans.jpg) no-repeat center center',
	  '-webkit-background-size': 'cover',
	  '-moz-background-size': 'cover',
	  '-o-background-size': 'cover',
	  'background-size': 'cover'
	});

	$("div#building.panel").css({
	  'background': 'url(' + templateUrl + 'images/bg/building.jpg) no-repeat center center',
	  '-webkit-background-size': 'cover',
	  '-moz-background-size': 'cover',
	  '-o-background-size': 'cover',
	  'background-size': 'cover'
	});

	$("div#stories.panel").css({
	  'background': 'url(' + templateUrl + 'images/bg/stories.jpg) no-repeat center center',
	  '-webkit-background-size': 'cover',
	  '-moz-background-size': 'cover',
	  '-o-background-size': 'cover',
	  'background-size': 'cover'
	});

	$("div#neighborhood.panel").css({
	  'background': 'url(' + templateUrl + 'images/bg/neighborhood.jpg) no-repeat center center',
	  '-webkit-background-size': 'cover',
	  '-moz-background-size': 'cover',
	  '-o-background-size': 'cover',
	  'background-size': 'cover'
	});

	$("div.panel").each(function() {
	  $(this).removeClass('loading');
	});
  }
  
  var galleryPanels = "";
  
  for (var i = 1; i < 19; i++) {
	if (i == 1) {
	  if (version < 9) {
		galleryPanels += "<li style='overflow:hidden'>";
		galleryPanels += "<img class='ie-bg' src='" + templateUrl + "/images/bg/homeLand.jpg' style='width: " + setWidth + "; height: " + setHeight + "'>";
		galleryPanels += "</li>";
	  }
	  else {
		galleryPanels += "<li style='background: url(" + templateUrl + "/images/bg/homeLand.jpg) no-repeat top left; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;'></li>";
	  }
	}
	else {
	  if (version < 9 ) {
		galleryPanels += "<li style='overflow:hidden'>";
		galleryPanels += "<img class='ie-bg' src='" + templateUrl + "/images/bg/gallery_image_" + i + ".jpg' style='width: " + setWidth + "; height: " + setHeight + "'>";
		galleryPanels += "</li>";
	  }
	  else {
		galleryPanels += "<li style='background: url(" + templateUrl + "/images/bg/gallery_image_" + i + ".jpg) no-repeat top left; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;'></li>";	  
	  }
	}
  }
  
  $("div#slider-gallery ul").html(galleryPanels);
  
	$("#slider-gallery ul li").each(function() {
	  $(this).css("width",$(window).width() + "px");
	  $(this).css("height",$(window).height() + "px");
	});

	$("#slider-gallery").easySlider({
		auto: false, 
		continuous: false,
		numeric: true,
		speed: 500
	});

}
/**
 * handleResize()
 *
 * Handles resizing of the browser window
 *
 */

function handleResize() {
  // on resize, recalculate panel sizes and positions
  $(window).resize(function() {
	positionPanels();

	var windowPos = $(".active").css('top').split("px")[0];
	$("body,html").scrollTop(windowPos);

	var sidebarOffset = $('div.nav-sidebar').offset();
	$('div.nav-social-media').css("left", sidebarOffset.left);

	if ( $.browser.msie ) {
	  var version = ( parseInt($.browser.version, 10) );

	  if (version < 9) {
		var browserRatio = $(window).width() / $(window).height();
		var imageRatio = 1800/1200;

		if (browserRatio < imageRatio) {
		  setWidth = "auto";
		  setHeight = "100%";
		}
		else {
		  setWidth = "100%";
		  setHeight = "auto";
		}

		$("img.ie-bg").each(function() {
		  $(this).css({'width':setWidth, 'height':setHeight});
		});
	  }
	}
  });
}
/**
 * siteFadeIn()
 *
 * Fade in the site
 *
 */

function siteFadeIn() {
  // fade in body panels
  $("body#panels").fadeIn(2000, function() {
	if ($(location).attr('href').indexOf("#") > -1) {
	  var full_url = $(location).attr('href');
	  animateScroll(full_url);
	}
  });
}
/**
 * initFloorPlan()
 *
 * Initialize Floor Plan
 *
 */

function initFloorPlan() {
  // load the floor plan search
  if (($(location).attr('href').indexOf("?unit=") == -1) && ($('#floor-plans form#search').length > 0)) {
	floorPlanSearch();
  }

  // bind floor plan search
  $('#floor-plans form#search').bind('submit',floorPlanSearch);
  
  // bind floor plan searcy by unit
  $('#floor-plans form#unit-jump').bind('submit',floorPlanSearchByUnit);
}
/**
 * bindPanelScrolling()
 *
 * Bind scrolling behavior to left navigation
 *
 */

function bindPanelScrolling() {
  $(".scroll").click(function(event) {
	if ($(location).attr('href').indexOf("#") > -1) {
	  //event.preventDefault();
	}

	var full_url = $(this).attr('href');

	animateScroll(full_url);
  });
}
/**
 * bindTranslations()
 *
 * Bind translations to top navigation
 *
 */

function bindTranslations() {
  $('div.nav-primary ul li#en').click(function() {
	showTranslation('en');
	$.cookie("lang", "en");
  });

  $('div.nav-primary ul li#ru').click(function() {
	showTranslation('ru');
	$.cookie("lang", "ru");
  });

  $('div.nav-primary ul li#ko').click(function() {
	showTranslation('ko');
	$.cookie("lang", "ko");
  });

  $('div.nav-primary ul li#zh').click(function() {
	showTranslation('zh');
	$.cookie("lang", "zh");
  });
}
/**
 * initSliders()
 *
 * initializes horizontal content sliders
 *
 */
 
function initSliders() {
	$("#slider-residences").easySlider({
		auto: false, 
		continuous: false,
		numeric: true,
		speed: 500
	});

	$("#slider-building").easySlider({
		auto: false, 
		continuous: false,
		numeric: true,
		speed: 500
	});

	$("#slider-neighborhood").easySlider({
		auto: false, 
		continuous: false,
		numeric: true,
		speed: 500
	});

	$("#slider-stories").easySlider({
		auto: false, 
		continuous: false,
		numeric: true,
		speed: 500
	});
}
/**
 * animateScroll(full_url)
 *
 * Scrolling animation
 *
 */

function animateScroll(full_url) {
  var parts = full_url.split("#");
  var trgt = parts[1];
  
  var target_offset = $("#"+trgt).offset();
  var target_top = target_offset.top;

  $("div.panel").each(function() {
	$(this).removeClass("active");
  });
  
  $("#" + trgt).addClass("active");

  $("body,html").animate({scrollTop:target_top}, 800, function() {
	parent.location.hash = trgt;

	var title = trgt.capitalize() + " | BellevueTowers";
	$(document).attr("title", title);
  });
}

/**
 * floorPlanSearchByUnit()
 *
 * Loads the floor plan search results by unit
 *
 */

function floorPlanSearchByUnit() {
  var unit_id = $("input#unit").val(); 

  $.ajax({  
	type: "POST",  
	url: "/results.php",  
	data: "unit="+ unit_id, 
	success: function(data) {  
	  var obj = "";
	  var obj = $.parseJSON(data);

	  resetFloorPlan();
	  
	  if (obj.combined_floors.length > 0) {
		$('#floor-plans div.results-container').html(obj.results);

		// set active floor to topmost floor result
		activeFloorIndex = obj.combined_floors.length - 1;
		activeFloor = obj.combined_floors[obj.combined_floors.length - 1];

		highlightAvailableFloors(obj.n_tower_floors, obj.s_tower_floors, obj.combined_floors);
		filterSearchByFloor(obj.combined_floors);
		addFloorPlanInteraction(obj.combined_floors);

		$("#slider-floorplan").easySlider({
		  auto: false, 
		  continuous: false,
		  numeric: false,
		  speed: 500,
		  floorPlanFinder: true,
		  unitSearch: true
		});

		$('#slider-floorplan-prevBtn a').show();
	  }
	  else {
		var noResultsTxt = "<div class='translation en'><p>Sorry, the unit you are looking for could not be found.</p></div>";
		noResultsTxt += "<div class='translation ru'><p>К сожалению, разыскиваемый вами элемент не найден.</p></div>";
		noResultsTxt += "<div class='translation zh'><p>抱歉，您正在查找的单位无法被找到。</p></div>";
		noResultsTxt += "<div class='translation ko'><p>죄송합니다, 찾고자 하는 유니트를 찾을 수 없습니다. </p></div>";
		$('#floor-plans div.results-container').html(noResultsTxt);	  

		showFloorPlanTranslation($.cookie("lang"));
	  }
	}  
  });
  
  return false;
}
/**
 * floorPlanSearch()
 *
 * Loads the initial floor plan search results 
 *
 */

function floorPlanSearch() {
  var unit_type = $("select#unit-type").val(); 
  var price_min = $("select#price-min").val();
  var price_max = $("select#price-max").val();

  $.ajax({  
	type: "POST",  
	url: "/results.php",  
	data: "unit_type="+ unit_type +"&price_min="+ price_min + "&price_max="+ price_max, 
	success: function(data) {  
	  var obj = "";
	  var obj = $.parseJSON(data);

	  resetFloorPlan();

	  $('#floor-plans div.results-container').html(obj.results);

	  // set active floor to topmost floor result
	  activeFloorIndex = obj.combined_floors.length - 1;
	  activeFloor = obj.combined_floors[obj.combined_floors.length - 1];
			  
	  highlightAvailableFloors(obj.n_tower_floors, obj.s_tower_floors, obj.combined_floors);
	  filterSearchByFloor(obj.combined_floors);
	  addFloorPlanInteraction(obj.combined_floors);

	  $("#slider-floorplan").easySlider({
		auto: false, 
		continuous: false,
		numeric: false,
		speed: 500,
		floorPlanFinder: true
	  });
	  
	  showFloorPlanTranslation($.cookie("lang"));

	}  
  });
  
  return false;
}
/**
 * positionPanels()
 *
 * Positions scrolling panels vertically based on browser size
 * Also positions floating social media bar
 * 
 */

function positionPanels() {
  $('body').css({
	height: $(window).height() + "px"
  });

  $('html').css({
	height: $(window).height() + "px"
  });
  
  $('div.panel').each(function(index) {
	$(this).css({
	  height: $(window).height() + "px", 
	  top: $(window).height() * index + "px"
	});
  });
  
  $('#slider-gallery').css({
	width: $(window).width() + "px",
	height: $(window).height() + "px"
  });
  
  $('#slider-gallery ul').css({
	width: $(window).width() * $('#slider-gallery ul li').size() + "px"  
  });  
  
  $('#slider-gallery li').each(function() {
	$(this).css({
	  width: $(window).width() + "px",
	  height: $(window).height() + "px"
	});  
  });
  
  browserHeight = $(window).height();
  
  // position social media icons
  var sidebarOffset = ($(window).width() - 1202) / 2;
  $('div.nav-social-media').css("left", sidebarOffset);
}
/**
 * showTranslation(lang)
 *
 * Toggles on requested language.
 * 
 * Inputs:
 * lang - language to show
 */

function showTranslation(lang) {
  $("div.translation").each(function() {
	$(this).removeClass('current');

	if ($(this).hasClass(lang)) {
	  $(this).addClass('current');
	}

	// we need to make an adjustment to the North/South Tower indicators 
	// and other floor plan finder elements when Russian is in place - the 
	// length of the translations move things around
	if (lang == "ru") {
	  $("div.tower-indicators").css('margin-top','10px');
	  $("div.legend div.available").css('background-position', '0 4px');
	  $("div.legend div.selected").css('background-position', '0 4px');
	  $("form#unit-jump").css('margin-top','-5px');
	  $("form#unit-jump label div.translation.current.ru").css('margin-top','5px');
	}
	else {
	  $("div.tower-indicators").css('margin-top','0');
	  $("div.legend div.available").css('background-position', '0 9px');
	  $("div.legend div.selected").css('background-position', '0 9px');
	  $("form#unit-jump").css('margin-top','0px');
	  $("form#unit-jump label div.translation.current.ru").css('margin-top','0px');
	}
  });
}
/**
 * showFloorPlanTranslation(lang)
 *
 * Toggles on requested language inside floor plan finder.
 * Since the floor plan finder makes some dynamic calls after
 * initial page load, we need to trigger the translations separately
 * from the rest of the page.  No need to make multiple recurses.
 * 
 * Inputs:
 * lang - language to show
 */

function showFloorPlanTranslation(lang) {
  $("div#slider-floorplan div.translation").each(function() {
	$(this).removeClass('current');

	if ($(this).hasClass(lang)) {
	  $(this).addClass('current');
	}
  });
}
/**
 * resetFloorPlan();
 *
 * Reset floor plan finder
 */

function resetFloorPlan() {
  $("div.tower-container div.floor").each(function() {
	$(this).remove();
  });

  $("#north-tower-selector").remove();
  $("#south-tower-selector").remove();
  
  $("#slider-floorplan-prevBtn").remove();
  $("#slider-floorplan-nextBtn").remove();
}
/**
 * highlightAvailableFloors()
 *
 * Highlight floors of towers with available units.
 */

function highlightAvailableFloors(northTowerFloors, southTowerFloors, combinedFloors) {
  // loop through available north tower floors and position highlighter
  for (var i = 0; i < northTowerFloors.length; i++) {
	$('<div/>', { 
	  id: 'north-tower-' + northTowerFloors[i],
	  css: {top : (((maxFloor - northTowerFloors[i]) * floorHeight) + towerOffset) + 'px'}
	}).addClass('floor').appendTo('div.north-tower-floors');
  }

  for (var i = 0; i < southTowerFloors.length; i++) {
	$('<div/>', { 
	  id: 'south-tower-' + southTowerFloors[i],
	  css: {top : (((maxFloor - southTowerFloors[i]) * floorHeight) + towerOffset) + 'px'}
	}).addClass('floor').appendTo('div.south-tower-floors');
  }
  
  $('<div/>', { 
	id: 'north-tower-selector',
	css: {top: (((maxFloor - activeFloor) * floorHeight) + towerOffset) + 'px'}
  }).appendTo('div.north-tower-floors');
  
  $('<div/>', { 
	id: 'south-tower-selector',
	css: {top: (((maxFloor - activeFloor) * floorHeight) + towerOffset) + 'px'}
  }).appendTo('div.south-tower-floors');
}
/**
 * filterSearchByFloor()
 *
 * Filter floor plan search results by floor.
 */

function filterSearchByFloor(combinedFloors) {
  var numResults = 0;
  
  $('#floor-plans div.results-container div.result').each(function() {
	var floor_class = "floor-" + combinedFloors[activeFloorIndex];
	if ($(this).hasClass(floor_class)) {
	  $(this).show();
	  if ($(this).parent().hasClass('other-homes')) {
	  }
	  else {
		numResults++;
	  }
	}
	else {
	  $(this).hide();
	}
  });
  
  if (numResults < 1) {
	$('div.results-msg').hide();
  }
  else {
	$('div.results-msg').show();

	// check if we landed on an active floor
	if ($('#floor-plans div.results-container div.result').hasClass('floor-' + activeFloor)) {
	  $('div.results-msg span.active-floor').html(activeFloor);
	}

	$('div.results-msg span.num-results').html(numResults);
  }
  
  if ($('#floor-plans div.results-container div.results.other-homes').children('div.result').hasClass("floor-" + combinedFloors[activeFloorIndex])) {
	$('div.other-homes').show();
	$('div.other-homes span.active-floor').html(activeFloor);
  }
  else {
	$('div.other-homes').hide();
  }
}
/**
 * addFloorPlanInteraction();
 *
 * Filter floor plan search results by floor.
 */

function addFloorPlanInteraction(floorResults) {
  $('div.tower-container div.floor').each(function() {
	$(this).click(function() {
	  var topPos = $(this).css('top');
	  
	  $('#north-tower-selector').css({top : $(this).css('top')});
	  $('#south-tower-selector').css({top : $(this).css('top')});
	  
	  activeFloor = Math.round(maxFloor - (parseFloat($(this).css('top')) - towerOffset) / floorHeight);
	  
	  for (var j = 0; j < floorResults.length; j++) {
		if (floorResults[j] == activeFloor) {
		  activeFloorIndex = j;
		}
	  }
	  
	 filterSearchByFloor(floorResults);

	});
  });

  $("#north-tower-selector").draggable({ 
	containment: "div.tower-drag-container", 
	grid: [5.5,5.5],
	axis: "y",
	cursor: 'move',
	drag: function() {
	  var topPos = $(this).css('top');
	  $("#south-tower-selector").css({top: topPos});
	},
	stop: function() {
	  activeFloor = Math.round(maxFloor - (parseFloat($(this).css('top')) - towerOffset) / floorHeight);

	  for (var j = 0; j < floorResults.length; j++) {
		if (floorResults[j] == activeFloor) {
		  activeFloorIndex = j;
		}
	  }

	  filterSearchByFloor(floorResults);
	}
  });

  $("#south-tower-selector").draggable({ 
	containment: "div.tower-drag-container", 
	grid: [5.5,5.5],
	axis: "y",
	cursor: 'move',
	drag: function() {
	  var topPos = $(this).css('top');
	  $("#north-tower-selector").css({top: topPos});
	},
	stop: function() {
	  activeFloor = Math.round(maxFloor - (parseFloat($(this).css('top')) - towerOffset) / floorHeight);

	  for (var j = 0; j < floorResults.length; j++) {
		if (floorResults[j] == activeFloor) {
		  activeFloorIndex = j;
		}
	  }

	  filterSearchByFloor(floorResults);
	}
  });
}
String.prototype.capitalize = function() {
	return this.charAt(0).toUpperCase() + this.slice(1);
}
