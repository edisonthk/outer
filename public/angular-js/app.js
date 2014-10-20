var KeyEvent = {
				KEY_0 : 48,
				KEY_9 : 57,
				KEY_A : 65,
				KEY_Z : 90,
				KEY_ESC : 27,
				KEY_ENTER : 13
			};

Element.prototype.documentOffsetTop = function () {
    return this.offsetTop + ( this.offsetParent ? this.offsetParent.documentOffsetTop() : 0 );
};



var codegarageApp = angular.module('codegarageApp',['ngRoute','ngSanitize','ngResource','ngAnimate','ngTagsInput','ui.markdown','snippetContollers','snippetServices']);

codegarageApp.config(['$locationProvider','$routeProvider',
	function($locationProvider,$routeProvider) {
		$routeProvider.
			when('/', {
				redirectTo:'/snippets',
			}).
			when('/snippets/:snippet?', {
				templateUrl: '/angular-html/index.html',
				controller: 'snippetListCtrl',
				reloadOnSearch: false,
			}).
			when('/snippet/create', {
				templateUrl: '/angular-html/modify.html',
				controller: 'snippetModifyCtrl',
				reloadOnSearch: false,
			}).
			when('/snippet/:snippet/edit', {
				templateUrl: '/angular-html/modify.html',
				controller: 'snippetModifyCtrl',
				reloadOnSearch: false,
			});

		$locationProvider.html5Mode(true).hashPrefix('!');
	}]);

codegarageApp.directive("sideMenuScrollingEvent", ["$window","$rootScope",function($window, $rootScope) {
	return {
		restrict: 'A',
		link: function(scope, element, attrs){


			var navHeight = document.getElementsByTagName("nav")[0].offsetHeight;
			var menuElement = element[0];
			
			menuElement.style.top = navHeight + "px";
			// Handle height and offsetTop of the side menu at left hand side
			angular.element($window).bind('scroll', function () {
				
				var top  = window.pageYOffset || document.documentElement.scrollTop,
		    		left = window.pageXOffset || document.documentElement.scrollLeft;

		    	var menuTop = navHeight - top;

		    	if(menuTop <= navHeight){
		    		
		    		if(menuTop > 0){
		    			menuElement.style.top = menuTop + "px";	
		    			menuElement.style.height = (window.innerHeight-menuTop)+"px";
		    		}else{
		    			menuElement.style.top = 0;	
		    			menuElement.style.height = window.innerHeight + "px";
		    		}
		    	}
		    	
			});

			scope._current_pre_ele = -1;
			scope.inputActiveFlag = false;

			// $rootScope.installed handle all kinds of binding event that 
			// only execute one time at the very begining
			if(!$rootScope.installed){

				$rootScope.selectText = function(element) {			  

					var selection = window.getSelection();
					var range = document.createRange();
					range.selectNodeContents(element);
					selection.removeAllRanges();
					selection.addRange(range);
					
					var top = element.documentOffsetTop() - (window.innerHeight / 2 );
					window.scrollTo( 0, top );
				}

				angular.element($window).on('keydown', function(event) {
					


					keyPressed = event.keyCode;
					
					if( (keyPressed >= KeyEvent.KEY_0 && keyPressed <= KeyEvent.KEY_9) || 
						( !(event.ctrlKey || event.metaKey) && keyPressed >= KeyEvent.KEY_A && keyPressed <= KeyEvent.KEY_Z ) ){
						
						element.find("input")[0].focus();
						scope.inputActiveFlag = true; 
					}else if(keyPressed == KeyEvent.KEY_ESC){
						element.find("input")[0].blur();
						scope.inputActiveFlag = false;
					}else if( (event.ctrlKey || event.metaKey) && !scope.inputActiveFlag && keyPressed == KeyEvent.KEY_A){
						event.preventDefault();
						element.find("input")[0].blur();
						scope.inputActiveFlag = false;

						var _body = document.getElementById("article");
						var _elements = _body.getElementsByTagName("pre");

						if(_elements.length > 0){
							scope._current_pre_ele ++;
							if(scope._current_pre_ele >= _elements.length){
								scope._current_pre_ele = 0;
							}		

							$rootScope.selectText(_elements[scope._current_pre_ele]);
						}
					}
				});

			}
			
			// $rootScope.installed = true;
		}
	}
}])
function configElementSize(){
    var w  = window.innerWidth || document.documentElement.clientWidth,
    	h = window.innerHeight || document.documentElement.clientHeight;


}


var doit;
configElementSize();
window.onresize = function(){
  clearTimeout(doit);
  doit = setTimeout(configElementSize, 300);
};