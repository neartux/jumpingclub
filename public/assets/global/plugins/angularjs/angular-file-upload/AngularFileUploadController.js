/**
 * Created by ricardo on 23/01/16.
 */
(function () {
    var app = angular.module('AppAngularFileUpload', ['angularFileUpload', 'ProductProvider']);

    app.controller('AngularFileUploadController', ['$scope', 'FileUploader', 'ProductService', function($scope, FileUploader, ProductService) {

        this.setProductId = function(id){
            // Reasigna el id del producto al que pertenece la imagen
            uploader.formData[0].productId = id;
        };

        var uploader = $scope.uploader = new FileUploader({
            url: 'uploadimages',
            removeAfterUpload: true,
            formData: [
                {
                    "productId": undefined,
                    "nameApp": ''
                }
            ]
        });

        // FILTERS

        uploader.filters.push({
            name: 'imageFilter',
            fn: function(item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });

        // CALLBACKS

        uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        };
        uploader.onAfterAddingFile = function(fileItem) {
        };
        uploader.onAfterAddingAll = function(addedFileItems) {
        };
        uploader.onBeforeUploadItem = function(item) {
        };
        uploader.onProgressItem = function(fileItem, progress) {
        };
        uploader.onProgressAll = function(progress) {
        };
        uploader.onSuccessItem = function(fileItem, response, status, headers) {
        };
        uploader.onErrorItem = function(fileItem, response, status, headers) {
        };
        uploader.onCancelItem = function(fileItem, response, status, headers) {
        };
        uploader.onCompleteItem = function(fileItem, response, status, headers) {
        };
        uploader.onCompleteAll = function() {
            uploader.findImagesByApp();
        };
        uploader.findImagesByApp = function () {
            ProductService.changeValueReloadProduct();
        };

    }]);

})();