(function() {
    angular.module('app', []);
})();

(function() {
    'use strict';

    angular.module('app')
        .config(states);

    states.$inject = ['$interpolateProvider', '$locationProvider'];

    function states($interpolateProvider, $locationProvider) {
        // Leave these here
        $locationProvider.html5Mode(true);
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    }
})();

// Create controller here

//# sourceMappingURL=main.js.map
