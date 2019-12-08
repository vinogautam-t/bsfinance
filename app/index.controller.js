app.controller('indexController', indexController);

indexController.$inject = ['$rootScope', '$scope', '$state', '$window', '$timeout', '$interval'];

function indexController($rootScope, $scope, $state, $window, $timeout, $interval) {
    
    $scope.user = localStorage.getItem('bsuser');

    if($scope.user){
        $rootScope.loggedInUserInfo = {};
    }
    
    $scope.logout = function(){
        localStorage.removeItem('bsuser');
        
        $state.go('home');
    }
    
    $rootScope.currentState = $state.current.name;
    $rootScope.currentStateDetails = $state.current;
    $rootScope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams){ 
        $rootScope.currentState = toState.name;
        $rootScope.currentStateDetails = toState;
        $scope.isOnline = navigator.onLine;
        if($('body').hasClass('sidebar-open')){
            $('.sidebar-header i.fa-close').trigger('click');
        }
        $('.tooltip').removeClass('show');
        $('.notification-toggle').removeClass('show');
        if(toState.name != fromState.name){
            $("html, body").animate({ scrollTop: 0 }, "slow");
        }
        
        if(toState.auth){
            var rurl = toState.url.split('/').map(function(a){
                var b = a.split(':');
                if(b.length == 1){
                    return a;
                } else {
                    return toParams[b[1]];
                }
            });
        }
    });
    
    $rootScope.$on('$stateChangeStart',
    function (event, toState, toParams, fromState, fromParams, options) { 
        
        if(toState.auth && !$rootScope.loggedInUserInfo){
            event.preventDefault();
            $state.go('login');
        }
    });
    
    $scope.copy = function(data){
        return angular.copy(data);
    };
    
    $scope.loadPlugin = function(){
      
    };
    
    $scope.initTooltip = function(){
       $('[data-toggle="tooltip"]').tooltip(); 
    };
    
    $scope.focus = function(id){
        $timeout(function(){
            $('#'+id).focus();
        }, 200);
    };
    
    $scope.focusout = function(id){
        $('#'+id).blur();
    };
    
    $scope.scrollToBottom = function(id){
        $timeout(function(){
            $("#"+id).stop().animate({ scrollTop: $("#"+id)[0].scrollHeight}, 100);
        }, 100);
    };
    
    $scope.scrollToTop = function(){
        $timeout(function(){
            $("html, body").animate({ scrollTop: 0 }, 1000);
        }, 100);  
    };

    $scope.goTop = function(){
        $("html, body").animate({ scrollTop: 0 }, 100);
    };

    $scope.refresh = function(){
        $state.reload();
    };
}    
