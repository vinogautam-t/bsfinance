app.controller('signupController', function($scope, $rootScope, $state, $timeout, ApiService) {

	$scope.pageInfo = {saveClicked: false};
	$scope.register = {};

	$scope.doRegister = function(){
		if($scope.regform.$valid){
			ApiService.register($scope.register).then(function(res){
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