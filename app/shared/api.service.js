app.factory('ApiService', function (httpService, $q, APIURL, $rootScope, $timeout) {
	var apiService = {};
    
    apiService.notification = function(msg, type){
        $('body').pgNotification({
            style: 'flip',
            message: msg,
            position: 'top-middle',
            timeout: 1000,
            type: type
        }).show();
    };
    
	apiService.login = function (data) {
    	return httpService
        .post(APIURL+'bs_login', data)
        .then(function (res) {
            return res['data'];
        });
    };

    apiService.forgotPassword = function (data) {
        return httpService
        .post(APIURL+'bs_forgot_password', data)
        .then(function (res) {
            return res['data'];
        });
    };

    apiService.resetPassword = function (data) {
        return httpService
        .post(APIURL+'bs_reset_password', data)
        .then(function (res) {
            return res['data'];
        });
    };
    
    apiService.register = function (data) {
    	return httpService
        .post(APIURL+'bs_create_user', data)
        .then(function (res) {
            return res['data'];
        });
    };
    
    apiService.bs_user_exist = function (name) {
    	return httpService
        .post(APIURL+'bs_user_exist&username='+name)
        .then(function (res) {
            return res['data'];
        });
    };
    
    apiService.bs_email_exist = function (name) {
    	return httpService
        .post(APIURL+'bs_email_exist&email='+name)
        .then(function (res) {
            return res['data'];
        });
    };
    
    apiService.bs_delete_user = function (data) {
    	return httpService
        .post(APIURL+'bs_delete_user', data)
        .then(function (res) {
            return res['data'];
        });
    };
    
    apiService.bs_plans = function(){
        return httpService
        .post(APIURL+'bs_plans', {})
        .then(function (res) {
            return res['data'];
        });
    };

    apiService.bs_deposit_request = function(data){
        data.user_id = $rootScope.loggedInUserInfo.ID;
        return httpService
        .post(APIURL+'bs_deposit_request', data)
        .then(function (res) {
            return res['data'];
        });
    };
    
     apiService.bs_withdraw_request = function(data){
        data.user_id = $rootScope.loggedInUserInfo.ID;
        return httpService
        .post(APIURL+'bs_withdraw_request', data)
        .then(function (res) {
            return res['data'];
        });
    };

    apiService.bs_deposit_list = function(){
        var data = {};
        data.user_id = $rootScope.loggedInUserInfo.ID;
        return httpService
        .post(APIURL+'bs_deposit_list', data)
        .then(function (res) {
            return res['data'];
        });
    };

    apiService.bs_transaction_list = function(filter){
        filter.user_id = $rootScope.loggedInUserInfo.ID;
        return httpService
        .post(APIURL+'bs_transaction_list', filter)
        .then(function (res) {
            return res['data'];
        });
    };

    apiService.bs_home_data = function(){
        var data = {};
        data.user_id = $rootScope.loggedInUserInfo.ID;
        return httpService
        .post(APIURL+'bs_home_data', data)
        .then(function (res) {
            return res['data'];
        });
    };

    apiService.bs_user_balance = function(){
        var data = {};
        data.user_id = $rootScope.loggedInUserInfo.ID;
        return httpService
        .post(APIURL+'bs_user_balance', data)
        .then(function (res) {
            return res['data'];
        });
    };
    
    return apiService;
});