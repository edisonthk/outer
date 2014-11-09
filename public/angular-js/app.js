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

codegarageApp.directive('dialogBox',[ '$document',function($document) {
	return {
		restrict: 'E',
		scope: true,
		link: function(scope, element, attrs){

			// $document.on('click', function(e){

			// 	var _p = angular.element(e.target).parent();

			// 	if(!_p.hasClass("dialog-message") && _p[0].localName !== "dialog-box" && e.target.localName !== "button" )
			// 	{
			// 		console.log("fdsfs");
			// 	}



			// 	// When the click event is fired, we need
   //              // to invoke the AngularJS context again.
   //              // As such, let's use the $apply() to make
   //              // sure the $digest() method is called
   //              // behind the scenes.
   //              scope.$apply(function(){

   //              });
			// });

			if(typeof scope.dialogBox === "undefined"){

				scope.dialogBox = {
					show: false,
					okButtonText: "はい！",
					noButtonText: "いいえ！",
					title: "Dialog",
					message: "This is dialog Hello",
					okButtonClass: "",
					noButtonClass: "",
					okButtonClickEvent: function() {},
					noButtonClickEvent: function() {},
				}
			}


		}
	}
}]);

codegarageApp.directive('markdownEditor', ["$window","$compile",function($window, $compile) {
    
    return {
    	restrict: 'A',
        require: 'ngModel',
        replace: true,
        link: function (scope, iElement, attrs, ctrl) {

        	// compile element to angularJS
            var newElement = $compile(
                '<div class="input-toolsbox">'+
						'<a class="input-toolsbox-item" inputToolsboxItem="" ng-click="btnBold()"><i class="fa fa-bold"></i></a>'+
						'<a class="input-toolsbox-item" inputToolsboxItem="" ng-click="btnItalic()"><i class="fa fa-italic"></i></a>'+
						'<a class="input-toolsbox-item" inputToolsboxItem ng-click="btnImage()"><i class="fa fa-picture-o"></i></a>'+
						'<a class="input-toolsbox-item" inputToolsboxItem ng-click="btnCoding()"><i class="fa fa-code"></i></a>'+
					'</div>'+
				'<textarea class="input-textarea" ng-model="article.content"></textarea>'
                )(scope);

            
            scope.btnCoding = function(){
            	var _textarea = attrs["$$element"][0].getElementsByTagName("textarea")[0];
            	
            	var mTextHighlighted = TextHighlighted(_textarea);
            	var textSelected = mTextHighlighted.getText
		
		
				// setup begin
				textSelected = '    ' + textSelected;
			   	textSelected = textSelected.replace(/\n/g, '\n    ');
			   	textSelected = textSelected.replace(/\n\n/g,'\n');
			   	
			   	var content = _textarea.value;
			   	var b1 = content.substring(0, mTextHighlighted.getStart);
			   	var b2 = content.substring(mTextHighlighted.getEnd , content.length);
			   	
		       	_textarea.value = b1 + "\n"+ textSelected +"\n" + b2;
            	scope.article.content = _textarea.value;
            }

            scope.btnBold = function(){
            	var _textarea = attrs["$$element"][0].getElementsByTagName("textarea")[0];
            	
            	var mTextHighlighted = TextHighlighted(_textarea);
            	var textSelected = mTextHighlighted.getText
		
		
				// setup begin
				textSelected = '**' + textSelected +'**';
			   	
			   	
			   	var content = _textarea.value;
			   	var b1 = content.substring(0, mTextHighlighted.getStart);
			   	var b2 = content.substring(mTextHighlighted.getEnd , content.length);
			   	
		       	_textarea.value = b1 + textSelected + b2;
		       	scope.article.content = _textarea.value;
            }
            scope.btnItalic = function(){
            	var _textarea = attrs["$$element"][0].getElementsByTagName("textarea")[0];
            	
            	var mTextHighlighted = TextHighlighted(_textarea);
            	var textSelected = mTextHighlighted.getText
		
		
				// setup begin
				textSelected = '*' + textSelected +'*';
			   	
			   	
			   	var content = _textarea.value;
			   	var b1 = content.substring(0, mTextHighlighted.getStart);
			   	var b2 = content.substring(mTextHighlighted.getEnd , content.length);
			   	
		       	_textarea.value = b1 + textSelected + b2;
		       	scope.article.content = _textarea.value;
            }



            function TextHighlighted(_textarea){
				var selStart = _textarea.selectionStart;
				var selEnd = _textarea.selectionEnd;
				var content = _textarea.value;
				
				// 
				var wordsSel = "";
				if(selStart != selEnd)
					wordsSel = content.substring(selStart, selEnd);
				
				return {
					getText : wordsSel,
					getStart : selStart,
					getEnd : selEnd
				}
			}

			iElement.append(newElement);
        }
    }
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