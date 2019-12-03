app.controller('indexController', indexController);

indexController.$inject = ['$rootScope', '$scope', '$state', '$window', '$timeout', '$interval'];

function indexController($rootScope, $scope, $state, $window, $timeout, $interval) {
    
    $scope.user = localStorage.getItem('bsuser');
    
    
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
       $('.content_slider_ul').each(function(){
        if($(this).hasClass("carouFredSel")){
                    if( $(this).closest('.content_slider').hasClass('carousel') ){
                        var style = { min:1, max:6};
                    } else {
                        var style = 1;
                    }

                    // Init carouFredSel
                    $( this ).carouFredSel({
                        circular    : true,
                        responsive  : true,
                        items       : {
                            width   : 380,
                            visible : style
                        },
                        scroll      : {
                            duration    : 500,
                            easing      : 'swing'
                        },
                        prev        : {
                            button      : function(){
                                return $(this).closest('.content_slider').find('.slider_prev');
                            }
                        },
                        next        : {
                            button      : function(){
                                return $(this).closest('.content_slider').find('.slider_next');
                            }
                        },
                        pagination  : {
                            container   : function(){
                                return $(this).closest('.content_slider').find('.slider_pagination');
                            }
                        },
                        auto        : {
                            play            : window.mfn_sliders.slider ? true : false,
                            timeoutDuration : window.mfn_sliders.slider ? window.mfn_sliders.slider : 2500,
                        },
                        swipe       : {
                            onTouch     : true,
                            onMouse     : true,
                            onBefore    : function(){
                                $(this).find('a').addClass('disable');
                                $(this).find('li').trigger('mouseleave');
                            },
                            onAfter     : function(){
                                $(this).find('a').removeClass('disable');
                            }
                        }
                    });
                    
                    // Disable accidental clicks while swiping
                    $(this).on('click', 'a.disable', function() {
                        return false; 
                    });
                }else{
            
                
                var pager = function( el, i ){
                    return '<a>'+ i +'</a>';
                };


                    var slider      = $(this);  
                    var count       = 1;
                    var centerMode  = false;
                    
                    if( slider.closest( '.content_slider' ).hasClass( 'carousel' ) ){
                        count = slickAutoResponsive( slider );
                        
                        $(window).bind( 'debouncedresize', function(){
                            slider.slick( 'slickSetOption', 'slidesToShow', slickAutoResponsive( slider ), false );
                            slider.slick( 'slickSetOption', 'slidesToScroll', slickAutoResponsive( slider ), true );
                        });
                    }
                    
                    if( slider.closest( '.content_slider' ).hasClass( 'center' ) ){
                        centerMode = true;
                    }       
                    
        if(slider.siblings( '.slider_prev' ).length){
                    slider.slick({
                        cssEase         : 'cubic-bezier(.4,0,.2,1)',
                        dots            : true,
                        infinite        : true,         
                        touchThreshold  : 10,
                        speed           : 300,
                        
                        centerMode      : centerMode,
                        centerPadding   : '20%',
                        
                        prevArrow       :  slider.siblings( '.slider_prev' ),
                        nextArrow       :  slider.siblings( '.slider_next' ),

                        adaptiveHeight  : true, 
                        appendDots      : slider.siblings( '.slider_pager' ),
                        customPaging    : pager,
                        
                        rtl             : rtl ? true : false,
                        autoplay        : window.mfn_sliders.slider ? true : false,
                        autoplaySpeed   : window.mfn_sliders.slider ? window.mfn_sliders.slider : 5000,
                                
                        slidesToShow    : count,
                        slidesToScroll  : count
                    });
                    
                    
            }   else{       
                    slider.slick({
                        cssEase         : 'cubic-bezier(.4,0,.2,1)',
                        dots            : true,
                        infinite        : true,         
                        touchThreshold  : 10,
                        speed           : 300,
                        
                        centerMode      : centerMode,
                        centerPadding   : '20%',
                        
                        prevArrow       : '<a class="button button_js slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a>',
                        nextArrow       : '<a class="button button_js slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>',
                    

                        adaptiveHeight  : true, 
                        appendDots      : slider.siblings( '.slider_pager' ),
                        customPaging    : pager,
                        
                        rtl             : rtl ? true : false,
                        autoplay        : window.mfn_sliders.slider ? true : false,
                        autoplaySpeed   : window.mfn_sliders.slider ? window.mfn_sliders.slider : 5000,
                                
                        slidesToShow    : count,
                        slidesToScroll  : count
                    });
                    
            }   
                    
                    
                    
                    
                    
            
            }
        });
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
