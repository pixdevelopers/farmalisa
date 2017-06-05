   (function() {
       "use strict";
       angular.module('farmaApp', ['ngRoute'])
           .config(function($routeProvider, $locationProvider) {
               $locationProvider.html5Mode(true).hashPrefix("!");

               $routeProvider
                   .when('/', {
                       controller: 'homeCtrl',
                       templateUrl: 'views/home.html'
                   })
                   .when('/aboutus', {
                       templateUrl: 'views/aboutus.html'
                   })
                   .when('/partners', {
                       templateUrl: 'views/partners.html'
                   })
                   .when('/gallery', {
                       templateUrl: 'views/gallery.html'
                   })
                   .when('/contactus', {
                       templateUrl: 'views/contactus.html'
                   })
                   .when('/services/:page*', {
                       templateUrl: function(parameters) {
                           return 'views/' + parameters.page + '.html';
                       }
                   })
                   .when('/products/:page*', {
                       templateUrl: function(parameters) {
                           return 'views/' + parameters.page + '.html';
                       }
                   });
           })

       .controller('homeCtrl', function($scope, $routeParams) {
               $scope.services = [
                   { page: 'services-1', title: 'EXPORTING BRANDED MEDICINES', desc: 'Medicine is the most vital product made by human. According to the shortage of materials using to produce it and different policies in different countries, medicine is not available everywhere enough. We try to learn about shortage in the world ...' },
                   { page: 'services-2', title: 'EXPORTING GENERICS AND LOCAL MEDICINES', desc: 'In some cases customers prefer to buy generics because of price and availability advantage. Beside branded medicines there are lot of generics made by well-known manufacturers in Turkey, Europe, America, India, â€¦ As a registered parallel trader ...' },
                   { page: 'services-3', title: 'TRADING AND SOURCING CHEMICALS, COSMETICS AND FOOD PRODUCTS', desc: 'We supply a variety of chemicals available in various grades, Analytical Reagent (AR), Chemically Pure (CP), Technical Grade as well as Pharmaceutical and Food Grades by well-known brands including Acros, Carlo Erba, Fluka, J.T.Baker, Lab-Scan, Merck,...' },
                   { page: 'services-4', title: 'ACTIVE PHARMACEUTICAL INGREDIENTS (API) AND EXCIPIENTS', desc: 'As an international trading company dealing with pharmaceutical companies worldwide you can count us for finding best source for you. Worldwide reliable sources of APIs. Having offices and subsidiaries in more than 10 countries' },
                   { page: 'services-5', title: 'REFERENCE STANDARDS', desc: 'If you require reference standards or pharmaceutical standards, Farmalisa is able to provide you with products from USP, EP and BP for pharmaceutical testing along with your requirements for AA, ICP and other reference materials.' },
                   { page: 'services-6', title: 'EVERYTHING YOU EXPECT FROM YOUR STRATEGIC PARTNER', desc: 'For companies aim to run an international business, the best method is making strategic partner in the target market. This partnership may include Marketing, Supply Chain, Integration, Technology, Financial and Information.' }
               ];



           })
           .controller('contactFormCtrl', function($scope, $http, $timeout) {
               $scope.submitted = false;
               $scope.status;

               $scope.submit = function(contactForm) {
                   event.preventDefault();

                   $scope.submitted = true;
                   $.ajax({
                       type: "POST",
                       url: "contact-form.php",
                       data: $("#contactFrom").serialize(),
                       success: function(data) {
                           $scope.$apply(function() {
                               $scope.status = data;
                           });

                           $timeout(function() {
                               $scope.submitted = false;
                           }, 15000);
                       }
                   });
               };
           })
           .controller('productCtrl', function($scope, $http) {
               $scope.companies = [];
               $http.get('data/companies.json')
                   .then(function(response) {
                       $scope.companies = response.data;
                   });
           });

   })();
