/**
 * Created by ricardo on 23/01/16.
 */
(function () {
    var app = angular.module('AppAngularFileUpload', ['angularFileUpload', 'ProductProvider']);

    app.controller('AngularFileUploadController', ['$scope', 'FileUploader', 'ProductService', function($scope, FileUploader, ProductService) {

        this.setProductId = function(id){
            console.info("HER =========== ", id);
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
            console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader.onAfterAddingFile = function(fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploader.onAfterAddingAll = function(addedFileItems) {
            console.info('onAfterAddingAll', addedFileItems);
        };
        uploader.onBeforeUploadItem = function(item) {
            console.info('onBeforeUploadItem', item);
        };
        uploader.onProgressItem = function(fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploader.onProgressAll = function(progress) {
            console.info('onProgressAll', progress);
        };
        uploader.onSuccessItem = function(fileItem, response, status, headers) {
            console.info('onSuccessItem', fileItem, response, status, headers);
        };
        uploader.onErrorItem = function(fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader.onCancelItem = function(fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader.onCompleteItem = function(fileItem, response, status, headers) {
            console.info('onCompleteItem', fileItem, response, status, headers);
        };
        uploader.onCompleteAll = function() {
            uploader.findImagesByApp();
        };
        // TODO: pendiente buscar imagenes de aplicaciones cuando temine de subir todas las imgenes seleccionadas
        uploader.findImagesByApp = function () {
            console.info('onCompleteAll');
            ProductService.findImagesByProduct();
        };

    }]);

})();