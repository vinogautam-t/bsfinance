app.controller('signinController', function($scope, $rootScope, $state, $timeout, ApiService) {
	$scope.pageInfo = {saveClicked: false};
	$scope.login = {};

	$scope.doLogin = function(){
		if($scope.mainform.$valid){
			ApiService.login($scope.login).then(function(res){
				if(res.status == 'Success'){
					$rootScope.loggedInUserInfo = res.data;
					localStorage.setItem('bsuser', JSON.stringify(res.data));
					$state.go('account');
				} else {
					ApiService.notification('error', res.msg)
				}
			});
		}
	};
});