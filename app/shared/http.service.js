(function () {
    'use strict'

    angular.module('app')
        .factory('httpService', httpRestService);

    httpRestService.$inject = ['$http', '$q', '$timeout', '$rootScope'];

    function httpRestService($http, $q, $timeout, $rootScope) {

        return {
            get: get,
            post: post
        }

        function get(url) {
            return $http.get(url);
        }

        function post(url, req) {
            var deferred = $q.defer(),
                apiPromise;

            apiPromise = $http.post(url, req, {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }});

            apiPromise.then(function(response){
                deferred.resolve(response);
            }, function(response){
                deferred.reject(response);
            });

            return deferred.promise;

        }

    }

})();