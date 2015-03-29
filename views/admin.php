<script>window.bs_bootstrap = <?php echo json_encode($data) ?>;</script>
<script>
    (function() {
        var app = angular.module('amber', ['isteven-multi-select']);

        app.controller('AmberCtrl', function($scope, $http) {
            var bootstrap = window.bs_bootstrap;
            $scope.loadingMessage = null;

            $scope.settings = bootstrap.settings;

            $scope.save = function() {
                $scope.loadingMessage = 'Saving ...';
                var params = $scope.settings;
                $http.post(window.ajaxurl + '?action=save_amber_settings', params)
                    .success(function(response) {
                        $scope.loadingMessage = null;
                    }).error(function(response) {
                        $scope.loadingMessage = null;
                        alert('There was an error saving the alert information! Try again.');
                    });
            }

            $scope.states = {
                AL: "Alabama",
                AK: "Alaska",
                AS: "American Samoa",
                AZ: "Arizona",
                AR: "Arkansas",
                CA: "California",
                CO: "Colorado",
                CT: "Connecticut",
                DE: "Delaware",
                DC: "District Of Columbia",
                FL: "Florida",
                GA: "Georgia",
                GU: "Guam",
                HI: "Hawaii",
                ID: "Idaho",
                IL: "Illinois",
                IN: "Indiana",
                IA: "Iowa",
                KS: "Kansas",
                KY: "Kentucky",
                LA: "Louisiana",
                ME: "Maine",
                MD: "Maryland",
                MA: "Massachusetts",
                MI: "Michigan",
                MN: "Minnesota",
                MS: "Mississippi",
                MO: "Missouri",
                MT: "Montana",
                NE: "Nebraska",
                NV: "Nevada",
                NH: "New Hampshire",
                NJ: "New Jersey",
                NM: "New Mexico",
                NY: "New York",
                NC: "North Carolina",
                ND: "North Dakota",
                OH: "Ohio",
                OK: "Oklahoma",
                OR: "Oregon",
                PA: "Pennsylvania",
                PR: "Puerto Rico",
                RI: "Rhode Island",
                SC: "South Carolina",
                SD: "South Dakota",
                TN: "Tennessee",
                TX: "Texas",
                UT: "Utah",
                VT: "Vermont",
                VA: "Virginia",
                WA: "Washington",
                WV: "West Virginia",
                WI: "Wisconsin",
                WY: "Wyoming"
            };
        });
    })()
</script>
<div id="main" ng-app="amber">
    <div class="left_column" ng-controller="AmberCtrl">
        <div id="controls">
            <div class="box">
                <div class="title">Amber Alert Options</div>
                <div class="content">
                    <div class="option">
                        <div class="control-label">
                            <div class="name nomargin">
                                Amber Alert Region
                            </div>
                            <div class="desc nomargin">
                                Which state/region is relevant to your blog?
                            </div>
                        </div>
                        <div class="control-container">
                            <select ng-model="settings.state" ng-options="key as value for (key, value) in states"></select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="break"></div>
                    <div class="option">
                        <div class="control-label">
                            <div class="name nomargin">
                                Ribbon
                            </div>
                            <div class="desc nomargin">
                                Should the amber alert ribbon be enabled for your site?
                            </div>
                        </div>
                        <div class="control-container">
                            <input ng-model="settings.show_ribbon" type="checkbox" />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="break"></div>
                    <div class="option">
                        <div class="control-label">
                            <div class="name nomargin">
                                Number of Days to Keep Active
                            </div>
                            <div class="desc nomargin">
                                When an amber alert is issued, how long should the notice
                                be visible?
                            </div>
                        </div>
                        <div class="control-container">
                            <input ng-model="settings.hold_for" type="text" placeholder="1" />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="break"></div>
                    <div class="option">
                        <div class="control-label">
                            <div class="name nomargin">

                            </div>
                        </div>
                        <div class="save-container">
                            <span class="success" id="save-success">Saved!</span>
                            <input type="button" value="Save" name="" ng-click="save()" />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="selfie-loading-box" ng-show="loadingMessage !== null">
            <img src="<?php echo AmberAlert_Utility::getImageBaseURL() . 'ajax-loader-bar.gif'; ?>" alt="Loading Image"/>
            <span>{{loadingMessage}}</span>
        </div>
    </div>
    <div class="right_column">

    </div>
</div>
<div class="clearfix"></div>