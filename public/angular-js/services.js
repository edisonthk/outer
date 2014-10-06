'use strict';

var snippetServices = angular.module('snippetServices', ['ngResource']);

snippetServices.factory('Snippet', ['$resource',
  function($resource){

  	// using $resource module
  	// more details on https://docs.angularjs.org/api/ngResource/service/$resource
  	return $resource('/json/snippet/:snippetId', {}, {
      query: {method:'GET', params:{snippetId:''}, isArray:true},
    });

  }]);
