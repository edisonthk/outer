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
				templateUrl: '/html/snippet/',
				controller: 'snippetListCtrl',
				reloadOnSearch: false,
			}).
			when('/snippet/create', {
				templateUrl: '/html/snippet/create',
				controller: 'snippetModifyCtrl',
				reloadOnSearch: false,
			}).
			when('/snippet/:snippet/edit', {
				templateUrl: '/html/snippet/modify',
				controller: 'snippetModifyCtrl',
				reloadOnSearch: false,
			});

		$locationProvider.html5Mode(true).hashPrefix('!');
	}]);

codegarageApp.directive('pagedownAdmin', function ($compile, $timeout) {
    var nextId = 0;
    var converter = Markdown.getSanitizingConverter();
    converter.hooks.chain("preBlockGamut", function (text, rbg) {
        return text.replace(/^ {0,3}""" *\n((?:.*?\n)+?) {0,3}""" *$/gm, function (whole, inner) {
            return "<blockquote>" + rbg(inner) + "</blockquote>\n";
        });
    });
    
    return {
        require: 'ngModel',
        replace: true,
        template: '<div class="pagedown-bootstrap-editor"></div>',
        link: function (scope, iElement, attrs, ngModel) {

            var editorUniqueId;

            if (attrs.id == null) {
                editorUniqueId = nextId++;
            } else {
                editorUniqueId = attrs.id;
            }

            var newElement = $compile(
                '<div>' +
                   '<div class="wmd-panel">' +
                      '<div id="wmd-button-bar-' + editorUniqueId + '"></div>' +
                      '<textarea class="wmd-input" id="wmd-input-' + editorUniqueId + '">' +
                      '</textarea>' +
                   '</div>' +
                '</div>')(scope);

            iElement.html(newElement);

            var help = function () {
                alert("There is no help");
            }

            var editor = new Markdown.Editor(converter, "-" + editorUniqueId, {
                handler: help,
                imageDirectory: 'img/wmd/',
            });

            var $wmdInput = iElement.find('#wmd-input-' + editorUniqueId);

            var init = false;

            editor.hooks.chain("onPreviewRefresh", function () {
              var val = $wmdInput.val();
              if (init && val !== ngModel.$modelValue ) {
                $timeout(function(){
                  scope.$apply(function(){
                    ngModel.$setViewValue(val);
                    ngModel.$render();
                  });
                });
              }              
            });

            ngModel.$formatters.push(function(value){
              init = true;
              $wmdInput.val(value);
              editor.refreshPreview();
              return value;
            });

            editor.run();
        }
    }
});

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