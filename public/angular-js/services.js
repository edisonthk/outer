'use strict';

var snippetServices = angular.module('snippetServices', ['ngResource']);

snippetServices.factory('Snippet', ['$resource',
  function($resource){
    return $resource('/json/snippet/:snippetId', {}, {
      query: {method:'GET', params:{snippetId:''}, isArray:true}
    });
  }]);
