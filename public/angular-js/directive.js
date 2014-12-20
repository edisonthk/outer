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


codegarageApp.directive("searchForm", ["$window", function(w) {

	return {
		restrict: 'E',
		link: function(scope,element,attrs) {

			var resize = function() {
				var h = window.innerHeight;
				var w = window.innerWidth;
				var _ch = element[0].clientHeight;
				var _cw = element[0].clientWidth;

				element[0].style.top = ((h * 0.65) - (_ch / 2))+ "px";
				element[0].style.left = ((w / 2) - (_cw / 2)) + "px";	
			}

			resize();
			angular.element(w).bind('resize', function () {
				resize();
			});

			scope.$watch(function(){
				return scope.textbox.focus;
			}, function(new_value, old_value) {
				element.find("input")[0].focus();
			});
		}
	}
}]);

codegarageApp.directive("autocomplete", function(){
	return function(scope,element,attrs){
		var _i = element[0].getElementsByTagName("input")[0];
		_i.addEventListener('blur',function(){
			scope.textbox.focus = false;
		});
	}
});

codegarageApp.directive("sideMenuScrollingEvent", ["$window","$document","$rootScope",function(w,d,s) {
	return function(scope,n,attrs) {
		var navHeight = d[0].getElementsByTagName("nav")[0].offsetHeight;
		
		var p = d[0].getElementsByClassName("search-wrapper-form")[0];
		var sn = d[0].getElementsByClassName("snippet-list")[0];
		sn.style.height = (p.parentNode.clientHeight - p.clientHeight) + "px";
		
		n[0].style.top = navHeight + "px";
		// Handle height and offsetTop of the side menu at left hand side

		var resizeEvent = function() {
			var top  = w.pageYOffset || d[0].documentElement.scrollTop,
	    		left = w.pageXOffset || d[0].documentElement.scrollLeft;
	    	var menuTop = navHeight - top;
	    	if(menuTop <= navHeight){
	    		if(menuTop > 0){
	    			n[0].style.top = menuTop + "px";	
	    			n[0].style.height = (window.innerHeight-menuTop)+"px";
	    		}else{
	    			n[0].style.top = 0;	
	    			n[0].style.height = window.innerHeight + "px";
	    		}
	    	}

	    	sn.style.height = (p.parentNode.clientHeight - p.clientHeight) + "px";
		}

		angular.element(w).bind('scroll', function () {
			resizeEvent();
		});
		angular.element(w).bind('resize', function() {			
			resizeEvent();
		});
		s.selectText = function(element) {			  
			var selection = window.getSelection();
			var range = document.createRange();
			range.selectNodeContents(element);
			selection.removeAllRanges();
			selection.addRange(range);
			var top = element.documentOffsetTop() - (window.innerHeight / 2 );
			window.scrollTo( 0, top );
		}

		angular.element(w).on('keydown', function(e) {
			keyPressed = e.keyCode;

			if( (keyPressed >= KeyEvent.KEY_0 && keyPressed <= KeyEvent.KEY_9) || 
				( !(e.ctrlKey || e.metaKey) && keyPressed >= KeyEvent.KEY_A && keyPressed <= KeyEvent.KEY_Z )
				|| keyPressed == 219 || keyPressed == 221 ){

				scope.textbox.focus = true;
			}else if(keyPressed == KeyEvent.KEY_ESC){
				
				scope.textbox.focus = false;
			}else if( (e.ctrlKey || e.metaKey)&& !scope.textbox.focus && keyPressed == KeyEvent.KEY_A){
				e.preventDefault();
				
				var _body = document.getElementById("article");
				if(_body){
					var _elements = _body.getElementsByTagName("pre");
					if(_elements){
						if(_elements.length > 0){
							scope._current_pre_ele ++;
							if(scope._current_pre_ele >= _elements.length){
								scope._current_pre_ele = 0;
							}
							s.selectText(_elements[scope._current_pre_ele]);
						}	
					}
				}
				
			}
			
			scope.$apply(attrs.onKeydown);
		});

	}
}]);

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