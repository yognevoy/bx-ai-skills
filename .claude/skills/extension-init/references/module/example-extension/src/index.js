import ExampleExtension from "./ExampleExtension";

BX.namespace('BX.Vendor.Module');
BX.ready(function () {
    if (!BX.Vendor.Module.hasOwnProperty('ExampleExtension')) {
        BX.Vendor.Module.ExampleExtension = ExampleExtension.create();
    }
});
