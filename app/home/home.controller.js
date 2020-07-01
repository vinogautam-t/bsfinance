app.controller('homeController', function($scope, $rootScope, $state, $timeout, DATA) {
	$scope.pageInfo = {data: DATA.data, action: false};
});